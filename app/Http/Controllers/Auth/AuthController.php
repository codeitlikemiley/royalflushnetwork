<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Profile;
use App\Link;
use Auth;
use Input;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\EmailRequest;
use App\Http\Controllers\MailController as Mail;
use App\Traits\CaptchaTrait;


class AuthController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins, CaptchaTrait;

    protected $redirectTo = 'profile';
    protected $loginPath  = 'login';

    public $mail;

    public function __construct(Mail $mail)
    {
        $this->middleware('guest',
            ['except' => ['getLogout', 'resendEmail', 'activateAccount']]);
        $this->mail = $mail;
    }

    public function authenticate(Request $request)
    {
        $loginRequest = new LoginRequest();
        $validator    = Validator::make($request->all(), $loginRequest->rules(), $loginRequest->messages());

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()->toArray(), 'inputs' => Input::except('_token', 'password')], 200);
        }

        if ($this->captchaCheck() == false) {
            $errors = $validator->errors()->add('captchaerror', 'Wrong Captcha!');

            return response()->json(['success' => false, 'errors' => $errors], 200);
        }

        $email       = $request->email;
        $password    = $request->password;
        $credentials = [
                    'email'    => $email,
                    'password' => $password,
                        ];

        $valid     = Auth::validate($credentials);
        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $this->hasTooManyLoginAttempts($request)) {
            $errors = $validator->errors()->add('lock', 'Try Again Later!');

            return response()->json(['success' => false, 'errors' => $errors], 429);
        }

        if (!$valid) {
            $errors = $validator->errors()->add('wrongpass', 'The Password You Type is Incorrect!');
            $this->incrementLoginAttempts($request);

            return response()->json(['success' => false, 'errors' => $errors], 200);
        }

        $user   = Auth::attempt($credentials);
        $active = Auth::user()->active;
        $status = Auth::user()->status;

        if (!$active) {
            $errors = $validator->errors()->add('notactive', 'Account Not Yet Active!');
            Auth::logout();

            return response()->json(['success' => false, 'errors' => $errors], 200);
        }
        if (!$status) {
            $errors = $validator->errors()->add('banned', 'Account is Banned!');
            Auth::logout();

            return response()->json(['success' => false, 'errors' => $errors], 401);
        }

        return response()->json(['success' => true, 'url' => 'profile'], 200);
    }

    public function login()
    {
        return \View::make('auth.login');
    }

    public function activate($email, $activation_code)
    {
        $user   = User::where('email', $email)->first();
        $active = User::where('activation_code', $activation_code)->first();
        if ($user) {
            if ($user->activation_code === $activation_code) {
                $user->active          = true;
                $user->status          = true;
                $user->activation_code = '';
                $user->save();
                $this->mail->activated($user);

                return \View::make('auth.active');
            }
        }

        return \View::make('auth.error');
    }

    public function sendActivationLink(EmailRequest $request)
    {
        $user = User::where('email', $request->email)->firstOrFail();
        $this->mail->registered($user);

        return \View::make('auth.success');
    }

    public function resendEmail()
    {
        $user = \Auth::user();
        if ($user->resent >= 3) {
            return view('auth.tooManyEmails')
                ->with('email', $user->email);
        } else {
            $user->resent = $user->resent + 1;
            $user->save();
            $this->mail->passwordResend($user);
            \Auth::Logout();

            return \View::make('auth.success');
        }

        return \View::make('auth.error');
    }

    public function create(Request $request)
    {
        $data = $request->all();

        $createUserRequest = new CreateUserRequest();
        $validator         = Validator::make($request->all(), $createUserRequest->rules(), $createUserRequest->messages());

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()->toArray()], 400);
        }

        if ($this->captchaCheck() == false) {
            $errors = $validator->errors()->add('captchaerror', 'Wrong Captcha!');

            return response()->json(['success' => false, 'errors' => $errors], 400);
        }

        $activation_code         = str_random(60) . $request->input('email');
        $data['activation_code'] = $activation_code;
        $data['active']          = false;
        $data['status']          = true;

        $link = Input::get('sponsor_link');

        $sponsor = Link::where('link', $link)->firstOrFail();

        \DB::transaction(function()
        {
        $user                  = new User();
        $user->username        = $request->input('username');
        $user->email           = $request->input('email');
        $user->password        = $request->input('password');
        $user->sp_id           = $sponsor->user_id;
        $user->activation_code = $data['activation_code'];
        $user->active          = $data['active'];
        $user->status          = $data['status'];
        $user->save();

        // Creates the user_id in the profile
        $url                   = asset('img/avatar.png');
        $profile               = new Profile();
        $profile->first_name   = $request->input('first_name');
        $profile->last_name    = $request->input('last_name');
        $profile->display_name = $request->input('display_name');
        $profile->profile_pic  = $url;
        $user->profile()->save($profile);

        // Creates the user_id in the link
        $link             = new Link();
        $link->link       = $request->input('username');
        $link->sp_link_id = $sponsor->id;
        $link->sp_user_id = $sponsor->user_id;
        $user->links()->save($link);
        $this->mail->registered($user);

            if( !$user && !$profile && !$link )
            {
                $error = throw new \Exception('Account is Not Created Try Again!!!');
                $error = $error->getMessage();
                $errors = $validator->errors()->add('AccountCreationFailed', $error);

            return response()->json(['success' => false, 'errors' => $errors], 400);
            }
        });
        

        $data = [
            'event' => 'UserSignedUp',
            'data'  => [
                'username'   => $profile->display_name,
                'created_at' => $user->created_at,
            ],
        ];

        // Use this To Fire User Info In NewsBar
        // This Can Use the test-chanel in UserHasRegistered Event
        \PHPRedis::publish('rfn-chanel', json_encode($data));

        return response()->json(['success' => true], 201);
    }
}

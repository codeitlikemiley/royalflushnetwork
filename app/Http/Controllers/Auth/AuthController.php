<?php

namespace app\Http\Controllers\Auth;

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
use DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AuthController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins, CaptchaTrait;

    protected $redirectTo          = 'profile';
    protected $loginPath           = 'login';
    protected $redirectAfterLogout = 'login';

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

        // Validate Form
        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()->toArray(), 'inputs' => Input::except('_token', 'password')], 200);
        }

        // Check Captcha is Valid or Used!

        if ($this->captchaCheck() == false) {
            $errors = ['captchaError' => trans('auth.captchaError')];

            return response()->json(['success' => false, 'errors' => $errors], 200);
        }

        // Make Credentials
        $email       = $request->email;
        $password    = $request->password;
        $credentials = [
                    'email'    => $email,
                    'password' => $password,
                        ];
        // Remember Me Token If Filled
        $remember = $request->remember_token;

        $valid     = Auth::validate($credentials);
        $throttles = $this->isUsingThrottlesLoginsTrait();

        // Login Attempt Check
        if ($throttles && $this->hasTooManyLoginAttempts($request)) {
            $errors = $validator->errors()->add('lock', 'Oops! Too Many Failed Login Attempts! Try Again Later!');

            return response()->json(['success' => false, 'errors' => $errors], 429);
        }

        // Wrong Password Check
        if (!$valid) {
            $errors = $validator->errors()->add('wrongpass', 'The Password You Type is Incorrect!');
            $this->incrementLoginAttempts($request);

            return response()->json(['success' => false, 'errors' => $errors], 200);
        }

        $user   = Auth::attempt($credentials, $remember);
        $active = Auth::user()->active;
        $status = Auth::user()->status;

        // User is Banned
        if (!$status) {
            $errors = $validator->errors()->add('banned', 'Sorry Your Account is Banned!');
            Auth::logout();

            return response()->json(['success' => false, 'errors' => $errors], 401);
        }

        // User Not Active
        if (!$active) {
            $messages = ['NotActive' => 'Account is Not Active Yet Please Verify Your Email'];

            return response()->json(['success' => true, 'messages' => $messages, 'url' => 'profile'], 200);
        }

        $messages = ['success' => 'Welcome Back!'];
        // Successfully Login Without Any Problem
        return response()->json(['success' => true, 'messages' => $messages, 'url' => 'profile'], 200);
    }

    public function login()
    {
        return \View::make('auth.login');
    }

    public function activate($email, $activation_code)
    {
        try {
            $user = User::where('email', $email)->where('activation_code', $activation_code)->firstOrFail();
            $user->verifyEmail();
            $this->mail->activated($user);

            return \View::make('auth.active');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('login');
        }
    }

    // Method Can be Remove with Route
    public function sendActivationLink(EmailRequest $request)
    {
        $user = User::where('email', $request->email)->firstOrFail();

        $this->mail->registered($user);

        return \View::make('auth.success');
    }

    // Needs a Good Template
    public function resendEmail()
    {
        $user = \Auth::user();
        if ($user->resent >= 3) {
            return view('auth.tooManyEmails')
                ->with('email', $user->email);
        } else {
            $user->incrementResent();
            $this->mail->passwordResend($user);

            return \View::make('auth.success');
        }

        return \View::make('auth.error');
    }

    public function create(Request $request)
    {
        $createUserRequest = new CreateUserRequest();
        $validator         = Validator::make($request->all(), $createUserRequest->rules(), $createUserRequest->messages());

        // Validate Form
        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()->toArray()], 400);
        }

        // Check Captcha still Valid or Used!

        if ($this->captchaCheck() == false) {
            $errors = ['captchaError' => trans('auth.captchaError')];

            return response()->json(['success' => false, 'errors' => $errors], 400);
        }

        // Check Sponsor Cookie , Provide One if None
        if (\Cookie::get('sponsor') == false) {
            $link = Link::with('user', 'user.profile')->where('link', $request->sponsor_link)->first();
            $cookie = $link->toArray();

            $errors = [
            'CookieError' => trans('auth.cookieError'),
            'cookieNew'   => trans('auth.cookieAttached'),

            ];

            return response()->json(['success' => false, 'errors' => $errors], 400)->withCookie(\Cookie::forever('sponsor', $cookie));
        }

        // This Will Prevent Unnecessary Creation of Account if Something Failed!
        DB::beginTransaction();
        $user       = User::create($request->all());
        $profile    = $user->profile()->create($request->all());
        $link       = new Link();
        $link->link = Input::get('username');
        $user->links()->save($link);

        // IF Error Occured Throw an Exception then Rollback!
        try {
            if (!$user && !$profile && !$link) {
                throw new \Exception('Account Creation Failed ,Account is Rollback');
            }
        } catch (\Exception $e) {
            DB::rollback();

            $errors = [
            'ExceptionError' => $e->getMessage(),
            'RefreshPage'    => trans('auth.refreshPage'),
            ];

            return response()->json(['success' => false, 'errors' => $errors], 400); // Failed Creation
        }

        // Account Successfully Created
        DB::commit();

        // Send Email To The New User
        $this->mail->registered($user);

        $data = [
                'event' => 'UserSignedUp',
                'data'  => [
                    'display_name' => $profile->display_name,
                    'created_at'   => $user->created_at,
                ],
            ];

        // BroadCast Realtime in NewsBar
        \PHPRedis::publish('rfn-chanel', json_encode($data));

        // Forget the Set Cookie
        $cookie = \Cookie::forget('sponsor');

        // Return With a Response to Delete Cookie
        return response()->json(['success' => true], 201)->withCookie($cookie);
    }
}

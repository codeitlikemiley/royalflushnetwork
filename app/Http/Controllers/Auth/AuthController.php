<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Auth;
use Input;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\EmailRequest;
use App\Http\Controllers\MailController as Mail;

class AuthController extends Controller
{
    

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $redirectTo = '/profile';
    protected $loginPath = '/login';

     public $mail;

    
    public function __construct(Mail $mail)
    {
       $this->middleware('guest',
            ['except' =>
                ['getLogout', 'resendEmail', 'activateAccount']]);
       $this->mail = $mail;
    }

    protected function create(Request $request)
    {
        $data = $request->all();
        $hash = (str_replace('/', '', \Hash::make(str_random(6))));
        $data['activation_code'] = $hash;
        $data['active'] = false;
        $data['status'] = true;
        $createUserRequest = new CreateUserRequest();
        $validator = Validator::make($data, $createUserRequest->rules());
        if ($validator->fails()) {
            return redirect('login')
                ->withErrors($validator)
                ->withInput()
                ->with('signup', 'active');
        }
        $user = User::create($data);
        $this->mail->registered($user);
        return \View::make('auth.success');

    }

    /**
     * check credentials and log in the user.
     *
     * @param array $request
     *
     * @return view
     */
    public function authenticate(Request $request)
    {
         $loginRequest = new LoginRequest();
        $validator = Validator::make($request->all(), $loginRequest->rules(), $loginRequest->messages());
        if ($validator->fails()) {
            return response()->json('notregister');
        }
        $email = $request->email;
        $password = $request->password;
        // if (Auth::attempt(['email' => $email, 'password' => $password, 'active' => false, 'status' => false])) {
        if (Auth::attempt(['email' => $email, 'password' => $password, 'active' => false, 'status' => true])) {
            return response()->json('notactive');
                
                
        }elseif (Auth::attempt(['email' => $email, 'password' => $password, 'active' => true, 'status' => false])) {
            Auth::Logout();
            return response()->json('banned');
        }
        elseif (Auth::attempt(['email' => $email, 'password' => $password, 'active' => true, 'status' => true])) {
            return response()->json('success');
        }
        return response()->json('wrongpass');

    }

    public function login()
    {
        return \View::make('auth.login');
    }



    public function activate($email, $activation_code)
    {

        $user = User::where('email', $email)
                ->first();
        if($user){
            if($user->activation_code === $activation_code){
                $user->active = true;
                $user->status = true;
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
        if( $user->resent >= 3 )
        {
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


}

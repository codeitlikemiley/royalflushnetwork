<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $redirectTo = '/dashboard';
    protected $loginPath = '/login';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->middleware('guest',
            ['except' =>
                ['getLogout', 'resendEmail', 'activateAccount']]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'alpha_num|required|between:6,30|unique:users',
            'first_name' => 'required|between:2,30',
            'last_name' => 'required|between:2,30',
            'display_name' => 'max:30',
            'email' => 'required|email|max:60|unique:users',
            'password' => 'required|confirmed|min:8',
            'agree' => 'required'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }


    public function getRegister()
    {
        $message = "Sorry You Cant Register without a Sponsor";
        return view('nosponsor')->with('message', $message);
    }

     public function getSponsorLink($link = null)
    {

        try {
            $link = Link::where('link', $link)->firstOrFail();

            return view('auth.register')->with(compact('link'));
        }
        catch(ModelNotFoundException $e) {
                $message = "Sorry it Seems that $link is not Yet Registered to Us!";
                return view('nosponsor')->with('message', $message);
            }
    }

    public function postRegister(Request $request)
    {

        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }
        // I should add a Foreign Key for the Link ID to the usertable
        $activation_code = str_random(60) . $request->input('email');

        $user = new User;
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->sp_id = $request->input('sp_id');
        $user->activation_code = $activation_code;
        $user->save();

        // Creates the user_id in the profile
        $profile = new Profile;
        $profile->first_name = $request->input('first_name');
        $profile->last_name = $request->input('last_name');
        $profile->display_name = $request->input('display_name');
        $user->profile()->save($profile);

        // Creates the user_id in the link
        $link = new Link;
        $link->link = $request->input('username');
        $link->sp_link_id = $request->input('sp_link_id');
        $link->sp_user_id = $request->input('sp_id');
        $user->link()->save($link);

        if ($user->save()) {



            $this->sendEmail($user);

            return view('auth.activateAccount')
                ->with('email', $request->input('email'));

        } else {

            \Session::flash('message', \Lang::get('notCreated') );
            return redirect()->back()->withInput();

        }




    }




    public function sendEmail(User $user)
    {

        $data = array(
                'name' => $user->name,
                'code' => $user->activation_code,
        );
        
        \Mail::queue('emails.activateAccount', $data, function($message) use ($user) {
            $message->subject( \Lang::get('auth.`') );
            $message->to($user->email);
        });
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
            $this->sendEmail($user);
            return view('auth.activateAccount')
                ->with('email', $user->email);
        }
    }
    
    public function activateAccount($code, User $user)
    {

        if($user->accountIsActive($code)) {
            \Session::flash('message', \Lang::get('auth.successActivated') );

            return redirect('/dashboard');
        }
    
        \Session::flash('message', \Lang::get('auth.unsuccessful') );
        return redirect('/dashboard');
    
    }
}

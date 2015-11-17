<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
//use Illuminate\Foundation\Auth\ResetsPasswords;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\MailController as Mail;
use App\Http\Requests\EmailRequest;
use Validator;
use App\Http\Requests\PasswordRequest;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    public $mail;

    /**
     * Create a new password controller instance.
     */
    public function __construct(Mail $mail)
    {
        $this->middleware('guest');
        $this->mail = $mail;
    }

    /**
     * return recovery form.
     *
     * @return view
     */
    public function index()
    {
        return \View::make('auth.password');
    }

    /**
     * password change form.
     *
     * @param $email, $token
     *
     * @return view
     */
    public function reset($email, $token)
    {
       $user = User::where('email', $email)->firstOrFail();
       $active_token = User::where('activation_code', $token)->firstOrFail();
        return \View::make('auth.reset', compact('token', 'email'));
    }

    /**
     * store the new password.
     *
     * @param $request
     */
    public function save(PasswordRequest $request)
    {
        $user = User::where('email', $request->email)->firstOrFail();
        if ($user->activation_code == $request->token) {
            $user->password = $request->password;
            $user->activation_code = '';
            $user->save();

            return \View::make('auth.restored');
        }

        return redirect()->to('password/reset');
    }

    /**
     * send restore link by email.
     *
     * @return view
     */
    public function sendLink(Request $request)
    {
        $emailRequest = new EmailRequest();
        $validator = Validator::make($request->all(), $emailRequest->rules());
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput()
                ->with('signup', 'active');
        }

        $user = User::where('email', $request->email)->firstOrFail();
        $activation_code = str_random(60) . $request->input('email');
        $user->activation_code = $activation_code;
        $user->save();
        $this->mail->passwordLink($user);
        return \View::make('auth.success');
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
// use Illuminate\Foundation\Auth\ResetsPasswords;
use App\User;
use Validator;
use Illuminate\Http\Request;
use App\Http\Requests\EmailRequest;
use App\Http\Requests\PasswordRequest;
use App\Traits\CaptchaTrait;
use App\Http\Controllers\MailController as Mail;
use Illuminate\Database\Eloquent\ModelNotFoundException;


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

    use CaptchaTrait;
    public $mail;

   /**
    * [__construct Inject Mail and Guest]
    * @param Mail $mail [Use Mail Controller]
    */
    public function __construct(Mail $mail)
    {
        $this->middleware('guest');
        $this->mail = $mail;
    }

    /**
     * After Clicking Link in Email , Return A View of Password Reset
     *
     * @param $email, $token
     *
     * @return view with $email and $token
     */
    public function reset($email, $token)
    {
        try {
            $user = User::where('email', $email)->where('activation_code', $token)->firstOrFail();
            return \View::make('auth.reset', compact('token', 'email'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('/');
        }
    }

    /**
     * Submit a Post Request To Save a New Password
     *
     * @param $request
     * @return response
     */
    public function save(Request $request)
    {
        $passwordRequest = new PasswordRequest();
        $validator       = Validator::make($request->all(), $passwordRequest->rules(), $passwordRequest->messages());
        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()->toArray()], 400);
        }

        if ($this->captchaCheck() == false) {
            $errors = ['captchaError' => trans('auth.captchaError')];

            return response()->json(['success' => false, 'errors' => $errors], 400);
        }

        $user = User::where('email', $request->email)->firstOrFail();
        $user->activation_code == $request->token;
        $user->password        = $request->password;
        $user->activation_code = '';
        $user->save();

        return response()->json(['success' => true, 'message' => 'You Have Successfully Reset Your Password!'], 200);
    }

    /**
     * Submits Email To Be Recovered by Post method
     *
     * @param $request
     * @return response
     */
    public function sendLink(Request $request)
    {
        $emailRequest = new EmailRequest();
        $validator    = Validator::make($request->all(), $emailRequest->rules(), $emailRequest->messages());
        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()->toArray()], 400);
        }
        if ($this->captchaCheck() == false) {
            $errors = ['captchaError' => trans('auth.captchaError')];

            return response()->json(['success' => false, 'errors' => $errors], 400);
        }
        $user                  = User::where('email', $request->email)->firstOrFail();
        $activation_code       = str_random(60) . $request->input('email');
        $user->activation_code = $activation_code;
        $user->save();
        $this->mail->passwordLink($user);

        return response()->json(['success' => true, 'message' => 'We Have  Sent You An Email For Password Reset!'], 200);
    }
}

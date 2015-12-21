<?php

namespace App\Http\Requests;

class PasswordRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'email|required|exists:users,email',
            'password' => 'required|min:6|confirmed',
            'token' => 'required',
            'g-recaptcha-response' => 'required',

        ];
    }

    public function messages()
    {
        return [
            'email.email' => 'Invalid Email Address',
            'email.exists' => 'Your email address is not registered.',
            'email.required' => 'We Require An Email Address to Reset Password!',
            'password.required' => 'You Forgot to Put Your New Password!',
            'password.min' => 'Your Password is Too Weak!',
            'password.confirmed' => 'Password Confirmation Dont Match!',
            'token.required' => 'Password Hacking is Punishable By Law!',
            'g-recaptcha-response.required' => 'You Forgot to Answer Captcha!',
            
        ];
    }

}

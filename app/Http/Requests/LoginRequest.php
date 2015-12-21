<?php

namespace App\Http\Requests;

class LoginRequest extends Request
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
            'username'             => 'required|exists:users,username|min:8',
            'password'             => 'required|min:8',
            'g-recaptcha-response' => 'required',
        ];
    }

    /**
     * Get the custom validation messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'username.exists'               => 'Username You Enter is Not Registered!',
            'password.min'                  => 'Password You Entered is Too Short!',
            'password.required'             => 'You Cant Log Without a Password!',
            'username.required'             => 'Please Login Using Your Username',
            'username.min'                  => 'Username Entered is Too Short!',
            'g-recaptcha-response.required' => 'You Forgot to Answer Captcha!',
        ];
    }
}

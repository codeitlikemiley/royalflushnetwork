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
            'email' => 'required|exists:users,email',
            'password' => 'required|min:8',
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
            'email.exists' => 'The Email You Enter is Not Registered!',
            'password.min' => 'The Password You Entered is Too Short!',
            'password.required' => 'You Cant Log Without a Password!',
            'email.required' => 'You Cant Log In Without an Email!',
        ];
    }
}

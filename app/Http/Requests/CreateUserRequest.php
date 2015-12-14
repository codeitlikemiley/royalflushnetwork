<?php

namespace App\Http\Requests;

class CreateUserRequest extends Request
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
                'sponsor_link' => 'exists:links,link|required',
                'username' => 'alpha_num|required|between:6,30|unique:users',
                'first_name' => 'required|between:2,30',
                'last_name' => 'required|between:2,30',
                'display_name' => 'required|max:30',
                'email' => 'required|email|max:60|unique:users',
                'password' => 'required|confirmed|min:8|max:60',
                'agree' => 'required',
                'g-recaptcha-response' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'sponsor_link.exists' => 'Your Sponsor Is Not Registered Yet!',
            'sponsor_link.required' => 'You Cant Register Without a Sponsor!',
            'username.alpha_num' => 'Only Alpha Numberic for Username!',
            'username.required' => 'You Need to Fill Up a Username!',
            'username.between' => 'Username is Too Short/Long',
            'username.unique' => 'Sorry That Username is Taken Already!',
            'first_name.required' => 'Your First Name is Blank!',
            'first_name.between' => 'Your First Name is Too Short/Long',
            'last_name.required' => 'Your Last Name is Blank!',
            'last_name.between' => 'Your Last Name is Too Short/Long',
            'email.required' => 'You Cant Register Without an Email!',
            'email.email' => 'Your Email is Not a Valid!',
            'email.max' => 'Email Cant Be Longer than 60 Characters',
            'email.unique' => 'That Email is Already Taken!',
            'password.required' => 'Fill Up The Password',
            'password.confirmed' => 'Password Confirmation Failed!',
            'password.min' => 'Password is Too Short!',
            'agree.required' => 'You Need To Agree in Our Terms and Condition!',
            'g-recaptcha-response.required' => 'You Forgot to Answer Captcha!',
        ];
    }
}

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
                'sponsor_link'         => 'exists:links,link|required',
                'username'             => array('unique:users', 'required', 'min:8', 'max:30', 'regex:/^[a-zA-Z0-9]+([._]?[a-zA-Z0-9]+)*$/'),
                'first_name'           => array('required', 'min:2', 'max:30', 'regex:/^[a-zA-Z]*$/'),
                'last_name'            => array('required', 'min:2', 'max:30', 'regex:/^[a-zA-Z]*$/'),
                'display_name'         => array('required', 'max:30', 'regex:/^[\w\-\s]*$/'),
                'email'                => array('unique:users', 'email', 'required', 'max:60', 'regex:/^[a-z0-9](\.?[a-z0-9]){5,}@g(oogle)?mail\.com$/i'),
                'password'             => 'required|confirmed|min:8|max:60',
                'agree'                => 'required',
                'g-recaptcha-response' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'sponsor_link.exists'           => 'Your Sponsor Is Not Registered Yet!',
            'sponsor_link.required'         => 'You Cant Register Without a Sponsor!',
            'username.required'             => 'You Need to Fill Up a Username!',
            'username.min'                  => 'Username Must Be 8 Characters Above!',
            'username.max'                  => 'Username Exceeded 30 Characters Limit!',
            'username.unique'               => 'Sorry That Username is Taken Already!',
            'username.regex'                => 'Invalid Pattern For Username!',
            'first_name.required'           => 'Your First Name is Blank!',
            'first_name.min'                => 'Your First Name is Too Short!',
            'first_name.max'                => 'Your First Name is Too Long!',
            'first_name.regex'              => 'Your First Name Has an Invalid Character!',
            'last_name.required'            => 'Your Last Name is Blank!',
            'last_name.min'                 => 'Your Last Name is Too Short!',
            'last_name.max'                 => 'Your Last Name is Too Long!',
            'last_name.regex'               => 'Your Last Name Has an Invalid Character!',
            'display_name.required'         => 'Display Name is Required!',
            'display_name.max'              => 'Display Name Exceeded 30 Characters!',
            'display_name.regex'            => 'Display Name Has an Invalid Character!',
            'email.required'                => 'You Cant Register Without an Email!',
            'email.email'                   => 'Your Email is Not a Valid!',
            'email.max'                     => 'Email Cant Be Longer than 60 Characters',
            'email.unique'                  => 'That Email is Already Taken!',
            'email.regex'                   => 'Please Use Only Google Email Address!',
            'password.required'             => 'Fill Up The Password',
            'password.confirmed'            => 'Password Confirmation Failed!',
            'password.min'                  => 'Password is Too Short!',
            'agree.required'                => 'You Need To Agree in Our Terms and Condition!',
            'g-recaptcha-response.required' => 'You Forgot to Answer Captcha!',
        ];
    }
}

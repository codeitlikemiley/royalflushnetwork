<?php

namespace App\Http\Requests;

class EmailRequest extends Request
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
            'email.exists' => 'Your email address is not registered.',
            'email.required' => 'We Require An Email Address to Reset Password!',
            'g-recaptcha-response.required' => 'You Forgot to Answer Captcha!'
            
        ];
    }
}

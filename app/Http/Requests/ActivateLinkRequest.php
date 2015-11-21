<?php

namespace App\Http\Requests;

class ActivateLinkRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Auth->User();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
                'link'                 => 'exists:links,link|required',
                'pin'                  => 'exists:codes,pin|required',
                'secret'               => 'required',
                'g-recaptcha-response' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'link.exists'                   => 'Your Trying to Activate a Link That Dont Exist!',
            'link.required'                 => 'Sorry We Cant Activate a Link Without a Link',
            'pin.exists'                    => 'Sorry The Pin Does Not Exist!',
            'pin.required'                  => 'Pin Code is Required!',
            'secret.required'               => 'Security Code is Required!',
            'g-recaptcha-response.required' => 'Are You a Human? Well You Forget Captcha!',

        ];
    }
}

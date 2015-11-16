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
				'password' => 'required|confirmed|min:8',
				'agree' => 'required'
        ];
    }
}

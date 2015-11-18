<?php

namespace App\Http\Requests;

class GenerateCodeRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Authenticated Admin
        // Only allow logged in users
        // return \Auth::check();
    }

     public function forbiddenResponse()
    {
        // Optionally, send a custom response on authorize failure 
        // (default is to just redirect to initial page with errors)
        // 
        // Can return a response, a view, a redirect, or whatever else
        return Response::make('Permission denied foo!', 403);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'pin' => 'required|unique:codes,pin|between:6,10',
            'secret' => 'required',
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
            'pin.required' => 'Pin is Required',
            'pin.unique' => 'Pin Must Be Unique',
            'pin.between' => 'Pin Must be Between 6-10 Characters Only',
            'secret.required' => 'Secret is Required',
            
            
        ];
    }
}

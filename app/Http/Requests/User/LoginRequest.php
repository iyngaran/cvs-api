<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'data.attributes.email' => 'email|required',
            'data.attributes.password' => 'required',
            'data.attributes.device_name' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'data.attributes.email.required' => 'The email field is required',
            'data.attributes.password.required' => 'The password field is required',
            'data.attributes.device_name.required' => 'The device_name field is required'
        ];
    }
}

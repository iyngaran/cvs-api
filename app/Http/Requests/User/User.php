<?php


namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class User extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'data.attributes.name' => 'required',
            'data.attributes.email' => 'required',
            'data.attributes.role_ids' => 'required'

        ];
    }

    public function messages()
    {
        return [
            'data.attributes.name.required' => 'The name field is required',
            'data.attributes.email.required' => 'The email field is required',
            'data.attributes.role_ids.required' => 'The roles field is required'
        ];
    }
}

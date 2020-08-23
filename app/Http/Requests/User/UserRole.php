<?php


namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserRole extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'data.attributes.name' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'data.attributes.name.required' => 'The name field is required'
        ];
    }
}

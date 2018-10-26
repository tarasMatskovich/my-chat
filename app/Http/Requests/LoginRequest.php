<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => 'required|string',
            'password' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Поле email обезательно к заполнению',
            'password.required' => 'Поле пароль обезательно к заполнению',
            'email.string' => 'Поле email должно быть строковым',
            'password.string' => 'Поле пароль должно быть строковым'
        ];
    }
}

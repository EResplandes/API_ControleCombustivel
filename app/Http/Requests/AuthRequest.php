<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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

    public function rules()
    {
        return [
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'email.email' => 'O campo E-MAIL deve ser um e-mail valído!',
            'email.required' => 'O campo E-MAIL é obrigatório!',
            'email.unique' => 'O E-MAIL já está em uso!',
            'password.required' => 'O campo SENHA deve ser obrigatório!'
        ];
    }
    
}

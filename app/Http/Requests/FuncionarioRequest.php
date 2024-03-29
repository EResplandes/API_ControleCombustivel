<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FuncionarioRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'uid' => 'required|unique:funcionarios',
            'nome_completo' => 'required',
            'cpf' => 'required|unique:funcionarios|digits_between:11,11',
            'empresa' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'uid.required' => 'O campo UID é obrigatório!',
            'uid.unique' => 'O UID já está em uso!',
            'uid.digits_between' => 'O campo UID deve ter exatos 8 dígitos!',
            'nome_completo.required' => 'O campo NOME COMPLETO é obrigatório!',
            'cpf.required' => 'O campo CPF é obrigatório!',
            'cpf.unique' => 'O CPF já está em uso!',
            'cpf.digits_between' => 'O campo CPF deve ter exatos 11 dígitos!',
            'empresa.required' => 'O campo EMPRESA é obrigatório!'
        ];
    }

}

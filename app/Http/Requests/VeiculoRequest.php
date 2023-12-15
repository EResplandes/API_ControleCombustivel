<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VeiculoRequest extends FormRequest
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
            'tag' => 'required|numeric|digits_between:12,12',
            'placa' => 'required',
            'modelo' => 'required|string',
            'marca' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'tag.required' => 'O campo TAG é obrigatório!',
            'tag.numeric' => 'O campo TAG deve ser apenas composto por números!',
            'tag.digits_between' => 'O campo TAG deve ter exatos 12 dígitos!',
            'placa.required' => 'O campo PLACA deve ser obrigatório!',
            'modelo.required' => 'O campo MODELO deve ser obrigatório!',
            'modelo.string' => 'O campo MODELO deve ser uma string!',
            'marca.required' => 'O campo MARCA é obritório!',
            'marca.string' => 'O campo MARCA deve ser uma string!'
        ];
    }
}

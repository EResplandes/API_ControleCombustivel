<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BombaRequest extends FormRequest
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
            'local' => 'required|string',
            'numero_bomba' => 'required|integer'
        ];
    }

    public function messages()
    {
        return [
            'local.required' => 'O campo LOCAL é obrigatório!',
            'local.string' => 'O campo LOCAL precisa ser um texto',
            'numero_bomba.required' => 'O campo NUMERO DA BOMBA é obrigatório!',
            'numero_bomba.integer' => 'O campo NUMERO DA BOMBA deve ser um número!'
        ];
    }
}

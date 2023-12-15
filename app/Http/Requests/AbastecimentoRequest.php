<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AbastecimentoRequest extends FormRequest
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
            'Quantidade_ML' => 'required',
            'uid_funcionario' => 'required',
            'uid_veiculo' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'Quantidade_ML.required' => 'A quantidade de ML é obrigatória!',
            'uid_funcionario.required' => 'O identificador do funcionário é obrigatório!',
            'uid.veiculo.required' => 'O identificador do veículo é obrigatório!'
        ];
    }
}

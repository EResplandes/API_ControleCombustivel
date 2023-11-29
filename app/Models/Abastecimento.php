<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abastecimento extends Model
{
    use HasFactory;

    protected $fillable = ['Quantidade_ML', 'uid_funcionario', 'uid_veiculo'];

    public function rules(){
        return [
            'Quantidade_ML' => 'required',
            'uid_funcionario' => 'required',
            'uid_veiculo' => 'required'
        ];
    }

    public function feedback(){
        return [
            'Quantidade_ML.required' => 'A quantidade de ML é obrigatória!',
            'uid_funcionario.required' => 'O identificador do funcionário é obrigatório!',
            'uid.veiculo.required' => 'O identificador do veículo é obrigatório!'
        ];
    }

}

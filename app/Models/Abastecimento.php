<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;



class Abastecimento extends Model
{
    use HasFactory;

    protected $fillable = ['Quantidade_ML', 'uid_funcionario', 'uid_veiculo', 'uid_bomba'];
    protected $dates = ['created_at', 'updated_at'];

    public function funcionario()
    {
        return $this->BelongsTo(Funcionario::class, 'uid_funcionario', 'uid');
    }

    public function veiculo()
    {
        return $this->BelongsTo(Veiculo::class, 'uid_veiculo', 'tag');
    }

    public function bomba()
    {
        return $this->BelongsTo(Bomba::class, 'uid_bomba', 'id');
    }


    public function rules(){
        return [
            'Quantidade_ML' => 'required',
            'uid_funcionario' => 'required',
            'uid_veiculo' => 'required',
            'uid_bomba' => 'required'
        ];
    }

    public function feedback(){
        return [
            'Quantidade_ML.required' => 'A quantidade de ML é obrigatória!',
            'uid_funcionario.required' => 'O identificador do funcionário é obrigatório!',
            'uid_veiculo.required' => 'O identificador do veículo é obrigatório!',
            'uid_bomba.required' => 'O identificador da bomba é obrigatório!'
        ];
    }

}

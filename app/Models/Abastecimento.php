<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Frentista;

class Abastecimento extends Model
{
    use HasFactory;

    protected $fillable = [
        'Quantidade_ML',
        'maquina',
        'placa',
        'horimetro',
        'responsavel_maquina',
        'id_bomba',
        'id_frentista',
        'id_veiculo'
    ];

    protected $hidden = [
        'id_veiculo',
        'updated_at'
    ];

    protected $dates = ['created_at', 'updated_at'];

    public function frentista()
    {
        return $this->belongsTo(User::class, 'id_frentista');
    }

    public function veiculo()
    {
        return $this->belongsTo(Veiculo::class, 'id_veiculo');
    }

    public function local()
    {
        return $this->belongsTo(Local::class, 'id_local');
    }

    public function rules()
    {
        return [
            'Quantidade_ML' => 'required',
            'uid_funcionario' => 'required',
            'uid_veiculo' => 'required',
            'uid_bomba' => 'required'
        ];
    }

    public function feedback()
    {
        return [
            'Quantidade_ML.required' => 'A quantidade de ML é obrigatória!',
            'uid_funcionario.required' => 'O identificador do funcionário é obrigatório!',
            'uid_veiculo.required' => 'O identificador do veículo é obrigatório!',
            'uid_bomba.required' => 'O identificador da bomba é obrigatório!'
        ];
    }
}

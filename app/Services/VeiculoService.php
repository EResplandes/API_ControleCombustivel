<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\Veiculo;

class VeiculoService
{

    public function buscaVeiculos(){

        return DB::table('veiculos')->get(); // Busca todos os veículos

    }

    public function deletaVeiculo($id){

        return DB::table('veiculos')->where('id', $id)->delete(); // Deleto o veículo de acordo com o id

    }

    public function registraVeiculo($request){
        
        $dados = [
            'tag' => $request->input('tag'),
            'placa' => $request->input('placa'),
            'modelo' => $request->input('modelo'),
            'marca' => $request->input('marca')
        ];
        
        return DB::table('veiculos')->insert($dados); // Cadastra veículo no banco de dados

    }

}

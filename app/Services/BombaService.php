<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\Bomba;

class BombaService
{

    public function getAll()
    {   

        return Bomba::get(); // Busca todas as bombas
       
    }

    public function registraBomba($request)
    {

        // Armazena informações necessárias para inserir no banco de dados
        $dados = [
          'local' => $request->input('local'),
          'numero_bomba' => $request->input('numero_bomba')  
        ];

        return DB::table('bombas')->insert($dados); // Cadastra a bomba

    }

    public function deletaBomba($id)
    {

        return DB::table('bombas')->where('id', $id)->delete(); // Deleta bomba de acordo com id

    }

}

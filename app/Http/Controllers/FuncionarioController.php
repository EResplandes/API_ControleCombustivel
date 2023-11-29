<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Funcionario;
use Illuminate\Support\Facades\DB;

class FuncionarioController extends Controller
{
    
    protected $funcionario;

    public function __construct(Funcionario $funcionario)
    {
        $this->funcionario = $funcionario;
    }

    public function buscaFuncionario($uid){

        if(!is_numeric($uid)){
            return response()->json(['Erro:' => 'O UID deve ser um inteiro!']); // Retornando resposta de erro para requisição
        } elseif (is_null($uid)){
            return response()->json(['Erro:' => 'O UID deve ser um inteiro!']); // Retornando resposta de erro para requisição
        } else {

            $queryBuscaUID = DB::table('funcionarios')->where('uid', $uid)->count();
            $queryFuncionario = DB::table('funcionarios')->where('uid', $uid)->get();

            if($queryBuscaUID == 0) {
                return response()->json(['Status' => 'Não Autorizado!'], 400); // Retornando resposta de erro para requisição
            } else {
                return response()->json(['Status'=> 'Autorizado!'], 200); // Retornando resposta de erro para requisição
            }

        }
    }
}

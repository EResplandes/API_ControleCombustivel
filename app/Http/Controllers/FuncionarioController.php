<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Funcionario;
use Illuminate\Support\Facades\DB;
use App\Services\FuncionarioService;
use App\Http\Requests\FuncionarioRequest;

class FuncionarioController extends Controller
{
    
    protected $funcionario;
    protected $funcionarioService;

    public function __construct(Funcionario $funcionario, FuncionarioService $funcionarioService)
    {
        $this->funcionario = $funcionario;
        $this->funcionarioService = $funcionarioService;
    }

    public function buscaFuncionarios()
    {

        $dados = $this->funcionarioService->buscaFuncionarios();
        return response()->json(['Resposta' => $dados]); // Retornando resposta para requisição

    }

    public function registraFuncionario(FuncionarioRequest $request)
    {

        $this->funcionarioService->registraFuncionario($request);
        return response()->json(['Resposta' => 'O funcionário foi cadastrado com sucesso!']);

    }

    public function deletaFuncionario($id)
    {

        $this->funcionarioService->deletaFuncionario($id);
        return response()->json(['Resposta' => 'O funcionário foi deletado com sucesso!']);

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

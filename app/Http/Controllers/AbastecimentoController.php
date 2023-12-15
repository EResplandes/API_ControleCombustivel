<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Abastecimento;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Services\AbastecimentoService;
use App\Http\Requests\AbastecimentoRequest;

class AbastecimentoController extends Controller
{
    protected $Abastecimento;
    protected $abastecimentoService;

    public function __construct(Abastecimento $Abastecimento, AbastecimentoService $abastecimentoService)
    {
        $this->Abastecimento = $Abastecimento;
        $this->abastecimentoService = $abastecimentoService;
    }

    public function cadastroAbastecimento(Request $request)
    {

        $validator = Validator::make($request->all(), $this->Abastecimento->rules(), $this->Abastecimento->feedback());

        // Verificando se ouve erro no validator
        if ($validator->fails()) {

            return response()->json(['Erro' => $validator->errors()], 422); // Retornando o erro para a requisição

        } else {

            Abastecimento::create($request->all());

            return response()->json(['Mensagem:' => 'Cadastro realizado com sucesso!']); // Retornando resposta para a requisição

        }
    }

    public function verificaAPI()
    {
        return true;
    }

    public function verificaVeiculo(Request $request)
    {

        $tag = $request->input('tag');

        $query = DB::table('veiculos')->where('tag', $tag)->count();

        if ($query == 0) {
            return response()->json(false); // retorna resposta para a requisição
        } else {
            return response()->json(true); // retorna resposta para a requisição
        }

    }

    public function sincronizaVeiculo()
    {
        
        $dados = DB::table('veiculos')->select('tag')->get();
        
        return response()->json($dados); // retorna resposta para a requisição

    }

    public function buscaAbastecimento()
    {

        $dados = $this->abastecimentoService->getAll();

        return response()->json(['Resposta' => $dados]);

    }

}

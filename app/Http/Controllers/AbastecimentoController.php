<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Abastecimento;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class AbastecimentoController extends Controller
{
    protected $Abastecimento;

    public function __construct(Abastecimento $Abastecimento)
    {
        $this->Abastecimento = $Abastecimento;
    }

    public function cadastroAbastecimento(Request $request)
    {

        $validator = Validator::make($request->all(), $this->Abastecimento->rules(), $this->Abastecimento->feedback());

        // Verificando se ouve erro no validator
        if ($validator->fails()) {

            return response()->json(['Erro' => $validator->errors()], 422); // Retornando o erro para a requisição

        } else {

            $dados = [
                'Quantidade_ML' => $request->input('Quantidade_ML'),
                'uid_funcionario' => $request->input('uid_funcionario'),
                'uid_veiculo' => $request->input('uid_veiculo'),
            ];

            DB::table('abastecimentos')->insert($dados); // Inserindo dados na tabela

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

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Abastecimento;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Services\AbastecimentoService;

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
            return response()->json(false); // Retorna resposta para a requisição
        } else {
            return response()->json(true); // Retorna resposta para a requisição
        }
    }

    public function sincronizaVeiculo()
    {

        $dados = DB::table('veiculos')->select('tag')->get();
        return response()->json($dados); // Retorna resposta para a requisição

    }

    public function buscaAbastecimentoFrentista($id)
    {

        $query = $this->abastecimentoService->getAllFrentista($id);
        return response()->json(['resposta' => $query['resposta'], 'abastecimentos' => $query['abastecimentos'], 'totalML' => $query['totalML'], 'totalAbastecimentos' =>  $query['totalAbastecimentos']], $query['status']); // Retornando resposta para a requisição

    }

    public function buscaLitros()
    {

        $dados = $this->abastecimentoService->buscaLitros();
        return response()->json(['Resposta' => $dados]); // Retorna resposta para a requisição

    }

    public function informaAbastecimento(Request $request, $id)
    {

        $query = $this->abastecimentoService->informaAbastecimento($request, $id); // Metódo responsável por informar dados no abastecimento
        return response()->json(['resposta' => $query['resposta']], $query['status']); // Retorna resposta para a requisição

    }

    public function pegaTotalLitros()
    {
        $query = $this->abastecimentoService->pegaTotalLitros(); // Metódo responsável por buscar o total de ml por bomba
        return response()->json(['resposta' => $query['resposta'], 'quantidades' => $query['quantidades']], $query['status']);
    }

    public function buscaAbastecimentosGeral()
    {
        $query = $this->abastecimentoService->buscaAbastecimentosGeral(); // Metódo responsável por buscar todos abastecimentos
        return response()->json(['resposta' => $query['resposta'], 'abastecimentos' => $query['abastecimentos']], $query['status']);
    }
}

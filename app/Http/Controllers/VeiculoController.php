<?php

namespace App\Http\Controllers;

use App\Http\Requests\VeiculoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\VeiculoService;

class VeiculoController extends Controller
{

    protected $veiculoService;

    public function __construct(VeiculoService $veiculoService)
    {
        $this->veiculoService = $veiculoService;
    }

    // Funções do ESP32
    public function index()
    {

        $veiculos = DB::table('veiculos')->select('tag')->get();

        $teste = "|";

        foreach ($veiculos as $item) {
            $teste .= $item->tag . "|";
        }

        return response()->json($teste);
    }

    public function qtdVeiculo()
    {

        $qtd = DB::table('veiculos')->count();

        return response()->json($qtd);
    }

    public function cadastraVeiculo(Request $request)
    {

        $dados = [
            'tag' => $request->input('tag'),
        ];

        DB::table('veiculos')->insert($dados);

        return true;
    }

    // Funções da Aplicação Web
    public function buscaVeiculos()
    {
        $dados = $this->veiculoService->buscaVeiculos();
        return response()->json(['Resposta' => $dados]);
    }

    public function deletaVeiculo($id)
    {
        $this->deletaVeiculo($id);
        return response()->json(['Resposta' => 'Veículo deletado com sucesso!']);
    }

    public function registraVeiculo(VeiculoRequest $request)
    {
        $this->registraVeiculo($request);
        return response()->json(['Resposta' => 'Veículo cadastrado com sucesso!']);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class VeiculoController extends Controller
{
    public function index(){

        $veiculos = DB::table('veiculos')->select('tag')->get();

        $teste = "|";

        foreach($veiculos as $item){
            $teste .= $item->tag ."|";
        }

        return response()->json($teste);

    }

    public function qtdVeiculo(){

        $qtd = DB::table('veiculos')->count();

        return response()->json($qtd);

    }

    public function cadastraVeiculo(Request $request){

        $dados = [
            'tag' => $request->input('tag'),
        ];

        DB::table('veiculos')->insert($dados);

        return true;

    }

}

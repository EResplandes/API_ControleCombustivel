<?php

namespace App\Services;

use App\Http\Resources\AbastecimentoResource;
use Illuminate\Support\Facades\DB;
use App\Models\Abastecimento;
use App\Models\Bomba;
use DateTime;

use App\Http\Resources\BombaResource;

class AbastecimentoService
{


    public function getAll()
    {

        // Buscando todos os abastecimentos
        $registros = Abastecimento::select(
            'abastecimentos.id',
            'abastecimentos.Quantidade_ML',
            'abastecimentos.created_at',
            'funcionarios.nome_completo',
            'funcionarios.empresa',
            'veiculos.placa',
            'veiculos.modelo',
        )
            ->join('funcionarios', 'funcionarios.uid', '=', 'abastecimentos.uid_funcionario')
            ->join('veiculos', 'veiculos.tag', '=', 'abastecimentos.uid_veiculo')
            ->join('bombas', 'bombas.id', '=', 'abastecimentos.uid_bomba')
            ->selectRaw('DATE_FORMAT(abastecimentos.created_at, "%d/%m/%Y %H:%i:%s") as data_formatada')
            ->get();

        return $registros;

        // return AbastecimentoResource::collection(Abastecimento::all());
    }

    public function getAllLimited()
    {
        
        // Buscando todos os abastecimentos com um limite de 20
        $registros = Abastecimento::select(
            'abastecimentos.id',
            'abastecimentos.Quantidade_ML',
            'abastecimentos.created_at',
            'funcionarios.nome_completo',
            'funcionarios.empresa',
            'veiculos.placa',
            'veiculos.modelo',
            'bombas.local'
        )
            ->join('funcionarios', 'funcionarios.uid', '=', 'abastecimentos.uid_funcionario')
            ->join('veiculos', 'veiculos.tag', '=', 'abastecimentos.uid_veiculo')
            ->join('bombas', 'bombas.id', '=', 'abastecimentos.uid_bomba')
            ->selectRaw('DATE_FORMAT(abastecimentos.created_at, "%d/%m/%Y %H:%i:%s") as data_formatada')
            ->orderBy('abastecimentos.id', 'desc')
            ->limit(20)
            ->get();

        return $registros;

    }

    public function buscaLitros()
    {

        // Pegando data atual
        $date = new DateTime();  
        $hoje = $date->format('Y-m-d');

        // Busca todos os abastecimentos
        $resultadosTotal = DB::table('abastecimentos')
        ->select('uid_bomba', DB::raw('SUM(Quantidade_ML) as total_quantidade'))
        ->groupBy('uid_bomba')
        ->get();

        // Buscas todos os abastecimentos de hoje
        $resultadoshoje = 
        DB::table('abastecimentos')
        ->select('uid_bomba', DB::raw('SUM(Quantidade_ML) as total_quantidade'))
        ->whereDate('created_at', $hoje) 
        ->groupBy('uid_bomba')
        ->get();

        // Retornando resposta
        return [
            'Total' => $resultadosTotal, 
            'Hoje' => $resultadoshoje
        ];

    }
}

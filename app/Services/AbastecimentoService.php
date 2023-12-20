<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\Abastecimento;

class AbastecimentoService
{

    // public function getAll()
    // {
    //     // Retornando todos os abastecimentos com a data do padrão pt-br
    //     return DB::table('abastecimentos')->selectRaw('*, DATE_FORMAT(created_at, "%d/%m/%Y %H:%i:%s") as data_formatada')->get();

    // }

    public function getAll()
    {   

        $registros = Abastecimento::select(
            'abastecimentos.id', 
            'abastecimentos.Quantidade_ML', 
            'abastecimentos.created_at', 
            'funcionarios.nome_completo', 
            'funcionarios.empresa', 
            'veiculos.placa', 
            'veiculos.modelo'
        )
        ->join('funcionarios', 'funcionarios.uid', '=', 'abastecimentos.uid_funcionario')
        ->join('veiculos', 'veiculos.tag', '=', 'abastecimentos.uid_veiculo')
        ->join('bombas', 'bombas.id', '=', 'abastecimentos.uid_bomba')
        ->selectRaw('DATE_FORMAT(abastecimentos.created_at, "%d/%m/%Y %H:%i:%s") as data_formatada')
        ->get();

        return $registros;
    }

}

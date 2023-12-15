<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\Abastecimento;

class AbastecimentoService
{

    public function getAll()
    {

        // Retornando todos os abastecimentos com a data do padrão pt-br
        return DB::table('abastecimentos')->selectRaw('*, DATE_FORMAT(created_at, "%d/%m/%Y %H:%i:%s") as data_formatada')->get();

    }


}

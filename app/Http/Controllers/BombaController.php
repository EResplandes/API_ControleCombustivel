<?php

namespace App\Http\Controllers;

use App\Http\Requests\BombaRequest;
use Illuminate\Http\Request;
use App\Models\Bomba;
use App\Services\BombaService;

class BombaController extends Controller
{
    
    protected $bomba;
    protected $bombaService;

    public function __construct(Bomba $bomba, BombaService $bombaService)
    {
        $this->bomba = $bomba;
        $this->bombaService = $bombaService;
    }

    public function buscaBombas()
    {

        $dados = $this->bombaService->getAll(); // Metódo responsável por buscar todas as bombas
        return response()->json(['Resposta' => $dados]); // Retornando resposta

    }

    public function registraBomba(BombaRequest $request)
    {

        $this->bombaService->registraBomba($request); // Metódo responsável por cadastrar bomba
        return response()->json(['Resposta' => 'Bomba cadastrada com sucesso!']); // Retornando resposta

    }

    public function deletaBomba($id)
    {

        $this->bombaService->deletaBomba($id); // Metódo responsável por deletar bomba
        return response()->json(['Resposta' => 'Bomba deletada com sucesso!']); // Retornando resposta

    }

}

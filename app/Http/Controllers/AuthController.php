<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;

class AuthController extends Controller
{
    
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(Request $request){


       $query = $this->authService->autenticacao($request); // Verifica se o usuário está cadastrado
        return response()->json(['Resposta' => $query]);  // Retornando resposta para o usuário

    }

    public function logout(Request $request) {

        $query = $this->authService->sair($request); // Colocando token da blacklist
        return response()->json(['Resposta' => 'Usuário deslogado com sucesso!']);

    }


}

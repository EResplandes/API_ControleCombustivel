<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\Bomba;

class AuthService
{

    public function autenticacao($request)
    {

        $credenciais = $request->all(['email', 'password']);
        $email = $request->input('email');

        $token = auth('api')->attempt($credenciais); // Verificando se o usuário existe

        if ($token == false) {
            $token = 'Usuário ou senha inválidos!';
            return $token;
        } else {

            $informações = DB::table('users')
            ->select('id', 'name', 'email', 'tipo_usuario')
            ->where('email', $email)
            ->get();

            return ['Token' => $token, 'Usuário'=> $informações];
        }

    }

    public function sair($request)
    {

        $token = $request->input('token');
        $query = auth('api')->logout($token); // Colocando token na blacklist

        return $query;

    }
}

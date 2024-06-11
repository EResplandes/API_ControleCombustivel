<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;
use DateTime;


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
                ->select('id', 'name', 'email', 'id_local', 'id_tipo')
                ->where('email', $email)
                ->get();

            return ['token' => $token, 'usuario' => $informações];
        }
    }

    public function verificaToken($request)
    {

        // Pegando token
        $tokenString = $request->input('token');

        // Pegando data e hora atual
        date_default_timezone_set('America/Sao_Paulo');
        $dataAtual = date('Y-m-d H:i:s');

        $payload = JWTAuth::getPayload($tokenString)->toArray();

        // Pegando datas
        $dataExpira = $payload['exp'];

        // Convertendo para objetos DateTime
        $expDate = new DateTime("@$dataExpira");

        // Verifica token
        if ($expDate < $dataAtual) {
            return 'O token não é mais valído!';
        } else {
            return 'O token está valído!';
        }
    }

    public function sair($request)
    {

        $token = $request->input('token');
        $query = auth('api')->logout($token); // Colocando token na blacklist

        return $query;
    }
}

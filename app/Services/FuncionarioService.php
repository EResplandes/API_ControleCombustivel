<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\Funcionario;

class FuncionarioService
{

    public function buscaFuncionarios()
    {

        return DB::table('funcionarios')->get(); // Busca todos funcionários

    }

    public function registraFuncionario($request)
    {

        $cpf_formatado = $this->formatarCpf($request->input('cpf'));

        $dados = [
            'nome_completo' => $request->input('nome_completo'),
            'cpf' => $cpf_formatado,
            'empresa' => $request->input('empresa')
        ];

        return DB::table('funcionarios')->insert($dados); // Cadastra novo funcionário

    }

    public function deletaFuncionario($id)
    {

        return DB::table('funcionarios')->where('uid', $id)->delete(); // Deleta funcionário de acordo com id

    }

    public function formatarCpf($cpf)
    {
        // Remove caracteres não numéricos
        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        // Adiciona zeros à esquerda para garantir 11 dígitos
        $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);

        // Formata o CPF
        $cpfFormatado = substr_replace($cpf, '.', 3, 0);
        $cpfFormatado = substr_replace($cpfFormatado, '.', 7, 0);
        $cpfFormatado = substr_replace($cpfFormatado, '-', 11, 0);

        return $cpfFormatado;
    }
}

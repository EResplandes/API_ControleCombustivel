<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\Funcionario;

class FuncionarioService
{

    public function buscaFuncionarios()
    {

        // Buscando todos os funcionários
        return Funcionario::select('funcionarios.id', 'funcionarios.nome_completo', 'funcionarios.cpf', 'funcionarios.empresa', 'funcionarios.uid', 'bombas.local', 'bombas.numero_bomba')
        ->join('bombas', 'funcionarios.fk_bomba', '=', 'bombas.id')
        ->get();


    }

    public function registraFuncionario($request)
    {

        $cpf_formatado = $this->formatarCpf($request->input('cpf')); // Formata cpf com caracteres padrões

        // Armazenando informações ncessárias para inserir no banco de dados
        $dados = [
            'uid' => $request->input('uid'),
            'nome_completo' => $request->input('nome_completo'),
            'cpf' => $cpf_formatado,
            'empresa' => $request->input('empresa'),
            'fk_bomba' => 1
        ];

        return DB::table('funcionarios')->insert($dados); // Cadastra novo funcionário

    }

    public function deletaFuncionario($id)
    {

        return DB::table('funcionarios')->where('id', $id)->delete(); // Deleta funcionário de acordo com id

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

        return $cpfFormatado; // Retorna o cpf formatado
    }
}

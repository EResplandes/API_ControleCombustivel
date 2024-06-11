<?php

namespace App\Services;

use App\Http\Resources\AbastecimentoResource;
use Illuminate\Support\Facades\DB;
use App\Models\Abastecimento;
use DateTime;
use Illuminate\Http\Response;

class AbastecimentoService
{
    public function getAllFrentista($id)
    {

        DB::beginTransaction();

        try {

            // 1º Passo -> Buscar todos abastecimentos
            $query = AbastecimentoResource::collection(
                Abastecimento::orderBy('id', 'desc')
                    ->where('id_local', $id)
                    ->get()
            );

            // 2º Passo -> Verificar quantidade de litros abastecidos
            $totalML = Abastecimento::where('id_local', $id)->sum('Quantidade_ML');


            // 3º Passo -> Verificar quantidade de abastecimentos
            $totalAbastecimentos = Abastecimento::where('id_local', $id)->count('id');

            // 2º Passo -> Retornando resposta
            return [
                'resposta' => 'Abastecimentos listados com sucesso!',
                'abastecimentos' => $query,
                'totalAbastecimentos' => $totalAbastecimentos,
                'totalML' => $totalML,
                'status' => Response::HTTP_OK
            ];
        } catch (\Exception $e) {
            DB::rollback(); // Se uma exceção ocorrer durante as operações do banco de dados, fazemos o rollback

            return ['resposta' => $e, 'status' => Response::HTTP_INTERNAL_SERVER_ERROR];

            throw $e;
        }
    }

    public function buscaAbastecimentosGeral()
    {
        // 1º Passo -> Buscar todos abastecimentos
        $query = AbastecimentoResource::collection(
            Abastecimento::orderBy('id', 'desc')
                ->get()
        );

        // 2º Passo -> Retornar abastecimentos
        if ($query) {
            return ['resposta' => 'Abastecimentos listados com sucesso!', 'abastecimentos' => $query, 'status' => Response::HTTP_OK];
        } else {
            return ['resposta' => 'Ocorreu algum erro, entre em contato com o Administrador', 'abastecimentos' => null, 'status' => Response::HTTP_INTERNAL_SERVER_ERROR];
        }
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

    public function informaAbastecimento($request, $id)
    {
        // 1º Passo -> Montar o array a ser atualizado
        $query = Abastecimento::where('id', $id)->update([
            'maquina' => strtoupper($request->input('maquina')),
            'placa' => strtoupper($request->input('placa')),
            'horimetro' => $request->input('horimetro'),
            'responsavel_maquina' => strtoupper($request->input('motorista'))
        ]);

        // 2º Passo -> Retornar resposta
        if ($query) {
            return ['resposta' => 'Dados informados com sucesso!', 'status' => Response::HTTP_ACCEPTED];
        } else {
            return ['resposta' => 'Ocorreu algum erro, entre em contato com o Administrador!', 'status' => Response::HTTP_INTERNAL_SERVER_ERROR];
        }
    }

    public function pegaTotalLitros()
    {
        // 1º Passo -> Pegar todos abastecimentos e agrupar pelo id do local
        $query = Abastecimento::select('id_local', DB::raw('SUM(Quantidade_ML) as total_quantidade_ml'))
            ->groupBy('id_local')
            ->get();


        // 2º Passo -> Retornar resposta
        if ($query) {
            return ['resposta' => 'Quantidades listadas com sucesso!', 'quantidades' => $query, 'status' => Response::HTTP_OK];
        } else {
            return ['resposta' => 'Ocorreu algum erro, entre em contato com o Administrador!', 'status' => Response::HTTP_INTERNAL_SERVER_ERROR];
        }
    }
}

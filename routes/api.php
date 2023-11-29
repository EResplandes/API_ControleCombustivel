<?php

use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\AbastecimentoController;
use App\Http\Controllers\VeiculoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('funcionario')->group(function(){
    Route::get('/busca/{uid}', [FuncionarioController::class, 'buscaFuncionario'])->name('busca-funcionario');
});

Route::prefix('abastecimento')->group(function(){
    Route::post('/cadastro', [AbastecimentoController::class, 'cadastroAbastecimento'])->name('cadastro-abastecimento');
    Route::get('/verifica', [AbastecimentoController::class, 'verificaAPI'])->name('verificaAPIs');
    Route::post('/verificaVeiculo', [AbastecimentoController::class, 'verificaVeiculo'])->name('verificaVeiculo');
});

Route::prefix('veiculo')->group(function(){
    Route::get('/busca', [VeiculoController::class, 'index'])->name('veiculo-index');
    Route::get('/qtd', [VeiculoController::class, 'qtdVeiculo'])->name('veiculo-qtd');
    Route::post('/cadastro', [VeiculoController::class, 'cadastraVeiculo']);
});


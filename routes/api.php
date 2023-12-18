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

// Rotas utilizadas no ESP32
Route::prefix('funcionario')->group(function () {
    Route::get('/busca/{uid}', [FuncionarioController::class, 'buscaFuncionario'])->name('busca-funcionario');
});

Route::prefix('abastecimento')->group(function () {
    Route::post('/cadastro', [AbastecimentoController::class, 'cadastroAbastecimento'])->name('cadastro-abastecimento');
    Route::get('/verifica', [AbastecimentoController::class, 'verificaAPI'])->name('verificaAPIs');
    Route::post('/verificaVeiculo', [AbastecimentoController::class, 'verificaVeiculo'])->name('verificaVeiculo');
});

Route::prefix('veiculo')->group(function () {
    Route::get('/busca', [VeiculoController::class, 'index'])->name('veiculo-index');
    Route::get('/qtd', [VeiculoController::class, 'qtdVeiculo'])->name('veiculo-qtd');
    Route::post('/cadastro', [VeiculoController::class, 'cadastraVeiculo']);
});

// Rotas utilizadas no Sistema Web 
Route::prefix('web')->group(function () {

    Route::get('/painel', [AbastecimentoController::class, 'buscaAbastecimento']);

    Route::prefix('veiculos')->group(function () {
        Route::get('/busca', [VeiculoController::class, 'buscaVeiculos']);
        Route::delete('/deleta/{id}', [VeiculoController::class, 'deletaVeiculo'])->middleware('VerificaID');
        Route::post('/cadastro', [VeiculoController::class, 'registraVeiculo']);
    });

    Route::prefix('funcionarios')->group(function() {
        Route::get('/busca', [FuncionarioController::class, 'buscaFuncionarios']);
        Route::delete('/deleta/{id}', [FuncionarioController::class, 'deletaFuncionario'])->middleware('VerificaID');
        Route::post('/cadastro', [FuncionarioController::class, 'registraFuncionario']);
    });

});

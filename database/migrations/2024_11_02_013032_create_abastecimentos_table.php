<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abastecimentos', function (Blueprint $table) {
            $table->id();
            $table->float('Quantidade_ML');
            $table->string('maquina')->nullable();
            $table->string('placa')->nullable();
            $table->integer('horimetro')->nullable();
            $table->string('responsavel_maquina')->nullable();
            $table->unsignedBigInteger('id_local')->nullable();
            $table->unsignedBigInteger('id_frentista')->nullable();
            $table->unsignedBigInteger('id_veiculo')->nullable();
            $table->foreign('id_local')->references('id')->on('local');
            $table->foreign('id_frentista')->references('id')->on('users');
            $table->foreign('id_veiculo')->references('id')->on('veiculos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('abastecimentos');
    }
};

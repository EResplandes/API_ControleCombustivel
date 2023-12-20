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
            $table->string('uid_veiculo');
            $table->string('uid_funcionario');
            $table->unsignedBigInteger('uid_bomba');
            $table->foreign('uid_funcionario')->references('uid_funcionario')->on('funcionarios');
            $table->foreign('uid_veiculo')->references('uid_veiculo')->on('veiculos');
            $table->foreign('uid_bomba')->references('id')->on('bombas');
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
        //
    }
};

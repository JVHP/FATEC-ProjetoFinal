<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TabelaDadosCarroUsuario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalhes_carro_usuario', function (Blueprint $table) {
            $table->id();
            $table->integer('id_carro_usuarios');
            $table->integer('qt_kilometragem');
            $table->integer('qt_media_kilometragem');
            $table->date('dt_ultima_troca_oleo');
            $table->foreign('id_carro_usuarios')->references('id')->on('carro_usuarios');
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
        Schema::dropIfExists('detalhes_carro_usuario');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarroUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carro_usuarios', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_carro')->unsigned();
            $table->bigInteger('id_usuario')->unsigned();
            $table->timestamps();
            $table->foreign('id_carro')->references('id')->on('carros');
            $table->foreign('id_usuario')->references('id')->on('usuarios');
            $table->unique(['id_carro', 'id_usuario']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carro__usuarios');
    }
}

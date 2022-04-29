<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePecaPromocaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peca_promocaos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_peca')->unsigned();
            $table->double('pc_promocao');
            $table->date('dt_vigencia_inicio');
            $table->date('dt_vigencia_fim');
            $table->timestamps();
            $table->foreign('id_peca')->references('id')->on('pecas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peca_promocaos');
    }
}

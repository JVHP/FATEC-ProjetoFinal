<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarroPecasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carro_peca', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('peca_id')->unsigned();
            $table->bigInteger('carro_id')->unsigned();
            $table->timestamps();
            $table->foreign('peca_id')->references('id')->on('pecas');
            $table->foreign('carro_id')->references('id')->on('carros');
            $table->unique(['peca_id', 'carro_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carro_peca');
    }
}

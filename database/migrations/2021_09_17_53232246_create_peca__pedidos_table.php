<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePecaPedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peca_pedidos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_peca')->unsigned();
            $table->bigInteger('id_pedido')->unsigned();
            $table->integer('qt_peca');
            $table->double('vl_total_peca');
            $table->timestamps();
            $table->foreign('id_peca')->references('id')->on('pecas');
            $table->foreign('id_pedido')->references('id')->on('pedidos');
            $table->unique(['id_peca', 'id_pedido']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peca__pedidos');
    }
}

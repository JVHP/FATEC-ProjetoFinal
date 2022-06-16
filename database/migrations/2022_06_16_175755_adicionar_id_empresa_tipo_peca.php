<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdicionarIdEmpresaTipoPeca extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("tipo_pecas", function(Blueprint $table) {
            $table->integer('id_empresa')->unsigned()->nullable();
            $table->foreign('id_empresa')->references('id')->on('empresas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("tipo_pecas", function(Blueprint $table) {
            $table->dropColumn('id_empresa');
        });
    }
}

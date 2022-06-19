<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoverCampoIdResponsavelEmpresa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('empresas', function (Blueprint $table) {
            $table->dropColumn('id_responsavel');
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('empresas', function (Blueprint $table) {
            $table->string("id_responsavel");
            $table->foreign('id_responsavel')->references('id')->on('users');
            //
        });
    }
}

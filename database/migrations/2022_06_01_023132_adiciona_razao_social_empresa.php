<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdicionaRazaoSocialEmpresa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('empresas', function (Blueprint $table) {
            $table->string('razao_social', 500);
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
            $table->dropColumn('razao_social');
        });
    }
}

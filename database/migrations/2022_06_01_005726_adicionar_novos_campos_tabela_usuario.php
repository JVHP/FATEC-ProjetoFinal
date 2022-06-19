<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdicionarNovosCamposTabelaUsuario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('ck_tipo_cadastro', 5)->nullable();
            $table->string('cnpj_empresa_cadastrada', 14)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('ck_tipo_cadastro');
            $table->dropColumn('cnpj_empresa_cadastrada');
        });
    }
}

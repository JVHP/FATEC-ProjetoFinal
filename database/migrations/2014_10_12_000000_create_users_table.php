<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('cpf', 11);
            $table->string('nm_usuario', 100); 
            $table->string('email')->unique();
            $table->date('dt_nasc');
            $table->string('cep', 8);
            $table->string('nm_rua', 255);
            $table->string('ds_bairro', 255);
            $table->integer('nr_casa');
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            //$table->string('cd_cartao')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}

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
            $table->string('nm_usuario', 100); 
            $table->integer('cd_idade'); 
            $table->string('password');
            $table->string('ds_endereco', 100); 
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('cd_cartao')->default('vazio');
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

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TablaUsers extends Migration
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
            $table->string('email')->unique();
            $table->string('username');
            $table->string('password');
            $table->string('name');
            $table->string('lastname');
            $table->string('telefono');
            $table->string('fotoPerfil');

            $table->timestamp('email_verified_at')->nullable();
            $table->foreignId('idTipoUsuario')->unsigned();
            $table->foreignId('idDireccion')->unsigned();
            $table->boolean('verificado');
            $table->string('rememberToken');
            $table->string('verificationToken',40);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('idTipoUsuario')->references('id')->on('tipoUsuarios');
            $table->foreign('idDireccion')->references('id')->on('direcciones');
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

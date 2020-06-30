<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TablaMensajes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mensajes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idUsuarioEmisor');
            $table->foreignId('idUsuarioReceptor');
            $table->foreignId('idServicioContratado');
            $table->string('mensaje',500);
            $table->timestamp('fechaEnvio');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('idUsuarioEmisor')->references('id')->on('users');
            $table->foreign('idUsuarioReceptor')->references('id')->on('users');
            $table->foreign('idServicioContratado')->references('id')->on('serviciosContratados');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mensajes');
    }
}

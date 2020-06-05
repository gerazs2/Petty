<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TablaCalificaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calificaciones', function (Blueprint $table) {
            $table->id();
            $table->integer('calificacion');
            $table->string('comentario',500);
            $table->timestamp('fechaCalificacion');
            $table->foreignId('idServicio');
            $table->foreignId('idUsuarioContrato');
            $table->foreignId('idUsuarioPrestador');
            $table->foreignId('idServicioContratado');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('idServicio')->references('id')->on('servicios');
            $table->foreign('idUsuarioContrato')->references('id')->on('users');
            $table->foreign('idUsuarioPrestador')->references('id')->on('users');
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
        Schema::dropIfExists('calificaciones');
    }
}

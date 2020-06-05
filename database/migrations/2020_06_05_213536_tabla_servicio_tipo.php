<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TablaServicioTipo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicioTipo', function (Blueprint $table) {
            $table->foreignId('idServicio');
            $table->foreignId('idTipoServicio');
           

            $table->foreign('idServicio')->references('id')->on('servicios');
            $table->foreign('idTipoServicio')->references('id')->on('tipoServicios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servicioTipo');
    }
}

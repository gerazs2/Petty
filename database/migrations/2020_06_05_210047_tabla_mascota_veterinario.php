<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TablaMascotaVeterinario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mascotaVeterinario', function (Blueprint $table) {
            $table->foreignId('idMascota');
            $table->foreignId('idVeterinario');
            $table->boolean('puedeEditar');

            $table->foreign('idMascota')->references('id')->on('mascotas');
            $table->foreign('idVeterinario')->references('id')->on('veterinarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mascotaVeterinario');
    }
}

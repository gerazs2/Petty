<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TablaTratamientos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tratamientos', function (Blueprint $table) {
            $table->id();
            $table->date('fechaTratamiento');
            $table->string('nombreTratamiento');
            $table->text('etiqueta');
            $table->dateTime('proximoTratamiento');
            $table->foreignId('idTipoTratamiento');
            $table->foreignId('idMascota');
            $table->foreignId('idVeterinario');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('idTipoTratamiento')->references('id')->on('tipoTratamientos');
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
        Schema::dropIfExists('tratamientos');
    }
}

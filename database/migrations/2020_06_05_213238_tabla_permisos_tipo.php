<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TablaPermisosTipo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permisosTipo', function (Blueprint $table) {
            $table->foreignId('idTipoUsuario');
            $table->foreignId('idPermiso');
           

            $table->foreign('idTipoUsuario')->references('id')->on('tipoUsuarios');
            $table->foreign('idPermiso')->references('id')->on('permisos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permisosTipo');
    }
}

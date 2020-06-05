<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TablaOrganizacionUsuario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizacionUsuario', function (Blueprint $table) {
            $table->foreignId('idUsuario');
            $table->foreignId('idOrganizacion');
            $table->boolean('esAdmin');

            $table->foreign('idUsuario')->references('id')->on('users');
            $table->foreign('idOrganizacion')->references('id')->on('organizaciones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organizacionUsuario');
    }
}

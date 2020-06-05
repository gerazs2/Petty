<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TablaOrganizacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizaciones', function (Blueprint $table) {
            $table->id();
            $table->string('nombreOrg', 50);
            $table->string('emailOrg',255)->unique();
            $table->string('rfc',13)->unique();
            $table->foreignId('idModeloPago')->unsigned();
            $table->foreignId('idDireccion')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('idDireccion')->references('id')->on('direccion');
            $table->foreign('idModeloPago')->references('id')->on('modelosPago');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organizaciones');
    }
}

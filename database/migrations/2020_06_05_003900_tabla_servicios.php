<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TablaServicios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicios', function (Blueprint $table) {
            $table->id();
            $table->string('nombreServicio',100);
            $table->dateTime('horaApertura');
            $table->dateTime('horaCierre');
            $table->double('latitud', 7, 7);
            $table->double('longitud', 7, 7);
            $table->text('descripcion');
            $table->decimal('precioBase',7,2);
            $table->boolean('servicioContinuo');
            $table->foreignId('idUsuario');
            $table->foreignId('idSubcategoria');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('idUsuario')->references('id')->on('users');
            $table->foreign('idSubcategoria')->references('id')->on('subcategorias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servicios');
    }
}

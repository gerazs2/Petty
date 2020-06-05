<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TablaServiciosContratados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('serviciosContratados', function (Blueprint $table) {
            $table->id();
            $table->string('nombreServicio',100);
            $table->text('descripcion');
            $table->decimal('precioBase',5,2);
            $table->string('observacinesFinales',250);
            $table->string('statusServicio',20);
            $table->decimal('costoFinal',5,2);
            $table->dateTime('fechaContrato');
            $table->dateTime('fechaTermino');
            $table->dateTime('fechaEjecucion');
            $table->foreignId('idUsuarioContrato');
            $table->foreignId('idMascota');
            $table->foreignId('idSubcategoria');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('idUsuarioContrato')->references('id')->on('users');       
            $table->foreign('idMascota')->references('id')->on('mascotas');    
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
        Schema::dropIfExists('serviciosContratados');
    }
}

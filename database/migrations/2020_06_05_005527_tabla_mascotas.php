<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TablaMascotas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mascotas', function (Blueprint $table) {
            $table->id();
            $table->string('nombreMascota', 60);
            $table->date('fechaNacimiento');
            $table->string('raza',50);
            $table->string('color', 20);
            $table->decimal('peso',2,3 );
            $table->string('tamaño', 60);
            $table->string('sexo', 20);
            $table->text('senParticulares');
            $table->foreignId('idEspecie');
            $table->foreignId('idUsuario');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('idEspecie')->references('id')->on('especies');
            $table->foreign('idUsuario')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mascotas');
    }
}

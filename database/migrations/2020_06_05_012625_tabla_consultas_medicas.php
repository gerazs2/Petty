<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TablaConsultasMedicas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultasMedicas', function (Blueprint $table) {
            $table->id();
            $table->text('diagnostico');
            $table->text('tratamiento');
            $table->string('comentarios',500);
            $table->timestamp('fechaConsulta');
            $table->foreignId('idMascota');
            $table->foreignId('idVeterinario');
            $table->timestamps();
            $table->softDeletes();

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
        Schema::dropIfExists('consultasMedicas');
    }
}

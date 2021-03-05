<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdServicioCalificadoToServiciosContratadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('serviciosContratados', function (Blueprint $table) {
            //
            $table->boolean('calificado')->default(false);
            $table->foreignId('idServicio')->nullable();
            $table->foreign('idServicio')->references('id')->on('servicios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('serviciosContratados', function (Blueprint $table) {
            //
            $table->dropColumn('idServicio');
            $table->dropColumn('calificado');
            
        });
    }
}

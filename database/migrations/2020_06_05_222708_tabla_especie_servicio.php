<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TablaEspecieServicio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('especieServicio', function (Blueprint $table) {
            $table->foreignId('idEspecie');
            $table->foreignId('idServicio');
           
            $table->foreign('idEspecie')->references('id')->on('especies');
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
        Schema::dropIfExists('especieServicio');
    }
}

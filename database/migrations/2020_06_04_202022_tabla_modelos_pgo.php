<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TablaModelosPgo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modelosPago', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',50);
            $table->string('descripcion', 250);
            $table->integer('diasCorte',2)->unsigned();
            $table->integer('diasLimite',2)->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modelosPago');
    }
}

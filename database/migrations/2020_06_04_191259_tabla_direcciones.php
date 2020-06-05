<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TablaDirecciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direccion', function (Blueprint $table) {
            $table->id();
            $table->string('calle',100);
            $table->string('numExt', 30);
            $table->string('numInt', 30);
            $table->string('referencia',250);
            $table->foreignId('idSepomex')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('idSepomex')->references('id')->on('sepomex');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('direccion');
    }
}

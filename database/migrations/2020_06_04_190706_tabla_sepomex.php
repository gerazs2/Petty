<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TablaSepomex extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sepomex', function (Blueprint $table) {
            $table->id();
            $table->integer('cp')->unsigned();
            $table->string('asentamiento', 100);
            $table->string('tipoAsentamiento',100);
            $table->string('municipio',100);
            $table->string('estado',50);
            $table->string('ciudad',100);
            $table->string('pais', 20);
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
        Schema::dropIfExists('sepomex');
    }
}

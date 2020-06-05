<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TablaTipoServicios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipoServicios', function (Blueprint $table) {
            $table->id();
            $table->string('tipoServicio',100);
            $table->string('descripcion', 250);
            $table->string('tipoServicioEsp',100);
            $table->string('especializacion', 100);
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
        Schema::dropIfExists('tipoServicios');
    }
}

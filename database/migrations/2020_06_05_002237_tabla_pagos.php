<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TablaPagos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->timestamp('fecha');
            $table->decimal('monto', 8, 2);
            $table->string('metodoPago', 20);
            $table->string('status',20);
            $table->string('statusPasarela', 200);
            $table->foreignId('idCorte');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('idCorte')->references('id')->on('cortes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pagos');
    }
}

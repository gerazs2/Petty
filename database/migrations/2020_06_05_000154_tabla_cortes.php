<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TablaCortes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cortes', function (Blueprint $table) {
            $table->id();
            $table->timestamp('fecha');
            $table->string('periodo');
            $table->decimal('monto', 8,2);
            $table->string('status',20);
            $table->boolean('requiereFactura');
            $table->boolean('facturado');
            $table->text('rutaFactura');
            $table->string('folioFiscal');
            $table->dateTime('fechaLimitePago');
            $table->foreignId('idOrganizacion');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('idOrganizacion')->references('id')->on('organizaciones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cortes');
    }
}

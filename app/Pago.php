<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    //importamos la clase para la elimiancion virtual
    use softDeletes;

    //hacemos referencia a la tabla que corresponde el modelo
    protected $table = 'pagos';

    //definimos los campos que seran tratados como fechas
    protected $dates = ['deleted_at','fecha'];

    //definimos los campos que se podran ingresar al crear el registro
    protected $fillable = [
    	'fecha',
    	'monto',
    	'metodoPago',
    	'status',
    	'statusPasarela',
    	'idCorte'
	];
}

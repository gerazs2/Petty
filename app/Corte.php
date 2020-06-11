<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\softDeletes;

class Corte extends Model
{
    //importamos la clase para la elimiancion virtual
    use softDeletes;

    //hacemos referencia a la tabla que corresponde el modelo
    protected $table = 'cortes';

    //definimos los campos que seran tratados como fechas
    protected $dates = ['deleted_at', 'fecha'];

    //definimos los campos que se podran ingresar al crear el registro
    protected $fillable = [
    	'fecha',
    	'periodo',
    	'monto',
    	'status',
    	'requiereFactura',
    	'facturado',
    	'rutaFactura',
    	'folioFiscal',
    	'fechaLimitePago',
    	'idOrganizacion'
	];
}

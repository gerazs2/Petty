<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\softDeletes;

class Mensaje extends Model
{
    //importamos la clase para la elimiancion virtual
    use softDeletes;

    //hacemos referencia a la tabla que corresponde el modelo
    protected $table = 'mensajes';

    //definimos los campos que seran tratados como fechas
    protected $dates = ['deleted_at','fechaEnvio'];

    //definimos los campos que se podran ingresar al crear el registro
    protected $fillable = [
    	'mensaje',
    	'fechaEnvio',
    	'idUsuarioEmisor',
    	'idUsuarioReceptor',
    	'idServicioContratado'
	];
}

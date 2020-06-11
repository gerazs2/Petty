<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\softDeletes;

class Veterinario extends Model
{
    //importamos la clase para la elimiancion virtual
    use softDeletes;

    //hacemos referencia a la tabla que corresponde el modelo
    protected $table = 'veterinarios';

    //definimos los campos que seran tratados como fechas
    protected $dates = ['deleted_at'];

    //definimos los campos que se podran ingresar al crear el registro
    protected $fillable = [
    	'cedula',
    	'curriculum',
    	'titulo',
    	'experiencia',
    	'universidad',
    	'idUsuario'
	];
}

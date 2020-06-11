<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    //importamos la clase para la elimiancion virtual
    use softDeletes;

    //hacemos referencia a la tabla que corresponde el modelo
    protected $table = 'servicios';

    //definimos los campos que seran tratados como fechas
    protected $dates = ['deleted_at','horaApertura','horaCierre'];

    //definimos los campos que se podran ingresar al crear el registro
    protected $fillable = [
    	'nombreServicio',
    	'horaApertura',
    	'horaCierre',
    	'latitud',
    	'longitud',
    	'descripcion',
    	'precioBase',
    	'servicioContinuo',
    	'idUsuario',
    	'idSubcategoria'
	];
}

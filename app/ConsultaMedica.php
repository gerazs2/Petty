<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\softDeletes;

class ConsultaMedica extends Model
{
    //importamos la clase para la elimiancion virtual
    use softDeletes;

    //hacemos referencia a la tabla que corresponde el modelo
    protected $table = 'consultasMedicas';

    //definimos los campos que seran tratados como fechas
    protected $dates = ['deleted_at','fechaConsulta'];

    //definimos los campos que se podran ingresar al crear el registro
    protected $fillable = [
    	'diagnostico',
    	'tratamiento',
    	'comentarios',
    	'fechaConsulta',
    	'idMascota',
    	'idVeterinario'
	];
}

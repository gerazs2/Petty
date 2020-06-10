<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permiso extends Model
{
	use SoftDeletes;

	// definimos el nombre de la tabla asociada al modelo
    protected $table="permisos";

    //importamos la clase softDeletes para la eliminacion bandera
	protected $dates = ['deleted_at'];
    
    //definimos los atributos que se podran llenar al crear el registro
    protected $fillable = [
    	'nombrePermiso',
    	'descripcionPermiso'
    ];

    
}

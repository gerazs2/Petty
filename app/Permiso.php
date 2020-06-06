<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
	// definimos el nombre de la tabla asociada al modelo
    protected $table="permisos";

    //definimos los atributos que se podran llenar al crear el registro
    protected $fillable = [
    	'nombrePermiso',
    	'descripcionPermiso'
    ];

    
}

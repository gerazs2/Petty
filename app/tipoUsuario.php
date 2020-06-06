<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tipoUsuario extends Model
{
	//la tabla asociada al modelo
    protected $table = 'tipoUsuarios';

    //los campos que se podran llenar al crear el registro
    protected $fillable = [
    	'tipoUsuario',
    	'descripcionUsuario'
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoUsuario extends Model
{
	use SoftDeletes;

	//la tabla asociada al modelo
    protected $table = 'tipoUsuarios';

    //importamos la clase softDeletes para la eliminacion bandera
	protected $dates = ['deleted_at'];

    //los campos que se podran llenar al crear el registro
    protected $fillable = [
    	'tipoUsuario',
    	'descripcionUsuario'
    ];
}

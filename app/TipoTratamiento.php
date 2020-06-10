<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoTratamiento extends Model
{
	use SoftDeletes;


	//la tabla a la que hace referencia el modelo
	protected $table = 'tipoTratamientos';

	//importamos la clase softDeletes para la eliminacion bandera
	protected $dates = ['deleted_at'];

	//los atributos que se podran llenar al crear el registro
    protected $fillable =[
    	'nombre'
    ];



}

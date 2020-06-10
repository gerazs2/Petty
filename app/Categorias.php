<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categorias extends Model
{	

	use SoftDeletes;

	//Tabla asociada de la BD
	protected $table = 'categorias';

	//importamos la clase softDeletes para la eliminacion bandera
	protected $dates = ['deleted_at'];

	//Atributos
	protected $fillable = [
		'nombreCategoria',
		'descripcionCategoria'
   ];  
}

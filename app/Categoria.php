<?php

namespace App;

use App\Servicio;
use App\SubCategoria;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
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


	/**
     *
     * creamos la relacion "uno a muchos"
     * primer parametro: la clase del modelo con que se creará la relacion
     * segundo parametro: el nombre de la llave foranea del otro modelo que hace referencia al 
     *                  id de este modelo
     */
	public function subcategorias(){
		return $this->hasMany(SubCategoria::class,'idCategoria');
	}

	
}

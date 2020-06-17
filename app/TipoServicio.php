<?php

namespace App;

use App\Servicio;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoServicio extends Model
{
	use SoftDeletes;

	//Tabla asociada de la BD
	protected $table = 'tipoServicios';

	//importamos la clase softDeletes para la eliminacion bandera
	protected $dates = ['deleted_at'];
	
	//Atributos
	protected $fillable = [
		'tipoServicio',
		'descripcion',
		'tipoServicioEsp',
		'especializacion'
	];  

	/**
     *
     * creamos la relacion "muchos a muchos"
     * funcion belongsToMany
     * primer parametro: la clase del modelo con el que tiene la relacion muchos a muchos
     * segundo parametro: el nombre de la tabla pivote
     * tercer parametro: el nombre de la llave foranea de la tabla pivote que hace referencia al id de este modelo
     * cuarto parametro: el nombre de la llave foranea de la tabla pivote que hace referencia al id del otro modelo
     */
    public function tiposServicio(){
        return $this->belongsToMany(Servicio::class, 'servicioTipo', 'idTipoServicio', 'idServicio')
            ->as('tiposServicio'); // el nombre que recibira el objeto con los registros de la tabla pivote
    }


}

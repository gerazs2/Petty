<?php

namespace App;

use App\Mascota;
use App\Servicio;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Especie extends Model
{
	use SoftDeletes;

    //Tabla asociada de la BD
    protected $table = 'especies';

    //importamos la clase softDeletes para la eliminacion bandera
	protected $dates = ['deleted_at'];
    
    //Atributos
    protected $fillable = [
    	'tipoEspecie'
   	]; 

   	public function mascotas(){
   		return $this->hasMany(Mascota::class,'idEspecie');
   	}

    /**
     *
     * creamos la relacion "muchos a muchos"
     * funcion belongsToMany
     * primer parametro: la clase del modelo con el que tiene la relacion muchos a muchos
     * segundo parametro: el nombre de la tabla pivote
     * tercer parametro: el nombre de la llave foranea de la tabla pivote que hace referencia al id de este modelo
     * cuarto parametro: el nombre de la llave foranea de la tabla pivote que hace referencia al id del otro modelo
     */
    public function especiesServicio(){
        return $this->belongsToMany(Servicio::class, 'especieServicio', 'idEspecie', 'idServicio')
            ->as('especiesServicio'); // el nombre que recibira el objeto con los registros de la tabla pivote
    }

}

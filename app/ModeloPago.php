<?php

namespace App;

use App\Organizacion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\softDeletes;

class ModeloPago extends Model
{
    //importamos la clase para la elimiancion virtual
    use softDeletes;

    //hacemos referencia a la tabla que corresponde el modelo
    protected $table = 'modelosPago';

    //definimos los campos que seran tratados como fechas
    protected $dates = ['deleted_at'];

    //definimos los campos que se podran ingresar al crear el registro
    protected $fillable = [
    	'nombre',
    	'descripcion',
    	'diasCorte',
    	'diasLimite'
	];

    /**
     *
     * creamos la relacion "uno a muchos"
     * primer parametro: la clase del modelo con que se creará la relacion
     * segundo parametro: el nombre de la llave foranea del otro modelo que hace referencia al 
     *                  id de este modelo
     */
    public function organizaciones(){
        return $this->hasMany(Organizacion::class,'idModeloPago');
    }
}

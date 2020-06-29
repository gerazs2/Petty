<?php

namespace App;

use App\User;
use App\Especie;
use App\Categoria;
use App\SubCategoria;
use App\TipoServicio;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    const CON_SERVICIO_CONTINUO = '1';
    const SIN_SERVICIO_CONTINUO = '0';

    //importamos la clase para la elimiancion virtual
    use softDeletes;

    //hacemos referencia a la tabla que corresponde el modelo
    protected $table = 'servicios';

    //definimos los campos que seran tratados como fechas
    protected $dates = ['deleted_at','horaApertura','horaCierre'];

    //definimos los campos que se podran ingresar al crear el registro
    protected $fillable = [
    	'nombreServicio',
    	'horaApertura',
    	'horaCierre',
    	'latitud',
    	'longitud',
    	'descripcion',
    	'precioBase',
    	'servicioContinuo',
    	'idUsuario',
    	'idSubcategoria'
	];

    /**
     * creamos la relacion "muchos a uno" 
     * primer parametro: la clase del modelo con que se creará la relacion.
     * segundo parametro: el nombre de la llave foranea de esta clase que hace referencia al 
                        id del otro modelo.
     */
    public function usuario(){
        return $this->belongsTo(User::class,'idUsuario');
    }

    /**
     * creamos la relacion "muchos a uno" 
     * primer parametro: la clase del modelo con que se creará la relacion.
     * segundo parametro: el nombre de la llave foranea de esta clase que hace referencia al 
                        id del otro modelo.
     */
    public function subcategoria(){
        return $this->belongsTo(SubCategoria::class,'idSubcategoria');
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
    public function tiposServicio(){
        return $this->belongsToMany(TipoServicio::class, 'servicioTipo', 'idServicio', 'idTipoServicio')
            ->as('tiposServicio'); // el nombre que recibira el objeto con los registros de la tabla pivote
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
        return $this->belongsToMany(Especie::class, 'especieServicio', 'idServicio', 'idEspecie')
            ->as('especiesServicio'); // el nombre que recibira el objeto con los registros de la tabla pivote
    }
}

<?php

namespace App;

use App\ServicioContratado;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Mensaje extends Model
{
    //importamos la clase para la elimiancion virtual
    use softDeletes;

    //hacemos referencia a la tabla que corresponde el modelo
    protected $table = 'mensajes';

    //definimos los campos que seran tratados como fechas
    protected $dates = ['deleted_at','fechaEnvio'];

    //definimos los campos que se podran ingresar al crear el registro
    protected $fillable = [
    	'mensaje',
    	'fechaEnvio',
    	'idUsuarioEmisor',
    	'idUsuarioReceptor',
    	'idServicioContratado'
	];

    /**
     * creamos la relacion "muchos a uno" 
     * primer parametro: la clase del modelo con que se creará la relacion.
     * segundo parametro: el nombre de la llave foranea de esta clase que hace referencia al 
                        id del otro modelo.
     */
    public function usuarioEmisor(){
        return $this->belongsTo(User::class,'idUsuarioEmisor');
    }

    /**
     * creamos la relacion "muchos a uno" 
     * primer parametro: la clase del modelo con que se creará la relacion.
     * segundo parametro: el nombre de la llave foranea de esta clase que hace referencia al 
                        id del otro modelo.
     */
    public function usuarioReceptor(){
        return $this->belongsTo(User::class,'idUsuarioReceptor');
    }

    /**
     * creamos la relacion "muchos a uno" 
     * primer parametro: la clase del modelo con que se creará la relacion.
     * segundo parametro: el nombre de la llave foranea de esta clase que hace referencia al 
                        id del otro modelo.
     */
    public function servicioContratado(){
        return $this->belongsTo(ServicioContratado::class,'idServicioContratado');
    }
}

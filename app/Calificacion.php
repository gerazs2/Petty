<?php

namespace App;

use App\ServicioContratado;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Calificacion extends Model
{
    use SoftDeletes;

	//la tabla asociada al modelo
    protected $table = 'calificaciones';

    //importamos la clase softDeletes para la eliminacion bandera
	protected $dates = ['deleted_at'];

    //los campos que se podran llenar al crear el registro
    protected $fillable = [
    	'calificacion',
        'comentario',
        'fechaCalificacion',
        'idServicio',
        'idUsuarioContrato',
        'idUsuarioPrestador',
        'idServicioContratado'
    ];

    /**
     * creamos la relacion "muchos a uno" 
     * primer parametro: la clase del modelo con que se creará la relacion.
     * segundo parametro: el nombre de la llave foranea de esta clase que hace referencia al 
                        id del otro modelo.
     */
    public function usuarioContrato(){
        return $this->belongsTo(User::class,'idUsuarioContrato');
    }

    /**
     * creamos la relacion "muchos a uno" 
     * primer parametro: la clase del modelo con que se creará la relacion.
     * segundo parametro: el nombre de la llave foranea de esta clase que hace referencia al 
                        id del otro modelo.
     */
    public function usuarioPrestador(){
        return $this->belongsTo(User::class,'idUsuarioPrestador');
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

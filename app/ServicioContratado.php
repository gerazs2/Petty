<?php

namespace App;

use App\Calificacion;
use App\Mascota;
use App\Mensaje;
use App\SubCategoria;
use App\User;
use Illuminate\Database\Eloquent\Model;

class ServicioContratado extends Model
{
    use SoftDeletes;

	//la tabla asociada al modelo
    protected $table = 'serviciosContratados';

    //importamos la clase softDeletes para la eliminacion bandera
	protected $dates = ['deleted_at'];

    //los campos que se podran llenar al crear el registro
    protected $fillable = [
    	'nombreServicio',
        'descripcion',
        'precioBase',
        'observacinesFinales',//asi esta en la BD,
        'statusServicio',
        'costoFinal',
        'fechaContrato',
        'fechaTermino',
        'fechaEjecucion',
        'idUsuarioContrato',
        'idMascota',
        'idSubcategoria'
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
    public function mascota(){
        return $this->belongsTo(Mascota::class,'idMascota');
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
     * creamos la relacion "uno a muchos"
     * primer parametro: la clase del modelo con que se creará la relacion
     * segundo parametro: el nombre de la llave foranea del otro modelo que hace referencia al 
     *                  id de este modelo
     */
    public function calificaciones(){
        return $this->hasMany(Calificacion::class,'idServicioContratado');
    }

    /**
     *
     * creamos la relacion "uno a muchos"
     * primer parametro: la clase del modelo con que se creará la relacion
     * segundo parametro: el nombre de la llave foranea del otro modelo que hace referencia al 
     *                  id de este modelo
     */
    public function mensajes(){
        return $this->hasMany(Mensaje::class,'idServicioContratado');
    }

    
}

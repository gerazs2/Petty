<?php

namespace App;

use App\Organizacion;
use App\Sepomex;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Direccion extends Model
{
    use SoftDeletes;

    //tabla asociada al modelo
    protected $table = 'direcciones';

    //importamos la clase softDeletes para la eliminacion bandera
    protected $dates = ['deleted_at'];

    protected $fillable = [
    	'calle',
    	'numExt',
    	'numInt',
    	'referencia',
    	'idSepomex'
    ];

    /**
     * creamos la relacion "muchos a uno" 
     * primer parametro: la clase del modelo con que se creará la relacion.
     * segundo parametro: el nombre de la llave foranea de esta clase que hace referencia al 
                        id del otro modelo.
     */
    public function sepomex(){
    	return $this->belongsTo(Sepomex::class,'idSepomex');
    }

    /**
     *
     * creamos la relacion "uno a muchos"
     * primer parametro: la clase del modelo con que se creará la relacion
     * segundo parametro: el nombre de la llave foranea del otro modelo que hace referencia al 
     *                  id de este modelo
     */
    public function organizaciones(){
        return $this->hasMany(Organizacion::class,'idDireccion');
    }

    /**
     *
     * creamos la relacion "uno a muchos"
     * primer parametro: la clase del modelo con que se creará la relacion
     * segundo parametro: el nombre de la llave foranea del otro modelo que hace referencia al 
     *                  id de este modelo
     */
    public function usuarios(){
        return $this->hasMany(User::class,'idDireccion');
    }
}

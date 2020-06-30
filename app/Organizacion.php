<?php

namespace App;

use App\Corte;
use App\Direccion;
use App\ModeloPago;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organizacion extends Model
{
    use SoftDeletes;

    //Tabla asociada de la BD
    protected $table = 'organizaciones';
    
    //importamos la clase softDeletes para la eliminacion bandera
    protected $dates = ['deleted_at'];

    //Atributos 
    protected $fillable = [
        'nombreOrg',
        'emailOrg',
        'rfc',
        'idModeloPago',
        'idDireccion'
    ];  

    /**
     * creamos la relacion "muchos a uno" 
     * primer parametro: la clase del modelo con que se creará la relacion.
     * segundo parametro: el nombre de la llave foranea de esta clase que hace referencia al 
                        id del otro modelo.
     */
    public function modeloPago(){
        return $this->belongsTo(ModeloPago::class,'idModeloPago');
    }

    /**
     * creamos la relacion "muchos a uno" 
     * primer parametro: la clase del modelo con que se creará la relacion.
     * segundo parametro: el nombre de la llave foranea de esta clase que hace referencia al 
                        id del otro modelo.
     */
    public function direcicon(){
        return $this->belongsTo(Direccion::class,'idDireccion');
    }

    /**
     *
     * creamos la relacion "uno a muchos"
     * primer parametro: la clase del modelo con que se creará la relacion
     * segundo parametro: el nombre de la llave foranea del otro modelo que hace referencia al 
     *                  id de este modelo
     */
    public function cortes(){
        return $this->hasMany(Corte::class,'idOrganizacion');
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
    public function usuariosOrganizacion(){
        return $this->belongsToMany(User::class, 'organizacionUsuario', 'idOrganizacion', 'idUsuario')
            ->as('usuariosOrganizacion') // el nombre que recibira el objeto con los registros de la tabla pivote
            ->withPivot('esAdmin'); // indicamos los campos adicionales que tiene la tabla pivote a parte de las llaves foraneas
    }
}

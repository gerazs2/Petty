<?php

namespace App;

use App\Permiso;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoUsuario extends Model
{
	use SoftDeletes;

	//la tabla asociada al modelo
    protected $table = 'tipoUsuarios';

    //importamos la clase softDeletes para la eliminacion bandera
	protected $dates = ['deleted_at'];

    //los campos que se podran llenar al crear el registro
    protected $fillable = [
    	'tipoUsuario',
    	'descripcionUsuario'
    ];

    public function usuarios(){
        return $this->hasMany(User::class,'idTipoUsuario');
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
    public function permisosUsuario(){
        return $this->belongsToMany(Permiso::class, 'permisosTipo', 'idTipoUsuario', 'idPermiso')
            ->as('permisosUsuario'); // el nombre que recibira el objeto con los registros de la tabla pivote
    }

}

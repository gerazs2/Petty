<?php

namespace App;

use App\TipoUsuario;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permiso extends Model
{
    const DIM_MAX_NOMBRE_PERMISO = 60;
    const DIM_MAX_DESCRIPCION_PERMISO = 150;

	use SoftDeletes;

	// definimos el nombre de la tabla asociada al modelo
    protected $table="permisos";

    //importamos la clase softDeletes para la eliminacion bandera
	protected $dates = ['deleted_at'];
    
    //definimos los atributos que se podran llenar al crear el registro
    protected $fillable = [
    	'nombrePermiso',
    	'descripcionPermiso'
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
    public function permisosUsuario(){
        return $this->belongsToMany(TipoUsuario::class, 'permisosTipo', 'idPermiso', 'idTipoUsuario')
            ->as('permisosUsuario'); // el nombre que recibira el objeto con los registros de la tabla pivote
    }
    
}

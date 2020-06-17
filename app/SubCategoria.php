<?php

namespace App;

use App\Categoria;
use App\Servicio;
use App\ServicioContratado;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategoria extends Model
{
    use SoftDeletes;

    //Tabla asociada de la BD
    protected $table = 'subcategorias';

    //importamos la clase softDeletes para la eliminacion bandera
	protected $dates = ['deleted_at'];

    //Atributos
    protected $fillable = [
		'nombreSubCat',
		'descripcionSubCat',
		'idCategoria'
 	];  

    /**
     * creamos la relacion "muchos a uno" 
     * primer parametro: la clase del modelo con que se creará la relacion.
     * segundo parametro: el nombre de la llave foranea de esta clase que hace referencia al 
                        id del otro modelo.
     */
    public function categoria(){
        return $this->belongsTo(Categoria::class,'idCategoria');
    }

    /**
     *
     * creamos la relacion "uno a muchos"
     * primer parametro: la clase del modelo con que se creará la relacion
     * segundo parametro: el nombre de la llave foranea del otro modelo que hace referencia al 
     *                  id de este modelo
     */
    public function servicios(){
        return $this->hasMany(Servicio::class,'idSubcategoria');
    }

    /**
     *
     * creamos la relacion "uno a muchos"
     * primer parametro: la clase del modelo con que se creará la relacion
     * segundo parametro: el nombre de la llave foranea del otro modelo que hace referencia al 
     *                  id de este modelo
     */
    public function serviciosContratados(){
        return $this->hasMany(ServicioContratado::class,'idSubcategoria');
    }
}

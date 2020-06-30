<?php

namespace App;

use App\Mascota;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Veterinario extends Model
{
    //importamos la clase para la elimiancion virtual
    use softDeletes;

    //hacemos referencia a la tabla que corresponde el modelo
    protected $table = 'veterinarios';

    //definimos los campos que seran tratados como fechas
    protected $dates = ['deleted_at'];

    //definimos los campos que se podran ingresar al crear el registro
    protected $fillable = [
    	'cedula',
    	'curriculum',
    	'titulo',
    	'experiencia',
    	'universidad',
    	'idUsuario'
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
     *
     * creamos la relacion "uno a muchos"
     * primer parametro: la clase del modelo con que se creará la relacion
     * segundo parametro: el nombre de la llave foranea del otro modelo que hace referencia al 
     *                  id de este modelo
     */
    public function consultasMedicas(){
        return $this->hasMany(ConsultaMedica::class,'idVeterinario');
    }

    /**
     *
     * creamos la relacion "uno a muchos"
     * primer parametro: la clase del modelo con que se creará la relacion
     * segundo parametro: el nombre de la llave foranea del otro modelo que hace referencia al 
     *                  id de este modelo
     */
    public function tratamientos(){
        return $this->hasMany(Tratamiento::class,'idVeterinario');
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
    public function permisoVeterinarios(){
        return $this->belongsToMany(Mascota::class, 'mascotaVeterinario', 'idVeterinario', 'idMascota')
            ->as('permisoVeterinarios') // el nombre que recibira el objeto con los registros de la tabla pivote
            ->withPivot('puedeEditar'); // indicamos los campos adicionales que tiene la tabla pivote a parte de las llaves foraneas
    }
}

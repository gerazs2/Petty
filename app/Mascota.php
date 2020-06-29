<?php

namespace App;

use App\ConsultaMedica;
use App\Especie;
use App\ServicioContratado;
use App\Tratamiento;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Mascota extends Model
{
    const TAMANO_CHICO = 'Chico';
    const TAMANO_MEDIANO = 'Mediano';
    const TAMANO_GRANDE = 'Grande';

    const SEXO_MACHO = 'Macho';
    const SEXO_HEMBRA = 'Hembra';

    use SoftDeletes;

    //Tabla asociada de la BD
    protected $table = 'mascotas';

    //importamos la clase softDeletes para la eliminacion bandera
	protected $dates = ['deleted_at'];

    //Atributos
    protected $fillable = [
        'nombreMascota',
        'fechaNacimiento',
        'raza',
        'color',
        'peso',
        'tamaño',
        'sexo',
        'senParticulares',
        'idEspecie',
        'idUsuario'
 	]; 


    /**
     * creamos la relacion "muchos a uno" 
     * primer parametro: la clase del modelo con que se creará la relacion.
     * segundo parametro: el nombre de la llave foranea de esta clase que hace referencia al 
                        id del otro modelo.
     */
    public function especie(){
        return $this->belongsTo(Especie::class,'idEspecie');
    }

    
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
    public function tratamientos(){
        return $this->hasMany(Tratamiento::class,'idMascota');
    }

    /**
     *
     * creamos la relacion "uno a muchos"
     * primer parametro: la clase del modelo con que se creará la relacion
     * segundo parametro: el nombre de la llave foranea del otro modelo que hace referencia al 
     *                  id de este modelo
     */
    public function consultasMedicas(){
        return $this->hasMany(ConsultaMedica::class,'idMascota');
    }

    /**
     *
     * creamos la relacion "uno a muchos"
     * primer parametro: la clase del modelo con que se creará la relacion
     * segundo parametro: el nombre de la llave foranea del otro modelo que hace referencia al 
     *                  id de este modelo
     */
    public function serviciosContratados(){
        return $this->hasMany(ServicioContratado::class,'idMascota');
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
        return $this->belongsToMany(Veterinario::class, 'mascotaVeterinario', 'idMascota', 'idVeterinario')
            ->as('permisoVeterinarios') // el nombre que recibira el objeto con los registros de la tabla pivote
            ->withPivot('puedeEditar'); // indicamos los campos adicionales que tiene la tabla pivote a parte de las llaves foraneas
    }

}
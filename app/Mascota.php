<?php

namespace App;

use App\User;
use App\Especie;
use App\Tratamiento;
use App\ConsultaMedica;
use App\ServicioContratado;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mascota extends Model
{
    const TAMANO_CHICO = 'Chico';
    const TAMANO_MEDIANO = 'Mediano';
    const TAMANO_GRANDE = 'Grande';

    const SEXO_MACHO = 'Macho';
    const SEXO_HEMBRA = 'Hembra';

    const MAX_NOMBRE_MASCOTA = 60;
    const MAX_RAZA = 50;
    const MAX_COLOR = 20;
    const MAX_TAMANIO = 60;
    const MAX_SEXO = 20;

    /**
     * Strings personalizados para los nombres de los campos
     */
    const ATTRIBUTES = [
        'nombreMascota' => 'Nombre de la Mascota',
        'fechaNacimiento' => 'Fecha de Nacimiento',
        'raza' => 'Raza',
        'color' => 'Color',
        'peso' => 'Peso',
        'tamaño' => 'Tamaño',
        'sexo' => 'Sexo',
        'senParticulares' => 'Señas Particulares',
        'idEspecie' => 'Especie',
        'idUsuario' => 'Dueño'
    ];

    /**
     * Reglas de validacion para cada uno de los campos de este modelo
     */
    // TODO Revisar el required cuando es un UPDATE
    const VALIDATION_RULES =  [
        'nombreMascota' => 'required|string|max:' . Mascota::MAX_NOMBRE_MASCOTA,
        'fechaNacimiento' => 'required|date_format:d/m/Y H:i:s',
        'raza' => 'required|string|max:' . MAscota::MAX_RAZA,
        'color' => 'required|string|max:' . MAscota::MAX_COLOR,
        'peso' => 'required|numeric',
        'tamaño' => 'required|string|max:' . MAscota::MAX_TAMANIO,
        'sexo' => 'required|string|max:' . MAscota::MAX_SEXO,
        'senParticulares' => 'required|string',
        'idEspecie' => 'required|integer|exists:especies,id',
        'idUsuario' => 'required|integer|exists:usuarios,id',
    ];
    /**
     * Strings personalizados para los mesajes de error 
     */
    const MESSAGES = [
        'required' => 'El campo :attribute es requerido.',
        'numeric' => 'El campo :attribute debe ser numérico.',
        'date_format' => 'El campo :attribute no coinide con el formato :format.',
        'exists' => 'El valor de este campo :attribute no existe.',
        'max' => 'La longitud debe ser de no mas de :max caracteres.',
    ];

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
    public function especie()
    {
        return $this->belongsTo(Especie::class, 'idEspecie');
    }


    /**
     * creamos la relacion "muchos a uno" 
     * primer parametro: la clase del modelo con que se creará la relacion.
     * segundo parametro: el nombre de la llave foranea de esta clase que hace referencia al 
                        id del otro modelo.
     */
    public function usuario()
    {
        return $this->belongsTo(User::class, 'idUsuario');
    }


    /**
     *
     * creamos la relacion "uno a muchos"
     * primer parametro: la clase del modelo con que se creará la relacion
     * segundo parametro: el nombre de la llave foranea del otro modelo que hace referencia al 
     *                  id de este modelo
     */
    public function tratamientos()
    {
        return $this->hasMany(Tratamiento::class, 'idMascota');
    }

    /**
     *
     * creamos la relacion "uno a muchos"
     * primer parametro: la clase del modelo con que se creará la relacion
     * segundo parametro: el nombre de la llave foranea del otro modelo que hace referencia al 
     *                  id de este modelo
     */
    public function consultasMedicas()
    {
        return $this->hasMany(ConsultaMedica::class, 'idMascota');
    }

    /**
     *
     * creamos la relacion "uno a muchos"
     * primer parametro: la clase del modelo con que se creará la relacion
     * segundo parametro: el nombre de la llave foranea del otro modelo que hace referencia al 
     *                  id de este modelo
     */
    public function serviciosContratados()
    {
        return $this->hasMany(ServicioContratado::class, 'idMascota');
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
    public function permisoVeterinarios()
    {
        return $this->belongsToMany(Veterinario::class, 'mascotaVeterinario', 'idMascota', 'idVeterinario')
            ->as('permisoVeterinarios') // el nombre que recibira el objeto con los registros de la tabla pivote
            ->withPivot('puedeEditar'); // indicamos los campos adicionales que tiene la tabla pivote a parte de las llaves foraneas
    }
}

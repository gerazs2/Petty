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
    const MAX_NOMBRE_ORGANIZACION = 50;
    const MAX_EMAIL = 255;
    const MIN_RFC = 12;
    const MAX_RFC = 13;

    /**
     * Strings personalizados para los nombres de los campos
     */
    const ATTRIBUTES = [
        'nombreOrg' => 'Nombre Organizacion',
        'emailOrg' => 'Correo Electrónico',
        'rfc' => 'R.F.C.',
        'idModeloPago' => 'Modelo de Pago',
        'idDireccion' => 'Dirección'
    ];

    /**
     * Reglas de validacion para cada uno de los campos de este modelo
     */
    const VALIDATION_RULES =  [
        'nombreOrg' => 'required|string|unique:organizaciones|max:' . Organizacion::MAX_NOMBRE_ORGANIZACION,
        'emailOrg' => 'required|email|unique:organizaciones|max:' . Organizacion::MAX_EMAIL,
        'rfc' => 'required|string|unique:organizaciones|min:' . Organizacion::MIN_RFC . '|max:' . Organizacion::MAX_RFC,
        'idModeloPago' => 'required|integer|exists:modelosPago,id',
        'idDireccion' => 'required|integer|exists:direcciones,id',
    ];
    /**
     * Strings personalizados para los mesajes de error 
     */
    const MESSAGES = [
        'required' => 'El campo :attribute es requerido.',
        'unique' => 'Este campo :attribute ya ha sido registrado.',
        'exists' => 'El valor de este campo :attribute no existe.',
        'min' => 'La longitud debe ser al menos :min caracteres.',
        'max' => 'La longitud debe ser de no mas de :max caracteres.',
    ];

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
    public function modeloPago()
    {
        return $this->belongsTo(ModeloPago::class, 'idModeloPago');
    }

    /**
     * creamos la relacion "muchos a uno" 
     * primer parametro: la clase del modelo con que se creará la relacion.
     * segundo parametro: el nombre de la llave foranea de esta clase que hace referencia al 
                        id del otro modelo.
     */
    public function direccion()
    {
        return $this->belongsTo(Direccion::class, 'idDireccion');
    }

    /**
     *
     * creamos la relacion "uno a muchos"
     * primer parametro: la clase del modelo con que se creará la relacion
     * segundo parametro: el nombre de la llave foranea del otro modelo que hace referencia al 
     *                  id de este modelo
     */
    public function cortes()
    {
        return $this->hasMany(Corte::class, 'idOrganizacion');
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
    public function usuariosOrganizacion()
    {
        return $this->belongsToMany(User::class, 'organizacionUsuario', 'idOrganizacion', 'idUsuario')
            ->as('usuariosOrganizacion') // el nombre que recibira el objeto con los registros de la tabla pivote
            ->withPivot('esAdmin'); // indicamos los campos adicionales que tiene la tabla pivote a parte de las llaves foraneas
    }
}

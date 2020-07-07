<?php

namespace App;

use App\Organizacion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class ModeloPago extends Model
{
    const MAX_NOMBRE = 50;
    const MAX_DESCRIPCION = 250;
    const MAX_DIAS_CORTE = 30;
    const MAX_DIAS_LIMITE = 30;

    /**
     * Strings personalizados para los nombres de los campos
     */
    const ATTRIBUTES = [
        'nombre' => 'Nombre Modelo',
        'descripcion' => 'Descripción',
        'diasCorte' => 'Días de Corte',
        'diasLimite' => 'Días Límite de Pago',
    ];

    /**
     * Reglas de validacion para cada uno de los campos de este modelo
     */
    // TODO Revisar el required cuando es un UPDATE
    const VALIDATION_RULES =  [
        'nombre' => 'required|string|max:' . ModeloPago::MAX_NOMBRE,
        'descripcion' => 'required|string|max:' . ModeloPago::MAX_DESCRIPCION,
        'diasCorte' => 'required|integer|min:1|max:' . ModeloPago::MAX_DIAS_CORTE,
        'diasLimite' => 'required|integer|min:1|max:' . ModeloPago::MAX_DIAS_LIMITE,
    ];
    /**
     * Strings personalizados para los mensajes de error 
     */
    const MESSAGES = [
        'required' => 'El campo :attribute es requerido.',
        'max' => [
            'numeric' => 'El número no debe ser mayor :max.',
            'string' => 'La longitud debe ser de no mas de :max caracteres.'
        ],
        'min' => [
            'numeric' => 'El número no debe ser mayor :min.'
        ],

    ];



    //importamos la clase para la elimiancion virtual
    use softDeletes;

    //hacemos referencia a la tabla que corresponde el modelo
    protected $table = 'modelosPago';

    //definimos los campos que seran tratados como fechas
    protected $dates = ['deleted_at'];

    //definimos los campos que se podran ingresar al crear el registro
    protected $fillable = [
        'nombre',
        'descripcion',
        'diasCorte',
        'diasLimite'
    ];

    /**
     *
     * creamos la relacion "uno a muchos"
     * primer parametro: la clase del modelo con que se creará la relacion
     * segundo parametro: el nombre de la llave foranea del otro modelo que hace referencia al 
     *                  id de este modelo
     */
    public function organizaciones()
    {
        return $this->hasMany(Organizacion::class, 'idModeloPago');
    }
}

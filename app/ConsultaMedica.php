<?php

namespace App;

use App\Mascota;
use App\Veterinario;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConsultaMedica extends Model
{
    const MAX_COMENTARIOS = 500;

    /**
     * Strings personalizados para los nombres de los campos
     */
    const ATTRIBUTES = [
        'diagnostico' => 'Diagnóstico',
        'tratamiento' => 'Tratamiento',
        'comentarios' => 'Comentarios',
        'fechaConsulta' => 'Fecha de Consulta',
        'idMascota' => 'Mascota',
        'idVeterinario' => 'Veterinario',
    ];

    /**
     * Reglas de validacion para cada uno de los campos de este modelo
     */
    // TODO Revisar el required cuando es un UPDATE
    const VALIDATION_RULES =  [
        'diagnostico' => 'required|string',
        'tratamiento' => 'required|date_format:d/m/Y H:i:s',
        'comentarios' => 'required|string|max:' . ConsultaMedica::MAX_COMENTARIOS,
        'fechaConsulta' => 'required|date_format:d/m/Y H:i:s',
        'dMascota' => 'required|integer|exists:,mascotas,id',
        'idVeterinario' => 'required|integer|exists:veterinarios,id',

    ];
    /**
     * Strings personalizados para los mesajes de error 
     */
    const MESSAGES = [
        'required' => 'El campo :attribute es requerido.',
        'date_format' => 'El campo :attribute no coinide con el formato :format.',
        'exists' => 'El valor de este campo :attribute no existe.',
        'max' => 'La longitud debe ser de no mas de :max caracteres.',
    ];

    //importamos la clase para la elimiancion virtual
    use SoftDeletes;

    //hacemos referencia a la tabla que corresponde el modelo
    protected $table = 'consultasMedicas';

    //definimos los campos que seran tratados como fechas
    protected $dates = ['deleted_at', 'fechaConsulta'];

    //definimos los campos que se podran ingresar al crear el registro
    protected $fillable = [
        'diagnostico',
        'tratamiento',
        'comentarios',
        'fechaConsulta',
        'idMascota',
        'idVeterinario'
    ];

    /**
     * creamos la relacion "muchos a uno" 
     * primer parametro: la clase del modelo con que se creará la relacion.
     * segundo parametro: el nombre de la llave foranea de esta clase que hace referencia al 
                        id del otro modelo.
     */
    public function mascota()
    {
        return $this->belongsTo(Mascota::class, 'idMascota');
    }

    /**
     * creamos la relacion "muchos a uno" 
     * primer parametro: la clase del modelo con que se creará la relacion.
     * segundo parametro: el nombre de la llave foranea de esta clase que hace referencia al 
                        id del otro modelo.
     */
    public function veterinario()
    {
        return $this->belongsTo(Veterinario::class, 'idVeterinario');
    }
}

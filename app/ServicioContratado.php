<?php

namespace App;

use App\User;
use App\Mascota;
use App\Mensaje;
use App\Calificacion;
use App\SubCategoria;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;

class ServicioContratado extends Model
{
    const STATUS_SERVICIO_TERMINADO = 'Terminado';
    const STATUS_SERVICIO_PENDIENTE = 'Pendiente';
    const STATUS_SERVICIO_CANCELADO = 'Cancelado';
    const STATUS_SERVICIO_RECLAMO = 'Reclamo';

    const MAX_NOMBRE_SERVICIO = 100;
    const MAX_OBSERVACIONES_FINALES = 250;
    const MAX_ESTATUS_SERVICIO = 20;

    /**
     * Strings personalizados para los nombres de los campos
     */
    const ATTRIBUTES = [
        'nombreServicio' => 'Nombre del Servicio',
        'descripcion' => 'Descripción del Servicio',
        'precio Base' => 'Precio Base',
        // TODO Corregir en migraciones
        'observacinesFinales' => 'Observaciones Finales',
        'statusServicio' => 'Estatus del Servicio',
        'costoFinal' => 'Costo Final',
        'fechaContrato' => 'Fecha de Contrato',
        'fechaTermino' => 'Fecha de Finalización',
        'fechaEjecucion' => 'Fecha de Ejecución ',
        'idUsuarioContrato' => 'Usuario Contratado',
        'idMascota' => 'Mascota',
        'idSubcategoria' => 'SubCategoría'
    ];

    /**
     * Reglas de validacion para cada uno de los campos de este modelo
     */
    // TODO Revisar el required cuando es un UPDATE
    const VALIDATION_RULES =  [
        'nombreServicio' => 'required|string|max:' . ServicioContratado::MAX_NOMBRE_SERVICIO,
        'descripcion' => 'required|string',
        'precio Base' => 'required|numeric',
        'observacinesFinales' => 'required|string|max:' . ServicioContratado::MAX_OBSERVACIONES_FINALES,
        'statusServicio' => 'required|string|max:' . ServicioContratado::MAX_ESTATUS_SERVICIO,
        'costoFinal' => 'required|numeric',
        'fechaContrato' => 'required|date_format:d/m/Y H:i:s',
        'fechaTermino' => 'required|date_format:d/m/Y H:i:s|after_or_equal:fechaContrato',
        'fechaEjecucion' => 'required|date_format:d/m/Y H:i:s|after_or_equal:fechaContrato',
        'idUsuarioContrato' => 'required|integer|exists:usuarios,id',
        'idMascota' => 'required|integer|exists:mascotas,id',
        'idSubcategoria' => 'required|integer|exists:subcategorias,id',
    ];
    /**
     * Strings personalizados para los mesajes de error 
     */
    const MESSAGES = [
        'required' => 'El campo :attribute es requerido.',
        'numeric' => 'El campo :attribute debe ser numérico.',
        'date_format' => 'El campo :attribute no coinide con el formato :format.',
        'after_or_equal' => 'La fecha :attribute debe ser después de :date.',
        'unique' => 'Este campo :attribute ya ha sido registrado.',
        'exists' => 'El valor de este campo :attribute no existe.',
        'max' => 'La longitud debe ser de no mas de :max caracteres.',
    ];

    use SoftDeletes;

    //la tabla asociada al modelo
    protected $table = 'serviciosContratados';

    //importamos la clase softDeletes para la eliminacion bandera
    protected $dates = ['deleted_at'];

    //los campos que se podran llenar al crear el registro
    protected $fillable = [
        'nombreServicio',
        'descripcion',
        'precioBase',
        'observacinesFinales', //asi esta en la BD,
        'statusServicio',
        'costoFinal',
        'fechaContrato',
        'fechaTermino',
        'fechaEjecucion',
        'idUsuarioContrato',
        'idMascota',
        'idSubcategoria'
    ];

    /**
     * creamos la relacion "muchos a uno" 
     * primer parametro: la clase del modelo con que se creará la relacion.
     * segundo parametro: el nombre de la llave foranea de esta clase que hace referencia al 
                        id del otro modelo.
     */
    public function usuarioContrato()
    {
        return $this->belongsTo(User::class, 'idUsuarioContrato');
    }

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
    public function subcategoria()
    {
        return $this->belongsTo(SubCategoria::class, 'idSubcategoria');
    }

    /**
     *
     * creamos la relacion "uno a muchos"
     * primer parametro: la clase del modelo con que se creará la relacion
     * segundo parametro: el nombre de la llave foranea del otro modelo que hace referencia al 
     *                  id de este modelo
     */
    public function calificaciones()
    {
        return $this->hasMany(Calificacion::class, 'idServicioContratado');
    }

    /**
     *
     * creamos la relacion "uno a muchos"
     * primer parametro: la clase del modelo con que se creará la relacion
     * segundo parametro: el nombre de la llave foranea del otro modelo que hace referencia al 
     *                  id de este modelo
     */
    public function mensajes()
    {
        return $this->hasMany(Mensaje::class, 'idServicioContratado');
    }
}

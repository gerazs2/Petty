<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calificacion extends Model
{
    use SoftDeletes;

	//la tabla asociada al modelo
    protected $table = 'calificaciones';

    //importamos la clase softDeletes para la eliminacion bandera
	protected $dates = ['deleted_at'];

    //los campos que se podran llenar al crear el registro
    protected $fillable = [
    	'calificacion',
        'comentario',
        'fechaCalificacion',
        'idServicio',
        'idUsuarioContrato',
        'idUsuarioPrestador',
        'idServicioContratado'
    ];
}

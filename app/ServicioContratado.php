<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServicioContratado extends Model
{
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
        'observacinesFinales',//asi esta en la BD,
        'statusServicio',
        'costoFinal',
        'fechaContrato',
        'fechaTermino',
        'fechaEjecucion',
        'idUsuarioContrato',
        'idMascota',
        'idSubcategoria'
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tratamiento extends Model
{
    use SoftDeletes;

	//la tabla asociada al modelo
    protected $table = 'tratamientos';

    //importamos la clase softDeletes para la eliminacion bandera
	protected $dates = ['deleted_at'];

    //los campos que se podran llenar al crear el registro
    protected $fillable = [
    	'fechaTratamiento',
        'nombreTratamiento',
        'etiqueta',
        'proximoTratamiento',
        'idTipoTratamiento',
        'idMascota',
        'idVeterinario'
    ];
}

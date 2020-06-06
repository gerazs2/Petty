<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoTratamiento extends Model
{

	//la tabla a la que hace referencia el modelo
	protected $table = 'tipoTratamientos';

	//los atributos que se podran llenar al crear el registro
    protected $fillable =[
    	'nombre'
    ];



}

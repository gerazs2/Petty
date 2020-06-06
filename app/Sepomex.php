<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sepomex extends Model
{
    //la tabla asociada al modelo
    protected $table = 'sepomex';

    //los campos que se podran llenar al crear el registro
    protected $fillable = [
    	'cp',
    	'asentamiento',
    	'tipoAsentamiento',
    	'municipio',
    	'estado',
    	'ciudad',
    	'pais'
    ];
}

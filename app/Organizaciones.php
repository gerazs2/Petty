<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organizaciones extends Model
{
    //Tabla asociada de la BD
    protected $table = 'organizacion';
    

    //Atributos 
    protected $fillable = [
        'nombreOrg',
        'emailOrg',
        'rfc',
        'idModeloPago',
        'idDireccion'
    ];  

    
}

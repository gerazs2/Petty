<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organizacione extends Model
{
    use SoftDeletes;

    //Tabla asociada de la BD
    protected $table = 'organizacion';
    
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

    
}

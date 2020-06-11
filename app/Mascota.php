<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mascota extends Model
{
    use SoftDeletes;

    //Tabla asociada de la BD
    protected $table = 'mascotas';

    //importamos la clase softDeletes para la eliminacion bandera
	protected $dates = ['deleted_at'];

    //Atributos
    protected $fillable = [
        'nombreMascota',
        'fechaNacimiento',
        'raza',
        'color',
        'peso',
        'tamaño',
        'sexo',
        'senParticulares',
        'idEspecie',
        'idUsuario'
 	]; 
}
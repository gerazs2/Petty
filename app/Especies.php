<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Especies extends Model
{
    //Tabla asociada de la BD
    protected $table = 'especies';

    //Atributos
 
    protected $fillable = [
    
     'tipoEspecie'
   
 
 ];  
}

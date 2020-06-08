<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
      //Tabla asociada de la BD
      protected $table = 'categorias';

      //Atributos
   
      protected $fillable = [
      
       'nombreCategoria',
       'descripcionCategoria'
     
   
   ];  
}

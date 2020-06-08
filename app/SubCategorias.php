<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategorias extends Model
{
    //Tabla asociada de la BD
    protected $table = 'subcategorias';

    //Atributos
 
    protected $fillable = [
    
     'nombreSubCat',
     'descripcionSubCat',
     'ídCategoria'
   
 
 ];  
}

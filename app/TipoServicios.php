<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoServicios extends Model
{
   //Tabla asociada de la BD
   protected $table = 'tipoServicios';

   //Atributos

   protected $fillable = [
   
    'tipoServicio',
    'descripcion',
    'tipoServicioEsp',
    'especializacion'

];  


}

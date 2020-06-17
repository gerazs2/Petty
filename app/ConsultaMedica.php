<?php

namespace App;

use App\Mascota;
use App\Veterinario;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\softDeletes;

class ConsultaMedica extends Model
{
    //importamos la clase para la elimiancion virtual
    use softDeletes;

    //hacemos referencia a la tabla que corresponde el modelo
    protected $table = 'consultasMedicas';

    //definimos los campos que seran tratados como fechas
    protected $dates = ['deleted_at','fechaConsulta'];

    //definimos los campos que se podran ingresar al crear el registro
    protected $fillable = [
    	'diagnostico',
    	'tratamiento',
    	'comentarios',
    	'fechaConsulta',
    	'idMascota',
    	'idVeterinario'
	];

    /**
     * creamos la relacion "muchos a uno" 
     * primer parametro: la clase del modelo con que se creará la relacion.
     * segundo parametro: el nombre de la llave foranea de esta clase que hace referencia al 
                        id del otro modelo.
     */
    public function mascota(){
        return $this->belongsTo(Mascota::class,'idMascota');
    }

    /**
     * creamos la relacion "muchos a uno" 
     * primer parametro: la clase del modelo con que se creará la relacion.
     * segundo parametro: el nombre de la llave foranea de esta clase que hace referencia al 
                        id del otro modelo.
     */
    public function veterinario(){
        return $this->belongsTo(Veterinario::class,'idVeterinario');
    }
}

<?php

namespace App;

use App\Mascota;
use App\TipoTratamiento;
use App\Veterinario;
use Illuminate\Database\Eloquent\Model;

class Tratamiento extends Model
{
    use SoftDeletes;

	//la tabla asociada al modelo
    protected $table = 'tratamientos';

    //importamos la clase softDeletes para la eliminacion bandera
	protected $dates = ['deleted_at'];

    //los campos que se podran llenar al crear el registro
    protected $fillable = [
    	'fechaTratamiento',
        'nombreTratamiento',
        'etiqueta',
        'proximoTratamiento',
        'idTipoTratamiento',
        'idMascota',
        'idVeterinario'
    ];

    /**
     * creamos la relacion "muchos a uno" 
     * primer parametro: la clase del modelo con que se creará la relacion.
     * segundo parametro: el nombre de la llave foranea de esta clase que hace referencia al 
                        id del otro modelo.
     */
    public function tipoTratamiento(){
        return $this->belongsTo(TipoTratamiento::class,'idTipoTratamiento');
    }

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

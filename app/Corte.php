<?php

namespace App;

use App\Organizacion;
use App\Pago;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\softDeletes;

class Corte extends Model
{
    //importamos la clase para la elimiancion virtual
    use softDeletes;

    //hacemos referencia a la tabla que corresponde el modelo
    protected $table = 'cortes';

    //definimos los campos que seran tratados como fechas
    protected $dates = ['deleted_at', 'fecha'];

    //definimos los campos que se podran ingresar al crear el registro
    protected $fillable = [
    	'fecha',
    	'periodo',
    	'monto',
    	'status',
    	'requiereFactura',
    	'facturado',
    	'rutaFactura',
    	'folioFiscal',
    	'fechaLimitePago',
    	'idOrganizacion'
	];

    /**
     * creamos la relacion "muchos a uno" 
     * primer parametro: la clase del modelo con que se creará la relacion.
     * segundo parametro: el nombre de la llave foranea de esta clase que hace referencia al 
                        id del otro modelo.
     */
    public function organizacion(){
        return $this->belongsTo(Organizacion::class,'idOrganizacion');
    }

    /**
     *
     * creamos la relacion "uno a muchos"
     * primer parametro: la clase del modelo con que se creará la relacion
     * segundo parametro: el nombre de la llave foranea del otro modelo que hace referencia al 
     *                  id de este modelo
     */
    public function pagos(){
        return $this->hasMany(Pago::class,'idCorte');
    }
}

<?php

namespace App;

use App\Pago;
use App\Organizacion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;


class Corte extends Model
{
    const STATUS_POR_PAGAR = '0';
    const STATUS_PAGADO = '1';
    const STATUS_ATRASADO = '2';
    const REQUIERE_FACTURA = '1';
    const NO_REQUIERE_FACTURA = '0';
    const FACTURA_EMITIDA = '1';
    const FACTURA_NO_EMITIDA = '0';

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

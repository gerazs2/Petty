<?php

namespace App;

use App\Corte;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Pago extends Model
{   
    const METODO_PAGO_TARJETA = 'Tarjeta';
    const METODO_PAGO_EFECTIVO = 'Efectivo';
    const METODO_PAGO_TRANSFERENCIA = 'Transferencia';

    const STATUS_PASARELA_APROVADO = 'Aprovado';
    const STATUS_PASARELA_RECHAZADO = 'Rechazado';
    const STATUS_PASARELA_CANCELADO = 'Cancelado';


    //importamos la clase para la elimiancion virtual
    use softDeletes;

    //hacemos referencia a la tabla que corresponde el modelo
    protected $table = 'pagos';

    //definimos los campos que seran tratados como fechas
    protected $dates = ['deleted_at','fecha'];

    //definimos los campos que se podran ingresar al crear el registro
    protected $fillable = [
    	'fecha',
    	'monto',
    	'metodoPago',
    	'status',
    	'statusPasarela',
    	'idCorte'
	];

    /**
     * creamos la relacion "muchos a uno" 
     * primer parametro: la clase del modelo con que se creará la relacion.
     * segundo parametro: el nombre de la llave foranea de esta clase que hace referencia al 
                        id del otro modelo.
     */
    public function corte(){
        return $this->belongsTo(Corte::class,'idCorte');
    }
}

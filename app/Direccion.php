<?php

namespace App;

use App\Sepomex;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Direccion extends Model
{
    use SoftDeletes;

    //tabla asociada al modelo
    protected $table = 'direcciones';

    //importamos la clase softDeletes para la eliminacion bandera
    protected $dates = ['deleted_at'];

    protected $fillable = [
    	'calle',
    	'numExt',
    	'numInt',
    	'referencia',
    	'idSepomex'
    ];

    public function sepomex(){
    	return $this->belongsTo(Sepomex::class);
    }
}

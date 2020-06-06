<?php

namespace App;

use App\Sepomex;
use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    //tabla asociada al modelo
    protected $table = 'direcciones';

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

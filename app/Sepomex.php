<?php

namespace App;

use App\Direccion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sepomex extends Model
{
    use SoftDeletes;

    //la tabla asociada al modelo
    protected $table = 'sepomex';

    //importamos la clase softDeletes para la eliminacion bandera
    protected $dates = ['deleted_at'];

    //los campos que se podran llenar al crear el registro
    protected $fillable = [
    	'cp',
    	'asentamiento',
    	'tipoAsentamiento',
    	'municipio',
    	'estado',
    	'ciudad',
    	'pais'
    ];

    public function direcciones(){
        return $this->hasMany(Direccion::class,'idSepomex');
    }
}

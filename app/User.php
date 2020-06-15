<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    const USUARIO_VERIFICADO = '1';
    const USUARIO_NO_VERIFICADO = '0';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'nombre',
        'password',
        'name',
        'lastname', 
        'email', 
        'contrasena',
        'telefono',
        'fotoPerfil',
        'idTipoUsuario',
        'idDireccion',
        'verificado',
        'rememberToken',
        'verificationToken'
    ];

    //importamos la clase softDeletes para la eliminacion bandera
    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'contrasena',
        'verificationToken',
        'rememberToken'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function usuarioVerificado(){
        return $this->verificado == User::USUARIO_VERIFICADO;
    }

    public static function generarVerificationTOken(){
        return str_random(40);
    }


}

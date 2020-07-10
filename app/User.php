<?php

namespace App;

use App\Mascota;
use App\Direccion;
use App\TipoUsuario;
use App\Veterinario;
use App\Calificacion;
use App\Organizacion;
use Illuminate\Support\Str;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, HasApiTokens;

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

    public static function generarVerificationToken(){
        return Str::random(40);
    }

    /**
     * creamos la relacion "muchos a uno" 
     * primer parametro: la clase del modelo con que se creará la relacion.
     * segundo parametro: el nombre de la llave foranea de esta clase que hace referencia al 
                        id del otro modelo.
     */
    public function direccion(){
        return $this->belongsTo(Direccion::class,'idDireccion');
    }

    /**
     * creamos la relacion "muchos a uno" 
     * primer parametro: la clase del modelo con que se creará la relacion.
     * segundo parametro: el nombre de la llave foranea de esta clase que hace referencia al 
                        id del otro modelo.
     */
    public function tipoUsuario(){
        return $this->belongsTo(TipoUsuario::class,'idTipoUsuario');
    }

    /**
     *
     * creamos la relacion "uno a muchos"
     * primer parametro: la clase del modelo con que se creará la relacion
     * segundo parametro: el nombre de la llave foranea del otro modelo que hace referencia al 
     *                  id de este modelo
     */
    public function calificacionesCompradores(){
        return $this->hasMany(Calificacion::class,'idUsuarioContrato');
    }

    /**
     *
     * creamos la relacion "uno a muchos"
     * primer parametro: la clase del modelo con que se creará la relacion
     * segundo parametro: el nombre de la llave foranea del otro modelo que hace referencia al 
     *                  id de este modelo
     */
    public function calificacionesPrestadores(){
        return $this->hasMany(Calificacion::class,'idUsuarioPrestador');
    }

    /**
     *
     * creamos la relacion "uno a muchos"
     * primer parametro: la clase del modelo con que se creará la relacion
     * segundo parametro: el nombre de la llave foranea del otro modelo que hace referencia al 
     *                  id de este modelo
     */
    public function mascotas(){
        return $this->hasMany(Mascota::class,'idUsuario');
    }

    /**
     *
     * creamos la relacion "uno a muchos"
     * primer parametro: la clase del modelo con que se creará la relacion
     * segundo parametro: el nombre de la llave foranea del otro modelo que hace referencia al 
     *                  id de este modelo
     */
    public function servicios(){
        return $this->hasMany(Servicio::class,'idUsuario');
    }

    /**
     *
     * creamos la relacion "uno a muchos"
     * primer parametro: la clase del modelo con que se creará la relacion
     * segundo parametro: el nombre de la llave foranea del otro modelo que hace referencia al 
     *                  id de este modelo
     */
    public function serviciosContratados(){
        return $this->hasMany(ServicioContratado::class,'idUsuarioContrato');
    }

    /**
     *
     * creamos la relacion "uno a muchos"
     * primer parametro: la clase del modelo con que se creará la relacion
     * segundo parametro: el nombre de la llave foranea del otro modelo que hace referencia al 
     *                  id de este modelo
     */
    public function mensajesEmisor(){
        return $this->hasMany(Mensaje::class,'idUsuarioEmisor');
    }

    /**
     *
     * creamos la relacion "uno a muchos"
     * primer parametro: la clase del modelo con que se creará la relacion
     * segundo parametro: el nombre de la llave foranea del otro modelo que hace referencia al 
     *                  id de este modelo
     */
    public function mensajesReceptor(){
        return $this->hasMany(Mensaje::class,'idUsuarioReceptor');
    }

    /**
     *
     * creamos la relacion "uno a muchos"
     * primer parametro: la clase del modelo con que se creará la relacion
     * segundo parametro: el nombre de la llave foranea del otro modelo que hace referencia al 
     *                  id de este modelo
     */
    public function veterinarios(){
        return $this->hasMany(Veterinario::class,'idUsuario');
    }

    /**
     *
     * creamos la relacion "muchos a muchos"
     * funcion belongsToMany
     * primer parametro: la clase del modelo con el que tiene la relacion muchos a muchos
     * segundo parametro: el nombre de la tabla pivote
     * tercer parametro: el nombre de la llave foranea de la tabla pivote que hace referencia al id de este modelo
     * cuarto parametro: el nombre de la llave foranea de la tabla pivote que hace referencia al id del otro modelo
     */
    public function usuariosOrganizacion(){
        return $this->belongsToMany(Organizacion::class, 'organizacionUsuario', 'idUsuario', 'idOrganizacion')
            ->as('usuariosOrganizacion') // el nombre que recibira el objeto con los registros de la tabla pivote
            ->withPivot('esAdmin'); // indicamos los campos adicionales que tiene la tabla pivote a parte de las llaves foraneas
    }

}

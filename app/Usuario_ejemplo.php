<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{   
    /**
     * La tabla asociada con el modelo
     * @var string
     */
    protected $table = 'usuarios';
    /**
     * La llave primaria asociada conla tabla
     * @var string
     */
    protected $primaryKey = 'id_usuario';
    /**
     * Indica si el ID es autoincrementable.
     *
     * @var bool
     */
    public $incrementing = false;
    /**
     * Indica el "tipo" ID autoincrementable.
     *
     * @var string
     */
    protected $keyType = 'integer'; //
    /**
     * Indica qie el modelo debería tener marcas de tiempo.
     * Es decir que tenga los campos created_at y updated_at
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * El formato de almacenamiento de las columnas fecha del modelo.
     *
     * @var string
     */
    protected $dateFormat = 'U';

    /**
     * En caso de ser necesario cambiar los valores por default para las marcas de tiempo.
     *   Es decir, cambiar el nombre de los campos created_at y updated_At
     */
    const CREATED_AT = 'fecha_creacion';
    const UPDATED_AT = 'ultima_actualizacion';

    /**
     * El nombre de la conexión para el modelo.
     *
     * @var string|null
     */
    protected $connection = 'nombre-conexion';
    /**
     * Valores por default de los atributos del modelo.
     *
     * @var array
     */
    protected $attributes = [
        'nombre-del-campo' => 0, // valor por default del campo.
    ];
    /**
     * Los campos o atributos que son asignables en masa, básicamente es una lista blanca para un conjunto de columnas
     * que pueden ser asignados directamente en las llamadas de metodo fill(), create() o update().
     *
     * @var array
     */
    protected $fillable = ['campo1', 'campo2'];
    /**
     * Los atributos que no son asignables en masa, actua como un alista negra, no permitiendo la asignación directa
     * a las columnas proporcionadas. Este campo no puede ser utilizado cuando el atributo $fillable esté ya definido.
     * Es decir, o se usa $fillable o $guarded, unca ambos.
     *
     * @var array
     */
    protected $guarded = ['campo1', 'campo2'];

    /**
     * Las relaciones la carga apresurada (contraria a lazy load) en cada query.
     *
     * @var array
     */
    protected $with = [];

    /**
     * El número de modelos que se devuelven por paginación.
     *
     * @var int
     */
    protected $perPage = 15;
    
    /**
     * Indica si el modelo existe.
     *
     * @var bool
     */
    public $exists = false;

    /**
     * Indica si el modelo fue insertado durante el ciclo de vida de la petición actual.
     *
     * @var bool
     */
    public $wasRecentlyCreated = false;

    /**
     * Todo los demás que hay en los modelos son métodos para crear, actualizar, listar, eliminar registros en la base
     * datos. Algunos metodos son: 
     * Model::firstOrCreate([])
     * Model::firstOrNew([])
     * Model::updateCreate([])
     * Model::fill([])
     * Model::find([])
     * Model::where(,)
     * Model::get()
     * Model::delete()
     * Model::destroy()
     */
}
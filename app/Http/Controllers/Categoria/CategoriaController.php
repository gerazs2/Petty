<?php

namespace App\Http\Controllers\Categoria;

use App\Categoria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriaController extends Controller
{

    public function __construct(){
        $this->middleware('client')->only(['show', 'index']);
        $this->middleware('auth:api')->except(['show', 'index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = Categoria::all();
        return $this->showAll($categorias, Controller::MESSAGE_OK_, Controller::CODE_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validamos los campos insertados 
        $request->validate([
            'nombreCategoria' => 'required|string|max:' . Categoria::MAX_NOMBRE_CATEGORIA,
            'descripcionCategoria' => 'required|string|max:' . Categoria::MAX_DESCRIPCION_CATEGORIA,
        ]);

        //creamos una nueva instancia de Categoria
        $categoria = new Categoria;

        // asingamos unicamente los campos que se pueden llenar por el cliente
        $categoria->nombreCategoria = $request->nombreCategoria;
        $categoria->descripcionCategoria = $request->descripcionCategoria;

        // guardamos el registro en la DB
        $categoria->save();

        return $this->success($categoria, Controller::MESSAGE_CREATED, Controller::CODE_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // usamos el metodo findOrFail para devolver un error automatico en caso de no existir el registro
        $categoria = Categoria::findOrFail($id);
        return $this->showOne($categoria, Controller::MESSAGE_OK_, Controller::CODE_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Buscamos primeramente si existe el registro
        $categoria = Categoria::findOrFail($id);

        // validamos si en los campos insertados se incluyen campos "prohibidos"
        if ($request->has('id')) {
            return $this->errorResponse('No se puede actualizar el campo id', Controller::CODE_BAD_REQUEST);
        }

        // validamos que los datos insertados tengan el formato requerido
        $request->validate([
            'nombreCategoria' => 'string|max:' . Categoria::MAX_NOMBRE_CATEGORIA,
            'descripcionCategoria' => 'string|max:' . Categoria::MAX_DESCRIPCION_CATEGORIA,
        ]);

        // se agregan a la instancia los campos que se hayan insertado en la peticion
        if ($request->has('nombreCategoria')) {
            $categoria->nombreCategoria = $request->nombreCategoria;
        }

        if ($request->has('descripcionCategoria')) {
            $categoria->descripcionCategoria = $request->descripcionCategoria;
        }

        // comprobamos si la instancia ha tenido algun cambio para ser actualizado
        if (!$categoria->isDirty()) {
            return $this->errorResponse('Se debe especificar al menos un campo diferente para actualizar el registro.', Controller::CODE_BAD_REQUEST);
        }

        // actualizamos el registro
        $categoria->save();

        return $this->success($categoria, Controller::MESSAGE_OK_, Controller::CODE_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->delete();
        return $this->success($categoria, Controller::MESSAGE_OK_, Controller::CODE_OK);
    }
}

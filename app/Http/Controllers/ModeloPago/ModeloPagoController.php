<?php

namespace App\Http\Controllers\ModeloPago;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ModeloPago;

class ModeloPagoController extends Controller
{
    
    public function __construct(){
        $this->middleware('client')->only(['show','index']);
        $this->middleware('auth:api')->except(['show', 'index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modelosPago = ModeloPago::all();
        return $this->showAll($modelosPago, Controller::MESSAGE_OK_, Controller::CODE_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validación de los campos recibidos en el Request 
        $request->validate(
            ModeloPago::VALIDATION_RULES,
            ModeloPago::MESSAGES,
            ModeloPago::ATTRIBUTES
        );

        // Creación de una nueva instancia de Organización
        $modeloPago = new ModeloPago();

        // Asignación de los campos que sólo pueden ser llenados por el cliente
        $modeloPago->nombre = $request->nombre;
        $modeloPago->descripcion = $request->descripcion;
        $modeloPago->diasCorte = $request->diasCorte;
        $modeloPago->diasLimite = $request->diasLimite;

        // guardamos el registro en la DB
        $modeloPago->save();

        return $this->success($modeloPago, Controller::MESSAGE_CREATED, Controller::CODE_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Usamos el método findOrFail para devolver un error automático en caso de no existir el registro
        $modeloPago = ModeloPago::findOrFail($id);
        return $this->showOne($modeloPago, Controller::MESSAGE_OK_, Controller::CODE_OK);
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
        // Buscamos si existe el registro en la BDD
        $modeloPago = ModeloPago::findOrFail($id);

        // Validamos si en los campos recibidos en el request se incluyen campos "prohibidos"
        if ($request->has('id')) {
            return $this->errorResponse('No se puede actualizar el campo id', Controller::CODE_BAD_REQUEST);
        }

        // Validamos que los datos recibidos en el Request tengan el formato requerido
        $request->validate(
            ModeloPago::VALIDATION_RULES,
            ModeloPago::MESSAGES,
            ModeloPago::ATTRIBUTES
        );

        // Se agregan a la instancia los campos que se hayan recibido en el request
        if ($request->has('nombre')) {
            $modeloPago->nombre = $request->nombre;
        }
        if ($request->has('descripcion')) {
            $modeloPago->descripcion = $request->descripcion;
        }
        if ($request->has('diasCorte')) {
            $modeloPago->diasCorte = $request->diasCorte;
        }
        if ($request->has('diasLimite')) {
            $modeloPago->diasLimite = $request->diasLimite;
        }

        // Comprobamos si la instancia ha tenido algun cambio para ser actualizado
        if (!$modeloPago->isDirty()) {
            return $this->errorResponse('Se debe especificar al menos un campo diferente para actualizar el registro.', Controller::CODE_BAD_REQUEST);
        }

        // Guardamos el registro en la BDD
        $modeloPago->save();

        return $this->success($modeloPago, Controller::MESSAGE_OK_, Controller::CODE_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $modeloPago = ModeloPago::findOrFail($id);
        $modeloPago->delete();
        return $this->success($modeloPago, Controller::MESSAGE_OK_, Controller::CODE_OK);
    }
}

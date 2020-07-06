<?php

namespace App\Http\Controllers\ServicioContratado;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ServicioContratado;

class ServicioContratadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $serviciosContratados = ServicioContratado::all();
        return $this->showAll($serviciosContratados, Controller::MESSAGE_OK_, Controller::CODE_OK);
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
            ServicioContratado::VALIDATION_RULES,
            ServicioContratado::MESSAGES,
            ServicioContratado::ATTRIBUTES
        );

        // Creación de una nueva instancia de Organización
        $servicioContratado = new ServicioContratado();

        // Asignación de los campos que sólo pueden ser llenados por el cliente
        $servicioContratado->nombreServicio = $request->nombreServicio;
        $servicioContratado->descricpion = $request->descripcion;
        $servicioContratado->precioBase = $request->precioBase;
        $servicioContratado->observacinesFinales = $request->observacinesFinales;
        $servicioContratado->statusServicio = $request->statusServicio;
        $servicioContratado->costoFinal = $request->costoFinal;
        $servicioContratado->fechaContrato = $request->fechaContrato;
        $servicioContratado->fechaTermino = $request->fechaTermino;
        $servicioContratado->fechaEjecución = $request->fechaEjecución;
        $servicioContratado->idUsuarioContrato = $request->idUsuarioContrato;
        $servicioContratado->idMascota = $request->idMascota;
        $servicioContratado->idSubcategoria = $request->idSubcategoria;

        // guardamos el registro en la DB
        $servicioContratado->save();

        return $this->success($servicioContratado, Controller::MESSAGE_CREATED, Controller::CODE_CREATED);
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
        $servicioContatado = ServicioContratado::findOrFail($id);
        return $this->showOne($servicioContatado, Controller::MESSAGE_OK_, Controller::CODE_OK);
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
        $servicioContratado = ServicioContratado::findOrFail($id);

        // Validamos si en los campos recibidos en el request se incluyen campos "prohibidos"
        if ($request->has('id')) {
            return $this->errorResponse('No se puede actualizar el campo id', Controller::CODE_BAD_REQUEST);
        }

        // Validamos que los datos recibidos en el Request tengan el formato requerido
        $request->validate(
            ServicioContratado::VALIDATION_RULES,
            ServicioContratado::MESSAGES,
            ServicioContratado::ATTRIBUTES
        );

        // Se agregan a la instancia los campos que se hayan recibido en el request
        if ($request->has('nombreServicio')) {
            $servicioContratado->nombreServicio = $request->nombreServicio;
        }
        if ($request->has('descripcion')) {
            $servicioContratado->descripcion = $request->descripion;
        }
        if ($request->has('precioBase')) {
            $servicioContratado->precioBase = $request->precioBase;
        }
        if ($request->has('observacinesFinales')) {
            $servicioContratado->observacinesFinales = $request->observacinesFinales;
        }
        if ($request->has('statusServicio')) {
            $servicioContratado->statusServicio = $request->statusServicio;
        }
        if ($request->has('costoFinal')) {
            $servicioContratado->costoFinal = $request->costoFinal;
        }
        if ($request->has('fechaContrato')) {
            $servicioContratado->fechaContrato = $request->fechaContrato;
        }
        if ($request->has('fechaTermino')) {
            $servicioContratado->fechaTermino = $request->fechaTermino;
        }
        if ($request->has('fechaEjecucion')) {
            $servicioContratado->fechaEjecucion = $request->fechaEjecucion;
        }
        if ($request->has('idUsuarioContrato')) {
            $servicioContratado->idUsuarioContrato = $request->idUsuarioContrato;
        }
        if ($request->has('idMascota')) {
            $servicioContratado->idMascota = $request->idMascota;
        }
        if ($request->has('idSubCategoria')) {
            $servicioContratado->idSubCategoria = $request->idSubCategoria;
        }

        // Comprobamos si la instancia ha tenido algun cambio para ser actualizado
        if (!$servicioContratado->isDirty()) {
            return $this->errorResponse('Se debe especificar al menos un campo diferente para actualizar el registro.', Controller::CODE_BAD_REQUEST);
        }

        // Guardamos el registro en la BDD
        $servicioContratado->save();

        return $this->success($servicioContratado, Controller::MESSAGE_OK_, Controller::CODE_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $servicioContratado = ServicioContratado::findOrFail($id);
        $servicioContratado->delete();
        return $this->success($servicioContratado, Controller::MESSAGE_OK_, Controller::CODE_OK);
    }
}

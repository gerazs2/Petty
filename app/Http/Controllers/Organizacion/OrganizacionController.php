<?php

namespace App\Http\Controllers\Organizacion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Organizacion;

class OrganizacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $organizaciones = Organizacion::all();
        return $this->showAll($organizaciones, Controller::MESSAGE_OK_, Controller::CODE_OK);
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
        $request->validate(Organizacion::VALIDATION_RULES, Organizacion::MESSAGES, Organizacion::ATTRIBUTES);

        // Creación de una nueva instancia de Organización
        $organizacion = new Organizacion();

        // Asignación de los campos que sólo pueden ser llenados por el cliente
        $organizacion->nombreOrg = $request->nombreOrg;
        $organizacion->emailOrg = $request->emailOrg;
        $organizacion->rfc = $request->rfc;
        $organizacion->idModeloPago = $request->idModeloPago;
        // TODO Revisar en caso de NUEVAS Direcciones
        $organizacion->idDireccion = $request->idDireccion;

        // guardamos el registro en la DB
        $organizacion->save();

        return $this->success($organizacion, Controller::MESSAGE_CREATED, Controller::CODE_CREATED);
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
        $organizacion = Organizacion::findOrFail($id);
        return $this->showOne($organizacion, Controller::MESSAGE_OK_, Controller::CODE_OK);
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
        $organizacion = Organizacion::findOrFail($id);

        // Validamos si en los campos recibidos en el request se incluyen campos "prohibidos"
        if ($request->has('id')) {
            return $this->errorResponse('No se puede actualizar el campo id', Controller::CODE_BAD_REQUEST);
        }

        // Validamos que los datos recibidos en el Request tengan el formato requerido
        $request->validate(Organizacion::VALIDATION_RULES, Organizacion::MESSAGES, Organizacion::ATTRIBUTES);

        // Se agregan a la instancia los campos que se hayan recibido en el request
        if ($request->has('nombreOrg')) {
            $organizacion->nombreOrg = $request->nombreOrg;
        }
        if ($request->has('emailOrg')) {
            $organizacion->emailOrg = $request->emailOrg;
        }
        if ($request->has('rfc')) {
            $organizacion->rfc = $request->rfc;
        }
        if ($request->has('idModeloPago')) {
            $organizacion->idModeloPago = $request->idModeloPago;
        }
        // TODO Revisar en caso de NUEVAS Direcciones
        if ($request->has('idDireccion')) {
            $organizacion->idDireccion = $request->idDireccion;
        }

        // Comprobamos si la instancia ha tenido algun cambio para ser actualizado
        if (!$organizacion->isDirty()) {
            return $this->errorResponse('Se debe especificar al menos un campo diferente para actualizar el registro.', Controller::CODE_BAD_REQUEST);
        }

        // Guardamos el registro en la BDD
        $organizacion->save();


        return $this->success($organizacion, Controller::MESSAGE_OK_, Controller::CODE_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $organizacion = Organizacion::findOrFail($id);
        $organizacion->delete();
        return $this->success($organizacion, Controller::MESSAGE_OK_, Controller::CODE_OK);
    }
}

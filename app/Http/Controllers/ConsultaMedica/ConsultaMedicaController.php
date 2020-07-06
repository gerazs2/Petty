<?php

namespace App\Http\Controllers\ConsultaMedica;

use App\ConsultaMedica;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConsultaMedicaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cosultasMedicas = ConsultaMedica::all();
        return $this->showAll($cosultasMedicas, Controller::MESSAGE_OK_, Controller::CODE_OK);
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
            ConsultaMedica::VALIDATION_RULES,
            ConsultaMedica::MESSAGES,
            ConsultaMedica::ATTRIBUTES
        );

        // Creación de una nueva instancia de Organización
        $consultaMedica = new ConsultaMedica();

        // Asignación de los campos que sólo pueden ser llenados por el cliente
        $consultaMedica->diagnostico = $request->diagnostico;
        $consultaMedica->tratamiento = $request->tratamiento;
        $consultaMedica->comentarios = $request->comentarios;
        $consultaMedica->fechaConsulta = $request->fechaConsulta;
        $consultaMedica->idMascota = $request->idMascota;
        $consultaMedica->idVeterinario = $request->idVeterinario;

        // guardamos el registro en la DB
        $consultaMedica->save();

        return $this->success($consultaMedica, Controller::MESSAGE_CREATED, Controller::CODE_CREATED);
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
        $consultaMedica = ConsultaMedica::findOrFail($id);
        return $this->showOne($consultaMedica, Controller::MESSAGE_OK_, Controller::CODE_OK);
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
        $consultaMedica = ConsultaMedica::findOrFail($id);

        // Validamos si en los campos recibidos en el request se incluyen campos "prohibidos"
        if ($request->has('id')) {
            return $this->errorResponse('No se puede actualizar el campo id', Controller::CODE_BAD_REQUEST);
        }

        // Validamos que los datos recibidos en el Request tengan el formato requerido
        $request->validate(
            ConsultaMedica::VALIDATION_RULES,
            ConsultaMedica::MESSAGES,
            ConsultaMedica::ATTRIBUTES
        );

        // Se agregan a la instancia los campos que se hayan recibido en el request
        if ($request->has('diagnostico')) {
            $consultaMedica->diagnostico = $request->diagnostico;
        }
        if ($request->has('tratamiento')) {
            $consultaMedica->tratamiento = $request->tratamiento;
        }
        if ($request->has('comentarios')) {
            $consultaMedica->comentarios = $request->comentarios;
        }
        if ($request->has('fechaNacimiento')) {
            $consultaMedica->fechaNacimiento = $request->fechaNacimiento;
        }
        if ($request->has('idMascota')) {
            $consultaMedica->idMascota = $request->idMascota;
        }
        if ($request->has('idVeterinario')) {
            $consultaMedica->idVeterinario = $request->idVeterinario;
        }

        // Comprobamos si la instancia ha tenido algun cambio para ser actualizado
        if (!$consultaMedica->isDirty()) {
            return $this->errorResponse('Se debe especificar al menos un campo diferente para actualizar el registro.', Controller::CODE_BAD_REQUEST);
        }

        // Guardamos el registro en la BDD
        $consultaMedica->save();

        return $this->success($consultaMedica, Controller::MESSAGE_OK_, Controller::CODE_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $consultaMedica = ConsultaMedica::findOrFail($id);
        $consultaMedica->delete();
        return $this->success($consultaMedica, Controller::MESSAGE_OK_, Controller::CODE_OK);
    }
}

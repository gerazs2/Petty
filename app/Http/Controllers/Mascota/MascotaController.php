<?php

namespace App\Http\Controllers\Mascota;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mascota;

class MascotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mascotas = Mascota::all();
        return $this->showAll($mascotas, Controller::MESSAGE_OK_, Controller::CODE_OK);
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
            Mascota::VALIDATION_RULES,
            Mascota::MESSAGES,
            Mascota::ATTRIBUTES
        );

        // Creación de una nueva instancia de Organización
        $mascota = new Mascota();

        // Asignación de los campos que sólo pueden ser llenados por el cliente
        $mascota->nombreMascota = $request->nombreMascota;
        $mascota->fechaNacimiento = $request->fechaNacimiento;
        $mascota->raza = $request->raza;
        $mascota->color = $request->color;
        $mascota->peso = $request->peso;
        $mascota->tamaño = $request->tamaño;
        $mascota->sexo = $request->sexo;
        $mascota->senParticulares = $request->senParticulares;
        $mascota->idEspecie = $request->idEspecie;
        $mascota->idUsuario = $request->idUsuario;

        // guardamos el registro en la DB
        $mascota->save();

        return $this->success($mascota, Controller::MESSAGE_CREATED, Controller::CODE_CREATED);
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
        $mascota = Mascota::findOrFail($id);
        return $this->showOne($mascota, Controller::MESSAGE_OK_, Controller::CODE_OK);
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
        $mascota = Mascota::findOrFail($id);

        // Validamos si en los campos recibidos en el request se incluyen campos "prohibidos"
        if ($request->has('id')) {
            return $this->errorResponse('No se puede actualizar el campo id', Controller::CODE_BAD_REQUEST);
        }

        // Validamos que los datos recibidos en el Request tengan el formato requerido
        $request->validate(
            Mascota::VALIDATION_RULES,
            Mascota::MESSAGES,
            Mascota::ATTRIBUTES
        );

        // Se agregan a la instancia los campos que se hayan recibido en el request
        if ($request->has('nombreMascota')) {
            $mascota->nombreMascota = $request->nombreMascota;
        }
        if ($request->has('fechaNacimiento')) {
            $mascota->fechaNacimiento = $request->fechaNacimiento;
        }
        if ($request->has('raza')) {
            $mascota->raza = $request->raza;
        }
        if ($request->has('color')) {
            $mascota->color = $request->color;
        }
        if ($request->has('peso')) {
            $mascota->peso = $request->peso;
        }
        if ($request->has('tamaño')) {
            $mascota->tamaño = $request->tamaño;
        }
        if ($request->has('sexo')) {
            $mascota->sexo = $request->sexo;
        }
        if ($request->has('senParticulares')) {
            $mascota->senParticulares = $request->senParticulares;
        }
        if ($request->has('idEspecie')) {
            $mascota->idEspecie = $request->idEspecie;
        }
        if ($request->has('idUsuario')) {
            $mascota->idUsuario = $request->idUsuario;
        }

        // Comprobamos si la instancia ha tenido algun cambio para ser actualizado
        if (!$mascota->isDirty()) {
            return $this->errorResponse('Se debe especificar al menos un campo diferente para actualizar el registro.', Controller::CODE_BAD_REQUEST);
        }

        // Guardamos el registro en la BDD
        $mascota->save();

        return $this->success($mascota, Controller::MESSAGE_OK_, Controller::CODE_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mascota = Mascota::findOrFail($id);
        $mascota->delete();
        return $this->success($mascota, Controller::MESSAGE_OK_, Controller::CODE_OK);
    }
}

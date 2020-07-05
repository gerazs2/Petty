<?php

namespace App\Http\Controllers\TipoUsuario;

use App\TipoUsuario;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TipoUsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipoUsuario = TipoUsuario::all();
        return $this->showAll($tipoUsuario, Controller::MESSAGE_OK_, Controller::CODE_OK );
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
            'tipoUsuario' => 'required|string',
            'descripcionUsuario' => 'required|string',
        ]);

        //creamos una nueva instancia 
        $tipoUsuario = new TipoUsuario;

        // asingamos unicamente los campos que se pueden llenar por el cliente
        $tipoUsuario->tipoUsuario= $request->tipoUsuario;
        $tipoUsuario->descripcionUsuario= $request->descripcionUsuario;
        
        // guardamos el registro en la DB
        $tipoUsuario->save();

        return $this->success($tipoUsuario,Controller::MESSAGE_CREATED, Controller::CODE_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TipoUsuario  $tipoUsuario
     * @return \Illuminate\Http\Response
     */
    public function show(TipoUsuario $tipoUsuario)
    {
        // usamos el metodo findOrFail para devolver un error automatico en caso de no existir el registro
        $tipoUsuario = TipoUsuario::findOrFail($id);
        return $this->showOne($tipoUsuario, Controller::MESSAGE_OK_, Controller::CODE_OK );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TipoUsuario  $tipoUsuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoUsuario $tipoUsuario)
    {
        // Buscamos primeramente si existe el registro
        $tipoUsuario = TipoUsuario::findOrFail($id);

        // validamos si en los campos insertados se incluyen campos "prohibidos"
        if($request->has('id')){
            return $this->errorResponse('No se puede actualizar el campo id', Controller::CODE_BAD_REQUEST);
        }

        // validamos que los datos insertados tengan el formato requerido
        $request->validate([
            'tipoUsuario' => 'string',
            'descripcionUsuario' => 'string',
        ]);

        // se agregan a la instancia los campos que se hayan insertado en la peticion
        if($request->has('tipoUsuario')){
            $tipoUsuario->tipoUsuario = $request->tipoUsuario;
        }
        if($request->has('descripcionUsuario')){
            $tipoUsuario->descripcionUsuario = $request->descripcionUsuario;
        }
        

        // comprobamos si la instancia ha tenido algun cambio para ser actualizado
        if(!$tipoUsuario->isDirty()){
            return $this->errorResponse('Se debe especificar al menos un campo diferente para actualizar el registro.', Controller::CODE_BAD_REQUEST);
        }

        // actualizamos el registro
        $tipoUsuario->save();
        
        return $this->success($tipoUsuario,Controller::MESSAGE_OK_, Controller::CODE_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TipoUsuario  $tipoUsuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoUsuario $tipoUsuario)
    {
        $tipoUsuario = TipoUsuario::findOrFail($id);
        $tipoUsuario->delete();
        return $this->success($tipoUsuario,Controller::MESSAGE_OK_, Controller::CODE_OK);
    }
}

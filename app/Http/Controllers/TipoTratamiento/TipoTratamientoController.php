<?php

namespace App\Http\Controllers\TipoTratamiento;

use App\TipoTratamiento;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TipoTratamientoController extends Controller
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
        $tipoTratamientos = TipoTratamiento::all();
        return $this->showAll($tipoTratamientos, Controller::MESSAGE_OK_, Controller::CODE_OK );
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
            'nombre' => 'required|string'
        ]);

        //creamos una nueva instancia 
        $tipoTratamiento = new TipoTratamiento;

        // asingamos unicamente los campos que se pueden llenar por el cliente
        $tipoTratamiento->cp= $request->cp;
        $tipoTratamiento->asentamiento= $request->asentamiento;
        $tipoTratamiento->tipoAsentamiento= $request->tipoAsentamiento;
        $tipoTratamiento->municipio= $request->municipio;
        $tipoTratamiento->estado= $request->estado;
        $tipoTratamiento->ciudad= $request->ciudad;
        $tipoTratamiento->pais= $request->pais;
        
        // guardamos el registro en la DB
        $tipoTratamiento->save();

        return $this->success($tipoTratamiento,Controller::MESSAGE_CREATED, Controller::CODE_CREATED);
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
        $tipoTratamiento = TipoTratamiento::findOrFail($id);
        return $this->showOne($tipoTratamiento, Controller::MESSAGE_OK_, Controller::CODE_OK );
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
        $tipoTratamiento = TipoTratamiento::findOrFail($id);

        // validamos si en los campos insertados se incluyen campos "prohibidos"
        if($request->has('id')){
            return $this->errorResponse('No se puede actualizar el campo id', Controller::CODE_BAD_REQUEST);
        }
        
        // validamos que los datos insertados tengan el formato requerido
        $request->validate([
            'nombre' => 'string'
        ]);

        // se agregan a la instancia los campos que se hayan insertado en la peticion
        if($request->has('nombre')){
            $tipoTratamiento->nombre = $request->nombre;
        }
        
        // comprobamos si la instancia ha tenido algun cambio para ser actualizado
        if(!$tipoTratamiento->isDirty()){
            return $this->errorResponse('Se debe especificar al menos un campo diferente para actualizar el registro.', Controller::CODE_BAD_REQUEST);
        }

        // actualizamos el registro
        $tipoTratamiento->save();
        
        return $this->success($tipoTratamiento,Controller::MESSAGE_OK_, Controller::CODE_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tipoTratamiento = TipoTratamiento::findOrFail($id);
        $tipoTratamiento->delete();
        return $this->success($tipoTratamiento,Controller::MESSAGE_OK_, Controller::CODE_OK);
    }
}

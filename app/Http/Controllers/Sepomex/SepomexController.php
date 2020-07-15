<?php

namespace App\Http\Controllers\Sepomex;

use App\Sepomex;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SepomexController extends Controller
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
        $sepomex = Sepomex::all();
        return $this->showAll($sepomex, Controller::MESSAGE_OK_, Controller::CODE_OK );
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
            'cp' => 'required|integer',
            'asentamiento' => 'required|string',
            'tipoAsentamiento' => 'required|string',
            'municipio' => 'required|string',
            'estado' => 'required|string',
            'ciudad' => 'required|string',
            'pais' => 'required|string'
        ]);

        //creamos una nueva instancia 
        $sepomex = new Sepomex;

        // asingamos unicamente los campos que se pueden llenar por el cliente
        $sepomex->cp= $request->cp;
        $sepomex->asentamiento= $request->asentamiento;
        $sepomex->tipoAsentamiento= $request->tipoAsentamiento;
        $sepomex->municipio= $request->municipio;
        $sepomex->estado= $request->estado;
        $sepomex->ciudad= $request->ciudad;
        $sepomex->pais= $request->pais;
        
        // guardamos el registro en la DB
        $sepomex->save();

        return $this->success($sepomex,Controller::MESSAGE_CREATED, Controller::CODE_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sepomex  $sepomex
     * @return \Illuminate\Http\Response
     */
    public function show(Sepomex $sepomex)
    {
        // usamos el metodo findOrFail para devolver un error automatico en caso de no existir el registro
        //$sepomex = Sepomex::findOrFail($id);
        return $this->showOne($sepomex, Controller::MESSAGE_OK_, Controller::CODE_OK );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sepomex  $sepomex
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sepomex $sepomex)
    {
        // Buscamos primeramente si existe el registro
        //$sepomex = Sepomex::findOrFail($id);

        // validamos si en los campos insertados se incluyen campos "prohibidos"
        if($request->has('id')){
            return $this->errorResponse('No se puede actualizar el campo id', Controller::CODE_BAD_REQUEST);
        }

        // validamos que los datos insertados tengan el formato requerido
        $request->validate([
            'cp' => 'integer',
            'asentamiento' => 'string',
            'tipoAsentamiento' => 'string',
            'municipio' => 'string',
            'estado' => 'string',
            'ciudad' => 'string',
            'pais' => 'string',
        ]);

        // se agregan a la instancia los campos que se hayan insertado en la peticion
        if($request->has('cp')){
            $sepomex->cp = $request->cp;
        }
        if($request->has('asentamiento')){
            $sepomex->asentamiento = $request->asentamiento;
        }
        if($request->has('tipoAsentamiento')){
            $sepomex->tipoAsentamiento = $request->tipoAsentamiento;
        }
        if($request->has('municipio')){
            $sepomex->municipio = $request->municipio;
        }
        if($request->has('estado')){
            $sepomex->estado = $request->estado;
        }
        if($request->has('ciudad')){
            $sepomex->ciudad = $request->ciudad;
        }
        if($request->has('pais')){
            $sepomex->pais = $request->pais;
        }


        // comprobamos si la instancia ha tenido algun cambio para ser actualizado
        if(!$sepomex->isDirty()){
            return $this->errorResponse('Se debe especificar al menos un campo diferente para actualizar el registro.', Controller::CODE_BAD_REQUEST);
        }

        // actualizamos el registro
        $sepomex->save();
        
        return $this->success($sepomex,Controller::MESSAGE_OK_, Controller::CODE_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sepomex  $sepomex
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sepomex $sepomex)
    {
        //$sepomex = Sepomex::findOrFail($id);
        $sepomex->delete();
        return $this->success($sepomex,Controller::MESSAGE_OK_, Controller::CODE_OK);
    }
}

<?php

namespace App\Http\Controllers\Veterinario;

use App\Veterinario;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VeterinarioController extends Controller
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
        $veterinario = Veterinario::all();
        return $this->showAll($veterinario, Controller::MESSAGE_OK_, Controller::CODE_OK );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'cedula' => 'required|string',
            'curriculum' => 'required|string',
            'titulo' => 'required|string',
            'experiencia' => 'required|string',
            'universidad' => 'required|string',
            'idUsuario' => 'required|integer',
        ]);

        $veterinario = new Veterinario;

        $veterinario->cedula = $request->cedula;
        $veterinario->curriculum = $request->curriculum;
        $veterinario->titulo = $request->titulo;
        $veterinario->experiencia = $request->experiencia;
        $veterinario->universidad = $request->universidad;
        $veterinario->idUsuario = $request->idUsuario;

        $veterinario -> save();

        return $this->success($veterinario,Controller::MESSAGE_CREATED, Controller::CODE_CREATED);
   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $veterinario = Veterinario::findOrFail($id);
        return $this->showOne($veterinario, Controller::MESSAGE_OK_, Controller::CODE_OK );
  
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
      
        $veterinario = Veterinario::findOrFail($id);

        if($request->has('id')){
            return $this->errorResponse('No se puede actualizar el campo id', Controller::CODE_BAD_REQUEST);
        }

        if($request->has('idUsuario')){
            return $this->errorResponse('No se puede actualizar el campo idUsuario', Controller::CODE_BAD_REQUEST);
        }

        $request->validate([
            'cedula' => 'required|string',
            'curriculum' => 'required|string',
            'titulo' => 'required|string',
            'experiencia' => 'required|string',
            'universidad' => 'required|string',
        ]);

        if($request->has('cedula')){
            $veterinario->cedula = $request->cedula; 
        }

        if($request->has('curriculum')){
            $veterinario->curriculum = $request->curriculum; 
        }

        if($request->has('titulo')){
            $veterinario->titulo = $request->titulo; 
        }

        if($request->has('experiencia')){
            $veterinario->experiencia = $request->experiencia; 
        }

        if($request->has('universidad')){

            $veterinario->experiencia = $request->experiencia; 
        }

        $veterinario -> save();

        return $this->success($veterinario,Controller::MESSAGE_OK_, Controller::CODE_OK);
    
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $veterinario = Veterinario::findOrFail($id);
        $veterinario->delete();
        return $this->success($veterinario,Controller::MESSAGE_OK_, Controller::CODE_OK);
    
    }
}

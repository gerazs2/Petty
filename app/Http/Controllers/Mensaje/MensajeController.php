<?php

namespace App\Http\Controllers\Mensaje;


use App\Mensaje;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MensajeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mensajes = Mensaje::all();
        return $this->showAll($mensajes, Controller::MESSAGE_OK_, Controller::CODE_OK );
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reglas->validate([
            'idUsuarioEmisor' => 'required|integer',
            'idUsuarioReceptor' => 'required|integer',
            'idServicioContratado' => 'required|integer',
            'mensaje' => 'required|intstringeger'
        ]);

        $this->validate($request,$reglas); 
        $campos = $request->all();  
        $mensajes = Mensaje::create($campos);

        return $this->success($mensajes,Controller::MESSAGE_CREATED, Controller::CODE_CREATED);
 

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

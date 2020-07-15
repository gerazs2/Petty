<?php

namespace App\Http\Controllers\Mensaje;


use App\Mensaje;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MensajeController extends Controller
{

    public function __construct(){
        $this->middleware('auth:api');
    }

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
        $request->validate([
            'mensaje' => 'required|string',
            'fechaEnvio'=>'required|date_format:Y-m-d H:i:s',
            'idUsuarioEmisor' => 'required|integer',
            'idUsuarioReceptor' => 'required|integer',
            'idServicioContratado' => 'required|integer',

        ]);

        $mensaje = new Mensaje;
        
        $mensaje->mensaje = $request->mensaje;
        $mensaje->fechaEnvio = $request->fechaEnvio;
        $mensaje->idUsuarioEmisor = $request->idUsuarioEmisor;
        $mensaje->idUsuarioReceptor = $request->idUsuarioReceptor;
        $mensaje->idServicioContratado = $request->idServicioContratado;

        $mensaje->save();

        return $this->success($mensaje,Controller::MESSAGE_CREATED, Controller::CODE_CREATED);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mensaje = Mensaje::findOrFail($id);
        return $this->showOne($mensaje, Controller::MESSAGE_OK_, Controller::CODE_OK );
 
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
        /** Los mensajes no se deben */
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mensaje = Mensaje::findOrFail($id);
        $mensaje->delete();
        return $this->success($mensaje,Controller::MESSAGE_OK_, Controller::CODE_OK);
 
    }
}

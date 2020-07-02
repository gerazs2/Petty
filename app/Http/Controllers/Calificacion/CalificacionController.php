<?php

namespace App\Http\Controllers\Calificacion;

use App\Calificacion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CalificacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $calificaciones = Calificacion::all();
        return $this->showAll($calificaciones, Controller::MESSAGE_OK_, Controller::CODE_OK );
        
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
            'calificacion' => 'required|integer',
            'comentario' => 'required|string',
            'idServicio' => 'required|integer',
            'idUsuarioPrestador' => 'required|integer',
            'idServicioContratado' => 'required|integer',
            'idUsuarioContrato' => 'required|integer',
        ]);
        $campos = $request->all();
        $calificacion = Calificacion::create($campos);
        //return $this->showOne($calificacion, Controller::MESSAGE_CREATED, Controller::CODE_CREATED);
        return $this->success($calificacion,Controller::MESSAGE_CREATED, Controller::CODE_CREATED);
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
        $calificacion = Calificacion::findOrFail($id);
        //echo json_encode(  $calificacion );
        return $this->showOne($calificacion, Controller::MESSAGE_OK_, Controller::CODE_OK );

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

        $calificacion = Calificacion::findOrFail($id);

        if($request->has('idServicio')){
            return $this->errorResponse('No se puede actualizar el campo idServicio', Controller::CODE_BAD_REQUEST);
        }
        if($request->has('idUsuarioPrestador')){
            return $this->errorResponse('No se puede actualizar el campo idUsuarioPrestador', Controller::CODE_BAD_REQUEST);
        }
        if($request->has('idServicioContratado')){
            return $this->errorResponse('No se puede actualizar el campo idServicioContratado', Controller::CODE_BAD_REQUEST);
        }
        if($request->has('idUsuarioContrato')){
            return $this->errorResponse('No se puede actualizar el campo idUsuarioContrato', Controller::CODE_BAD_REQUEST);
        }

        if($request->has('calificacion')){
            $calificacion->calificacion = $request->calificacion;
        }

        if($request->has('comentario')){
            $calificacion->comentario = $request->comentario;
        }

        $request->validate([
            'calificacion' => 'integer',
            'comentario' => 'string'
        ]);

        if(!$calificacion->isDirty()){
            return $this->errorResponse('Se debe especificar al menos un campo diferente para actualizar el registro.', Controller::CODE_BAD_REQUEST);
        }

        $calificacion->save();
        //return $this->showOne($calificacion, Controller::MESSAGE_CREATED, Controller::CODE_CREATED);
        return $this->success($calificacion,Controller::MESSAGE_OK_, Controller::CODE_OK);
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
        $calificacion = Calificacion::findOrFail($id);
        $calificacion->delete();
        return $this->success($calificacion,Controller::MESSAGE_OK_, Controller::CODE_OK);

    }
}

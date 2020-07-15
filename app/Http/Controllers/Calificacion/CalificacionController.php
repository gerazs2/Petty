<?php

namespace App\Http\Controllers\Calificacion;

use App\Calificacion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CalificacionController extends Controller
{
    public function __construct(){
        $this->middleware('client')->only(['show']);
        $this->middleware('auth:api')->except(['show']);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()){
            if (Auth::user()->ability('administrador','calificacion-listar', ['validate_all'=> true])){
                $calificaciones = Calificacion::all();
                return $this->showAll($calificaciones, Controller::MESSAGE_OK_, Controller::CODE_OK );
            }else{
                return $this->errorResponse('No tienes permiso para realizar esta acción', Controller::CODE_FORBIDDEN);
            }
        }else{
            return $this->errorResponse('Credenciales Incorrectas', Controller::CODE_UNAUTHORIZED);
        }
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
            'calificacion' => 'required|integer',
            'comentario' => 'required|string',
            'idServicio' => 'required|integer',
            'idUsuarioPrestador' => 'required|integer',
            'idServicioContratado' => 'required|integer',
            'idUsuarioContrato' => 'required|integer',
        ]);

        //creamos una nueva instancia de Calificacion
        $calificacion= new Calificacion;

        // asingamos unicamente los campos que se pueden llenar por el cliente
        $calificacion->calificacion= $request->calificacion;
        $calificacion->comentario= $request->comentario;
        $calificacion->idServicio= $request->idServicio;
        $calificacion->idUsuarioPrestador= $request->idUsuarioPrestador;
        $calificacion->idServicioContratado= $request->idServicioContratado;
        $calificacion->idUsuarioContrato= $request->idUsuarioContrato;
        
        // guardamos el registro en la DB
        $calificacion->save();

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
        // usamos el metodo findOrFail para devolver un error automatico en caso de no existir el registro
        $calificacion = Calificacion::findOrFail($id);
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

        // Buscamos primeramente si existe el registro
        $calificacion = Calificacion::findOrFail($id);

        // validamos si en los campos insertados se incluyen campos "prohibidos"
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

        // validamos que los datos insertados tengan el formato requerido
        $request->validate([
            'calificacion' => 'integer',
            'comentario' => 'string'
        ]);

        // se agregan a la instancia los campos que se hayan insertado en la peticion
        if($request->has('calificacion')){
            $calificacion->calificacion = $request->calificacion;
        }

        if($request->has('comentario')){
            $calificacion->comentario = $request->comentario;
        }

        // comprobamos si la instancia ha tenido algun cambio para ser actualizado
        if(!$calificacion->isDirty()){
            return $this->errorResponse('Se debe especificar al menos un campo diferente para actualizar el registro.', Controller::CODE_BAD_REQUEST);
        }

        // actualizamos el registro
        $calificacion->save();
        
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

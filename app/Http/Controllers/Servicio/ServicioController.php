<?php

namespace App\Http\Controllers\Servicio;

use App\Servicio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServicioController extends Controller
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
        //
        //echo "hola";
        $servicios = Servicio::all();
        //echo json_encode($servicios);
        return $this->showAll($servicios, Controller::MESSAGE_OK_, Controller::CODE_OK );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // validamos los campos insertados 
        $request -> validate(
            Servicio::VALIDATION_RULES,
            Servicio::MESSAGES,
            Servicio::ATTRIBUTES
        );
        
        //Creación de una nueva instancia de Servicio
        $serv = new Servicio();
        
        //Asignación de los campos que solo pueden ser llenados por el cliente
        
        $serv->tipoServicio = $request->tipoServicio;
        $serv->descripcion = $request->descripcion;
        $serv->tipoServicioEsp = $request->tipoServicioEsp;
        $serv->especializacion = $request->especializacion;
        
        $serv->save();
        
        return $this->success($serv,
                             Controller::MESSAGE_CREATED,
                             Controller::CODE_CREATED);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Usamos el método findOrFail para devolver un error automático en caso de no existir el registro
        $serv = Servicio::findOrFail($id);
        return $this->showOne($serv, Controller::MESSAGE_OK_, Controller::CODE_OK);
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
        //Buscamos si existe el registro en la BD}
        $serv = Servicio::findOrFail($id);
        
        //Validamos si en los campos recibidos en el request se incluyen campos "prohibidos"
        if ($request->has('id')){
            return $this->errorResponse('No se puede actualizar el campo id', Controller::CODE_BAD_REQUEST);
        }
        // Validamos que los datos recibidos en el Request tengan el formato requerido
        $request->validate(
            Servicio::VALIDATION_RULES,
            Servicio::MESSAGES,
            Servicio::ATTRIBUTES
        );
        
        // Se agregan a la instancia los campos que se hayan recibido en el request
        if ($request->has('tipoServicio')) {
            $serv->tipoServicio = $request->tipoServicio;
        }
        if ($request->has('descripcion')) {
            $serv->descripcion = $request->descripcion;
        }
        if ($request->has('tipoServicioEsp')) {
            $serv->tipoServicioEsp = $request->tipoServicioEsp;
        }
        if ($request->has('especializacion')) {
            $consultaMedica->especializacion = $request->especializacion;
        }
        
        if (!$serv->isDirty()) {
            return $this->errorResponse('Se debe especificar al menos un campo diferente para actualizar el registro.', Controller::CODE_BAD_REQUEST);
        }
        
        // Guardamos el registro en la BDD
        $serv->save();
        
        return $this->success($serv, Controller::MESSAGE_OK_, Controller::CODE_OK);
        
        
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
        $serv = Servicio::findOrFail($id);
        $serv->delete();
        return $this->success($serv, Controller::MESSAGE_OK_,
                             Controller::CODE_OK);
    }
}

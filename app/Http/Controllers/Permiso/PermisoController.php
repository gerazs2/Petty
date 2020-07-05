<?php

namespace App\Http\Controllers\Permiso;

use App\Permiso;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermisoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permisos = Permiso::all();
        return $this->showAll($permisos, Controller::MESSAGE_OK_, Controller::CODE_OK );
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
            'nombrePermiso' => 'required|string|max:'.Permiso::DIM_MAX_NOMBRE_PERMISO,
            'descripcionPermiso' => 'required|string|max:'.Permiso::DIM_MAX_DESCRIPCION_PERMISO, 
        ]);

        //creamos una nueva instancia 
        $permiso = new Permiso;

        // asingamos unicamente los campos que se pueden llenar por el cliente
        $permiso->nombrePermiso= $request->nombrePermiso;
        $permiso->descripcionPermiso= $request->descripcionPermiso;
        
        // guardamos el registro en la DB
        $permiso->save();

        return $this->success($permiso,Controller::MESSAGE_CREATED, Controller::CODE_CREATED);
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
        $permiso = Permiso::findOrFail($id);
        return $this->showOne($permiso, Controller::MESSAGE_OK_, Controller::CODE_OK );
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
        $permiso = Permiso::findOrFail($id);

        // validamos si en los campos insertados se incluyen campos "prohibidos"
        if($request->has('id')){
            return $this->errorResponse('No se puede actualizar el campo id', Controller::CODE_BAD_REQUEST);
        }
        
        // validamos que los datos insertados tengan el formato requerido
        $request->validate([
            'nombrePermiso' => 'string|max:'.Permiso::DIM_MAX_NOMBRE_PERMISO,
            'descripcionPermiso' => 'string|max:'.Permiso::DIM_MAX_DESCRIPCION_PERMISO, 
        ]);

        // se agregan a la instancia los campos que se hayan insertado en la peticion
        if($request->has('nombrePermiso')){
            $permiso->nombrePermiso = $request->nombrePermiso;
        }
        if($request->has('descripcionPermiso')){
            $permiso->descripcionPermiso = $request->descripcionPermiso;
        }
        

        // comprobamos si la instancia ha tenido algun cambio para ser actualizado
        if(!$permiso->isDirty()){
            return $this->errorResponse('Se debe especificar al menos un campo diferente para actualizar el registro.', Controller::CODE_BAD_REQUEST);
        }

        // actualizamos el registro
        $permiso->save();
        
        return $this->success($permiso,Controller::MESSAGE_OK_, Controller::CODE_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permiso = Permiso::findOrFail($id);
        $permiso->delete();
        return $this->success($permiso,Controller::MESSAGE_OK_, Controller::CODE_OK);
    }
}

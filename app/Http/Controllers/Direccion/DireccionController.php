<?php

namespace App\Http\Controllers\Direccion;

use App\Direccion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DireccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $direcciones = Direccion::all();
        return $this->showAll($direcciones, Controller::MESSAGE_OK_, Controller::CODE_OK );
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
            'calle' => 'required|string|max:'.Direccion::DIM_MAX_CALLE,
            'numExt' => 'required|string|max:'.Direccion::DIM_MAX_NUMEXT,
            'numInt' => 'required|string|max:'.Direccion::DIM_MAX_NUMINT,
            'referencia' => 'required|string|max:'.Direccion::DIM_MAX_REFERENCIA,
            'idSepomex' => 'required|integer'
        ]);

        //creamos una nueva instancia 
        $direccion = new Direccion;

        // asingamos unicamente los campos que se pueden llenar por el cliente
        $direccion->calle= $request->calle;
        $direccion->numExt= $request->numExt;
        $direccion->numInt= $request->numInt;
        $direccion->referencia= $request->referencia;
        $direccion->idSepomex= $request->idSepomex;
        
        // guardamos el registro en la DB
        $direccion->save();

        return $this->success($direccion,Controller::MESSAGE_CREATED, Controller::CODE_CREATED);
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
        $direccion = Direccion::findOrFail($id);
        return $this->showOne($direccion, Controller::MESSAGE_OK_, Controller::CODE_OK );
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
        $direccion = Direccion::findOrFail($id);

        // validamos si en los campos insertados se incluyen campos "prohibidos"
        if($request->has('id')){
            return $this->errorResponse('No se puede actualizar el campo id', Controller::CODE_BAD_REQUEST);
        }
        
        // validamos que los datos insertados tengan el formato requerido
        $request->validate([
            'calle' => 'string|max:'.Direccion::DIM_MAX_CALLE,
            'numExt' => 'string|max:'.Direccion::DIM_MAX_NUMEXT,
            'numInt' => 'string|max:'.Direccion::DIM_MAX_NUMINT,
            'referencia' => 'string|max:'.Direccion::DIM_MAX_REFERENCIA,
            'idSepomex' => 'integer'
        ]);

        // se agregan a la instancia los campos que se hayan insertado en la peticion
        if($request->has('calle')){
            $direccion->calle = $request->calle;
        }
        if($request->has('numExt')){
            $direccion->numExt = $request->numExt;
        }
        if($request->has('numInt')){
            $direccion->numInt = $request->numInt;
        }
        if($request->has('referencia')){
            $direccion->referencia = $request->referencia;
        }
        if($request->has('idSepomex')){
            $direccion->idSepomex = $request->idSepomex;
        }

        // comprobamos si la instancia ha tenido algun cambio para ser actualizado
        if(!$direccion->isDirty()){
            return $this->errorResponse('Se debe especificar al menos un campo diferente para actualizar el registro.', Controller::CODE_BAD_REQUEST);
        }

        // actualizamos el registro
        $direccion->save();
        
        return $this->success($direccion,Controller::MESSAGE_OK_, Controller::CODE_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $direccion = Direccion::findOrFail($id);
        $direccion->delete();
        return $this->success($direccion,Controller::MESSAGE_OK_, Controller::CODE_OK);
    }
}

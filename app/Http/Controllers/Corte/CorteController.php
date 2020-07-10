<?php

namespace App\Http\Controllers\Corte;

use App\Corte;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CorteController extends Controller
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
        $cortes = Corte::all();
        return $this->showAll($cortes, Controller::MESSAGE_OK_, Controller::CODE_OK );
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
            'fecha' => 'required|date_format:Y-m-d H:i:s',
            'periodo' => 'required|string',
            'monto' => 'required|numeric',
            'status' => 'required|in:'.Corte::STATUS_ATRASADO.' , '.Corte::STATUS_PAGADO.','.Corte::STATUS_POR_PAGAR,
            'requiereFactura' => 'required|in:'.Corte::REQUIERE_FACTURA.' , '.Corte::NO_REQUIERE_FACTURA,
            'facturado' => 'required|in:'.Corte::FACTURA_EMITIDA.' , '.Corte::FACTURA_NO_EMITIDA,
            'rutaFactura' => 'required|string',
            'folioFiscal' => 'required|string',
            'fechaLimitePago' => 'required|date_format:Y-m-d H:i:s',
            'idOrganizacion' => 'required|integer',
        ]);

        //creamos una nueva instancia de Corte
        $corte = new Corte;

        // asingamos unicamente los campos que se pueden llenar por el cliente
        $corte->fecha= $request->fecha;
        $corte->periodo= $request->periodo;
        $corte->monto= $request->monto;
        $corte->status= $request->status;
        $corte->requiereFactura= $request->requiereFactura;
        $corte->facturado= $request->facturado;
        $corte->rutaFactura= $request->rutaFactura;
        $corte->folioFiscal= $request->folioFiscal;
        $corte->fechaLimitePago= $request->fechaLimitePago;
        $corte->idOrganizacion= $request->idOrganizacion;
        
        // guardamos el registro en la DB
        $corte->save();

        return $this->success($corte,Controller::MESSAGE_CREATED, Controller::CODE_CREATED);
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
        $corte = Corte::findOrFail($id);
        return $this->showOne($corte, Controller::MESSAGE_OK_, Controller::CODE_OK );
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
        $corte = Corte::findOrFail($id);

        // validamos si en los campos insertados se incluyen campos "prohibidos"
        if($request->has('id')){
            return $this->errorResponse('No se puede actualizar el campo id', Controller::CODE_BAD_REQUEST);
        }
        if($request->has('idOrganizacion')){
            return $this->errorResponse('No se puede actualizar el campo idOrganizacion', Controller::CODE_BAD_REQUEST);
        }
        if($request->has('fecha')){
            return $this->errorResponse('No se puede actualizar el campo fecha', Controller::CODE_BAD_REQUEST);
        }
        if($request->has('periodo')){
            return $this->errorResponse('No se puede actualizar el campo periodo', Controller::CODE_BAD_REQUEST);
        }
        if($request->has('fechaLimitePago')){
            return $this->errorResponse('No se puede actualizar el campo fechaLimitePago', Controller::CODE_BAD_REQUEST);
        }
        if($request->has('monto')){
            return $this->errorResponse('No se puede actualizar el campo monto', Controller::CODE_BAD_REQUEST);
        }

        // validamos que los datos insertados tengan el formato requerido
        $request->validate([
            'status' => 'in:'.Corte::STATUS_ATRASADO.' , '.Corte::STATUS_PAGADO.','.Corte::STATUS_POR_PAGAR,
            'requiereFactura' => 'in:'.Corte::REQUIERE_FACTURA.' , '.Corte::NO_REQUIERE_FACTURA,
            'facturado' => 'in:'.Corte::FACTURA_EMITIDA.' , '.Corte::FACTURA_NO_EMITIDA,
            'rutaFactura' => 'string',
            'folioFiscal' => 'string',
        ]);

        // se agregan a la instancia los campos que se hayan insertado en la peticion
        if($request->has('status')){
            $corte->status = $request->status;
        }
        if($request->has('requiereFactura')){
            $corte->requiereFactura = $request->requiereFactura;
        }
        if($request->has('rutaFactura')){
            $corte->rutaFactura = $request->rutaFactura;
        }
        if($request->has('facturado')){
            $corte->facturado = $request->facturado;
        }
        if($request->has('folioFiscal')){
            $corte->folioFiscal = $request->folioFiscal;
        }

        // comprobamos si la instancia ha tenido algun cambio para ser actualizado
        if(!$corte->isDirty()){
            return $this->errorResponse('Se debe especificar al menos un campo diferente para actualizar el registro.', Controller::CODE_BAD_REQUEST);
        }

        // actualizamos el registro
        $corte->save();
        
        return $this->success($corte,Controller::MESSAGE_OK_, Controller::CODE_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $corte = Corte::findOrFail($id);
        $corte->delete();
        return $this->success($corte,Controller::MESSAGE_OK_, Controller::CODE_OK);
    }
}

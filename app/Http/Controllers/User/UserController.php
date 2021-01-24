<?php

namespace App\Http\Controllers\User;


use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

    public function __construct(){
        $this->middleware('client')->only(['show']);
        $this->middleware('auth:api')->except(['show' ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = User::all();
        return $this->showAll($user, Controller::MESSAGE_OK_, Controller::CODE_OK );
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

    public function email_exist(Request $request){
        $request->validate([
            'cp' => 'required|integer',
            'asentamiento' => 'required|string',
            'tipoAsentamiento' => 'required|string',
            'municipio' => 'required|string',
            'estado' => 'required|string',
            'ciudad' => 'required|string',
            'pais' => 'required|string'
        ]);
    }

}

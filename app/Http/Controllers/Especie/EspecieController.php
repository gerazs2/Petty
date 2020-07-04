<?php

namespace App\Http\Controllers\Especie;

use App\Especie;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EspecieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $especies = Especie::all();
       return $this->showAll($especies, Controller::MESSAGE_OK_, Controller::CODE_OK );
        
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
            'tipoEspecie' => 'required|string',
        ]);

            $especies = new Especie;
     
            $especies->tipoEspecie= $request->tipoEspecie;
      
            $especies->save();

            return $this->success($especies,Controller::MESSAGE_CREATED, Controller::CODE_CREATED);

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
            $especies = Especie::findOrFail($id);
            return $this->showOne($especies, Controller::MESSAGE_OK_, Controller::CODE_OK );
       
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
        $especies = Especie::findOrFail($id);

        if($request->has('tipoEspecie')){
           
        $especies->tipoEspecie = $request->tipoEspecie;
        
        }

       
       
        $especies->save();

        return $this->success($especies,Controller::MESSAGE_OK_, Controller::CODE_OK);
   

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $especies = Especie::findOrFail($id);
        $especies->delete();
        return $this->success($especies,Controller::MESSAGE_OK_, Controller::CODE_OK);

    }
}

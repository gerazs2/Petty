<?php

namespace App\Http\Controllers\Servicio;

use App\User;
use App\Servicio;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;





class ServicioByUserMunicipalityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = User::findOrFail($request->user()->id);
        $query = DB::table('servicios')
            ->join('users', 'servicios.idUsuario', '=', 'users.id')
            ->join('direcciones', 'users.idDireccion', '=', 'direcciones.id')
            ->join('sepomex', 'direcciones.idSepomex', '=', 'sepomex.id')
            ->join('subcategorias', 'servicios.idSubcategoria', "=", 'subcategorias.id')
            ->join('categorias', "subcategorias.idCategoria", '=', 'categorias.id')
            ->leftJoin('organizaciones', 'organizaciones.idUsuario', '=', 'users.id')
            ->leftJoin('calificaciones', 'calificaciones.idServicio', '=', 'servicios.id')
            ->where('sepomex.municipio', $user->direccion->sepomex->municipio)
            ->select(
                'servicios.*', 
                'subcategorias.nombreSubCat as subcategoria', 
                'categorias.nombreCategoria as categoria',
                DB::raw('IFNULL( organizaciones.nombreOrg, "ND") as empresa '),
                DB::raw('ROUND(AVG(IFNULL( calificaciones.calificacion, 0)),1) as calificacion')
            )

            ->groupBy('servicios.id','organizaciones.id')
            ->latest()
            //->toSql();
            ->get();
        //dd($query);
        return $this->showAll($query, Controller::MESSAGE_OK_, Controller::CODE_OK);
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Servicio  $servicio
     * @return \Illuminate\Http\Response
     */
    public function show(Servicio $servicio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Servicio  $servicio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Servicio $servicio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Servicio  $servicio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Servicio $servicio)
    {
        //
    }
}

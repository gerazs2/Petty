<?php

namespace App\Http\Controllers\Servicio;

use App\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ServicioDetalladoController extends Controller
{

    public function __construct(){
        //$this->middleware('client')->only(['show', 'index']);
        $this->middleware('auth:api')->only(['show', 'index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function show( $servicio)
    {
        /*
            nombreServicio **
            nombre organizacion **
            cuantas calificaciones **
            calificacion promedio **
            descripcion **
            formas de atencion (sucursal, domicilio) **
            ubicacion aproximada (localidad, municipio, estado) **
            categoria y subcategoria **
            horarios de atencion **
            si ofrece servicio 24h **
            costo **

        */
        //    echo($servicio);
        $query = DB::table('servicios')
            ->join('users', 'servicios.idUsuario', '=', 'users.id')
            ->join('direcciones', 'users.idDireccion', '=', 'direcciones.id')
            ->join('sepomex', 'direcciones.idSepomex', '=', 'sepomex.id')
            ->join('subcategorias', 'servicios.idSubcategoria', "=", 'subcategorias.id')
            ->join('categorias', "subcategorias.idCategoria", '=', 'categorias.id')
            ->leftJoin('organizaciones', 'organizaciones.idUsuario', '=', 'users.id')
            ->leftJoin('calificaciones', 'calificaciones.idServicio', '=', 'servicios.id')
            ->leftJoin('serviciosContratados', 'serviciosContratados.idServicio', '=', 'servicios.id')
            ->where('servicios.id', $servicio)
            ->select(
                'servicios.*', 
                'sepomex.municipio',
                'sepomex.estado',
                'subcategorias.nombreSubCat as subcategoria', 
                'categorias.nombreCategoria as categoria',
                DB::raw('IFNULL( organizaciones.nombreOrg, "ND") as empresa '),
                DB::raw('ROUND(AVG(IFNULL( calificaciones.calificacion, 0)),1) as calificacion'),
                DB::raw('COUNT(calificaciones.calificacion) as calificaciones'),
                DB::raw('COUNT(serviciosContratados.id) as vecesContratado')
            )

            ->groupBy('servicios.id','organizaciones.id')
            ->latest()
            //->toSql();
            ->get();
        //echo(json_encode($servicio));
        return $this->showOne($query, Controller::MESSAGE_OK_, Controller::CODE_OK);
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

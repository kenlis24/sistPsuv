<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\municipios;
use Illuminate\Support\Facades\DB;

class Poblacion_familiasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {       
        $municipios = municipios::select("municipios.id","municipios.mun_nombre" ) 
        ->where("municipios.id",'!=',1) 
        ->orderBy("municipios.mun_nombre")
        ->get();   

        return view('poblacion.cargaPoblacion',compact('municipios'));
    }
}

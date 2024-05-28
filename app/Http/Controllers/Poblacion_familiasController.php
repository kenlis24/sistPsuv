<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\municipios;
use App\Models\poblacion_familias;
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
        $usuario = auth()->user()->username;

        $municipios = municipios::select("municipios.id","municipios.mun_nombre" ) 
        ->where("municipios.id",'!=',1) 
        ->orderBy("municipios.mun_nombre")
        ->get();   

        $poblacion_familias = poblacion_familias::join("jefe_familias", "jefe_familias.id", "=", "poblacion_familias.pofa_jefe_id")
        ->select("poblacion_familias.id","poblacion_familias.pofa_nac", "poblacion_familias.pofa_cedula", "poblacion_familias.pofa_nombres", "jefe_familias.jfal_nombres")
        ->where("poblacion_familias.pofa_usuario_creo",$usuario)
        ->orderBy("poblacion_familias.pofa_cedula")
        ->get();

        return view('poblacion.cargaPoblacion',compact('municipios'),compact('poblacion_familias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {               
        $calle = $request->pofa_calle_id;
        $jefeFal = $request->pofa_jefe_id;
        foreach ($request->inputsCed as $key => $value)
        {
            $input['pofa_nac'] = $request->inputsNac[$key];
            $input['pofa_cedula'] = $request->inputsCed[$key];
            $input['pofa_nombres'] = $request->inputsNombre[$key];
            $input['pofa_telefono'] = $request->inputsTelefono[$key];
            $input['pofa_estado'] = $request->pofa_estado[$key];
            $input['pofa_municipio'] = $request->pofa_municipio[$key];
            $input['pofa_parroquia'] = $request->pofa_parroquia[$key];
            $input['pofa_centro'] = $request->pofa_centro[$key];
            if($request->pofa_tipo_reg[$key]=='')
            {
                $input['pofa_tipo_reg'] = 'Registro Manual';
            }
            else
            {
                $input['pofa_tipo_reg'] = $request->pofa_tipo_reg[$key];
            }            
            $input['pofa_fech_nac'] = $request->inputsFechaNac[$key];
            $input['pofa_usuario_creo'] = $request->pofa_usuario_creo[$key];
            $input['pofa_calle_id'] = $calle;
            $input['pofa_jefe_id'] = $jefeFal;

            $existencia = DB::table('poblacion_familias')
            ->select('id')
            ->where('pofa_nac', '=', $input['pofa_nac'])
            ->where('pofa_cedula', '=', $input['pofa_cedula'])
            ->get();            
            if(count($existencia) >= 1) 
            {
                $exist = 'si';
            }
            else
            {
                poblacion_familias::create($input);
            }
            
        }
              
        return redirect('/poblacionpersonas');
        
    }
}

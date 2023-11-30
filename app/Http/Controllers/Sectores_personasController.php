<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\municipios;
use App\Models\sectores;
use App\Models\sectores_personas;
use App\Models\users_sectores;
use Illuminate\Support\Facades\DB;

class Sectores_personasController extends Controller
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

        $userlogueado = auth()->user()->id;
        
        $sector = sectores::Join("users_sectores", "users_sectores.id", "=", "sectores.id")
        ->select("sectores.id","sectores.sec_nombre") 
        ->where("users_sectores.usec_use_id",$userlogueado) 
        ->orderBy("sec_nombre")
        ->get();

        $sectoresPersonas = sectores_personas::Join("sectores", "sectores.id", "=", "sectores_personas.secp_sec_id")
        ->Join("municipios", "municipios.id", "=", "sectores_personas.secp_municipio_carga")
        ->Join("users_sectores", "users_sectores.id", "=", "sectores_personas.secp_sec_id")
        ->select("sectores_personas.id","sectores_personas.secp_nac","sectores_personas.secp_cedula","sectores_personas.secp_nombres","sectores_personas.secp_telefono", "municipios.mun_nombre", "sectores.sec_nombre") 
        ->where("users_sectores.usec_use_id",$userlogueado) 
        ->orderBy("municipios.mun_nombre")
        ->get();

        return view('sectores.cargasectores',compact('municipios'),compact('sector'))->with('sectoresPersonas',$sectoresPersonas);
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {       
        $mensaje = "Guardar";
        $existenciaCedula = DB::table('sectores_personas')
            ->select('id')
            ->where('secp_nac', '=', $request->secp_nac)
            ->where('secp_cedula', '=', $request->secp_cedula)
            ->where('secp_sec_id', '=', $request->secp_sec_id)
            ->get();  

        if (count($existenciaCedula) >= 1) 
        {
            $mensaje = "Esta cedula ya se encuentra en el este sector";
        }
        $input = $request->all();
        //$input['secp_tipo_reg'] = $request->secp_tipo_reg;
        if($mensaje=="Guardar") 
        {
            sectores_personas::create($input);
            return redirect('sectorespersonas');
        }
        else
        {
            return redirect('sectorespersonas')
            ->with("mensaje", $mensaje);  
        }

    }
}

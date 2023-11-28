<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\municipios;
use App\Models\sectores;
use App\Models\Sectores_personas;
use App\Models\Users_sectores;
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
        
        $sector = sectores::Join("users_sectores", "Users_sectores.id", "=", "sectores.id")
        ->select("sectores.id","sectores.sec_nombre") 
        ->where("Users_sectores.usec_use_id",$userlogueado) 
        ->orderBy("sec_nombre")
        ->get();

        $sectoresPersonas = Sectores_personas::Join("sectores", "sectores.id", "=", "Sectores_personas.secp_sec_id")
        ->Join("municipios", "municipios.id", "=", "Sectores_personas.secp_municipio_carga")
        ->Join("users_sectores", "Users_sectores.id", "=", "Sectores_personas.secp_sec_id")
        ->select("Sectores_personas.id","Sectores_personas.secp_nac","Sectores_personas.secp_cedula","Sectores_personas.secp_nombres","Sectores_personas.secp_telefono", "municipios.mun_nombre", "sectores.sec_nombre") 
        ->where("Users_sectores.usec_use_id",$userlogueado) 
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
        $existenciaCedula = DB::table('Sectores_personas')
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
            Sectores_personas::create($input);
            return redirect('sectorespersonas');
        }
        else
        {
            return redirect('sectorespersonas')
            ->with("mensaje", $mensaje);  
        }

    }
}

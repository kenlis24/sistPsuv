<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\municipios;
use App\Models\sectores;
use App\Models\calles;
use App\Models\sectores_personas;
use App\Models\users_sectores;
use App\Models\sector_cargos;
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

        $sector_cargos = sector_cargos::select("sector_cargos.id","sector_cargos.secar_cargo","sector_cargos.secar_cantidad" ) 
        ->where("sector_cargos.secar_estado","=","A") 
        ->orderBy("sector_cargos.secar_cargo")
        ->get();

        $sectoresPersonas = sectores_personas::Join("sectores", "sectores.id", "=", "sectores_personas.secp_sec_id")
        ->Join("municipios", "municipios.id", "=", "sectores_personas.secp_municipio_carga")
        ->Join("users_sectores", "users_sectores.id", "=", "sectores_personas.secp_sec_id")
        ->Join("sector_cargos", "sector_cargos.id", "=", "sectores_personas.secp_cargos_id")
        ->select("sectores_personas.id","sectores_personas.secp_nac","sectores_personas.secp_cedula","sectores_personas.secp_nombres","sectores_personas.secp_telefono", 
        "municipios.mun_nombre", "sectores.sec_nombre","sector_cargos.secar_cargo") 
        ->where("users_sectores.usec_use_id",$userlogueado) 
        ->orderBy("municipios.mun_nombre")
        ->get();

        return view('sectores.cargasectores',compact('municipios'),compact('sector_cargos'))->with('sectoresPersonas',$sectoresPersonas);
    }

    public function index2()
    {       
        $calles = calles::select("calles.id","calles.cal_nombre" ) 
        ->orderBy("calles.cal_nombre")
        ->get();       

        return view('poblacion.cargaPoblacion',compact('calles'));
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
        $request->secp_sec_id = $request->secp_sec_id;
        $request->secp_cargos_id = $request->secp_cargos_id;
        $existenciaCedula = DB::table('sectores_personas')
            ->select('id')
            ->where('secp_nac', '=', $request->secp_nac)
            ->where('secp_cedula', '=', $request->secp_cedula)
            ->where('secp_sec_id', '=', $request->secp_sec_id)
            ->where('secp_cargos_id', '=', $request->secp_cargos_id)
            ->get();  

            $existenciaCargo = DB::table('sectores_personas')
            ->select('id')
            ->where('secp_sec_id', '=', $request->secp_sec_id)
            ->where('secp_cargos_id', '=', $request->secp_cargos_id)
            ->get();                  

           /* $cargos = DB::select("SELECT secar_cantidad from sector_cargos
            where id= '$request->secp_cargos_id'");     */

       /* if ($request->secp_cargos_id==1 && count($existenciaCargo)) 
        {
            $mensaje = "Ya existe la cantidad de personas para ese cargo";
        }*/
        if (count($existenciaCedula) >= 1) 
            {
                $mensaje = "Esta cedula ya se encuentra en el este sector";
            }   
    

        $input = $request->all();
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

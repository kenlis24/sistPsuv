<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\jefe_familias;
use App\Models\municipios;
use Illuminate\Support\Facades\DB;

class Jefe_familiasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {       
        $userlogueadoName = auth()->user()->username;
        $jefe_familias = jefe_familias::join("calles", "calles.id", "=", "jefe_familias.jfal_calle_id")
        ->select("jefe_familias.id","jefe_familias.jfal_nac", "jefe_familias.jfal_cedula", "jefe_familias.jfal_nombres", 
        "jefe_familias.jfal_telefono", "calles.cal_nombre")
        ->where("jefe_familias.jfal_usuario_creo",$userlogueadoName)
        ->orderBy("jefe_familias.jfal_cedula")
        ->get();
        return view('poblacion.jefeFamilia')->with('jefe_familias',$jefe_familias);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $municipios = municipios::select("municipios.id","municipios.mun_nombre" ) 
        ->orderBy("mun_nombre")
        ->get();

        return view('poblacion.createJefeFamilias', compact('municipios'));
    }

    public function store(Request $request)
    {       
        $mensaje = "Guardar";
        $existenciaCedula = DB::table('jefe_familias')
            ->select('id')
            ->where('jfal_nac', '=', $request->jfal_nac)
            ->where('jfal_cedula', '=', $request->jfal_cedula)
            ->get();                   

        if (count($existenciaCedula) >= 1) 
            {
                $mensaje = "Esta cedula ya se encuentra coomo Jefe de Familia";
            }   
    

        $input = $request->all();
        if($mensaje=="Guardar") 
        {
            jefe_familias::create($input);
            return redirect('jefefamilia');
        }
        else
        {
            return redirect('jefefamilia')
            ->with("mensaje", $mensaje);  
        }
    }
}

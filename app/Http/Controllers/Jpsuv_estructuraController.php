<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\municipios;
use App\Models\parroquias;
use App\Models\agrupaciones;
use App\Models\jpsuv_estructuras;
use App\Models\jpsuv_cargos;
use App\Models\militancias;
use Illuminate\Support\Facades\DB;

class Jpsuv_estructuraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $municipios = municipios::select("municipios.id","municipios.mun_nombre" ) 
        ->orderBy("mun_nombre")
        ->get();

        $usu = auth()->user()->usu_mun_id;
      
        $jpsuv_estructuras = jpsuv_estructuras::join("jpsuv_cargos", "jpsuv_cargos.id", "=", "jpsuv_estructuras.estj_car_id")
        ->join("municipios", "municipios.id", "=", "jpsuv_estructuras.estj_nivel_id")
        ->select("jpsuv_estructuras.id","jpsuv_estructuras.estj_nac","jpsuv_estructuras.estj_cedula","jpsuv_estructuras.estj_nombres","jpsuv_estructuras.estj_telefono","jpsuv_cargos.carj_cargo", "municipios.mun_nombre")         
        ->where("jpsuv_estructuras.estj_nivel","municipios") 
        ->where("jpsuv_estructuras.estj_municipio_usu",$usu) 
        ->orderBy("jpsuv_cargos.carj_cargo")
        ->get();

        $jpsuv_cargos = jpsuv_cargos::select("jpsuv_cargos.id","jpsuv_cargos.carj_cargo","jpsuv_cargos.carj_nivel","jpsuv_cargos.carj_cantidad")         
        ->where("jpsuv_cargos.carj_nivel","municipio") 
        ->where("jpsuv_cargos.carj_estado","A")
        ->orderBy("jpsuv_cargos.carj_cargo")
        ->get(); 
        

        return view('jpsuvEstructura.jpsuvEstructuraMunicipios',  compact('jpsuv_cargos'), compact('municipios'))->with('jpsuv_estructuras',$jpsuv_estructuras);
    }

    public function index3()
    {
        $municipios = municipios::select("municipios.id","municipios.mun_nombre" ) 
        ->orderBy("mun_nombre")
        ->get();
        $usu = auth()->user()->usu_mun_id;


            $jpsuv_estructuras = jpsuv_estructuras::join("jpsuv_cargos", "jpsuv_cargos.id", "=", "jpsuv_estructuras.estj_car_id")
            ->join("agrupaciones", "agrupaciones.id", "=", "jpsuv_estructuras.estj_nivel_id")
            ->select("jpsuv_estructuras.id","jpsuv_estructuras.estj_nac","jpsuv_estructuras.estj_cedula","jpsuv_estructuras.estj_nombres","jpsuv_estructuras.estj_telefono","jpsuv_cargos.carj_cargo", "agrupaciones.agr_nombre")         
            ->where("jpsuv_estructuras.estj_nivel","ubch") 
            ->where("jpsuv_estructuras.estj_municipio_usu",$usu) 
            ->orderBy("jpsuv_cargos.carj_cargo")
            ->get();
       
        $jpsuv_cargos = jpsuv_cargos::select("jpsuv_cargos.id","jpsuv_cargos.carj_cargo","jpsuv_cargos.carj_nivel","jpsuv_cargos.carj_cantidad")         
        ->where("jpsuv_cargos.carj_nivel","ubch") 
        ->where("jpsuv_cargos.carj_estado","A")
        ->orderBy("jpsuv_cargos.carj_cargo")
        ->get(); 

        return view('jpsuvEstructura.jpsuvEstructuraUBCH',  compact('jpsuv_cargos'), compact('municipios'))->with('jpsuv_estructuras',$jpsuv_estructuras);
    }

    public function index4()
    {
        $municipios = municipios::select("municipios.id","municipios.mun_nombre" ) 
        ->orderBy("mun_nombre")
        ->get();

        $usu = auth()->user()->usu_mun_id;

            $jpsuv_estructuras = jpsuv_estructuras::join("jpsuv_cargos", "jpsuv_cargos.id", "=", "jpsuv_estructuras.estj_car_id")
            ->join("comunidades", "comunidades.id", "=", "jpsuv_estructuras.estj_nivel_id")
            ->select("jpsuv_estructuras.id","jpsuv_estructuras.estj_nac","jpsuv_estructuras.estj_cedula","jpsuv_estructuras.estj_nombres","jpsuv_estructuras.estj_telefono","jpsuv_cargos.carj_cargo", "comunidades.com_nombre")         
            ->where("jpsuv_estructuras.estj_nivel","comunidades") 
            ->where("jpsuv_estructuras.estj_municipio_usu",$usu) 
            ->orderBy("jpsuv_cargos.carj_cargo")
            ->get();
       
        $jpsuv_cargos = jpsuv_cargos::select("jpsuv_cargos.id","jpsuv_cargos.carj_cargo","jpsuv_cargos.carj_nivel","jpsuv_cargos.carj_cantidad")         
        ->where("jpsuv_cargos.carj_nivel","comunidad") 
        ->where("jpsuv_cargos.carj_estado","A")
        ->orderBy("jpsuv_cargos.carj_cargo")
        ->get(); 

        return view('jpsuvEstructura.jpsuvEstructuraComunidades',  compact('jpsuv_cargos'), compact('municipios'))->with('jpsuv_estructuras',$jpsuv_estructuras);
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
        $existenciaCargo = DB::table('jpsuv_estructuras')
            ->select('id')
            ->where('estj_car_id', '=', $request->estj_car_id)
            ->where('estj_nivel_id', '=', $request->estj_nivel_id)
            ->get();        
            
        $existenciaCedula = DB::table('jpsuv_estructuras')
            ->select('id')
            ->where('estj_nac', '=', $request->estj_nac)
            ->where('estj_cedula', '=', $request->estj_cedula)
            ->get();  

        if (count($existenciaCargo) >= 1) 
        {
            $mensaje = "Ya el cargo se encuentra asignado";
        }

        if (count($existenciaCedula) >= 1) 
        {
            $mensaje = "La cedula ya tiene un cargo asignado";
        }

        $input = $request->all();
        $input['estj_tipo_reg'] = $request->estj_tipo_reg;
        if($mensaje=="Guardar") 
        {
            jpsuv_estructuras::create($input);
            if($request->estj_nivel=="municipios") 
            {
                return redirect('/jpsuvEstructuraMunicipios');   
            }
            if($request->estj_nivel=="ubch") 
            {
                return redirect('/jpsuvEstructuraUBCH');   
            }
            if($request->estj_nivel=="comunidades") 
            {
                return redirect('/jpsuvEstructuraComunidades');   
            }
            
        }
        else
        {
            if($request->estj_nivel=="municipios") 
            {
                return redirect('/jpsuvEstructuraMunicipios')
                ->with("mensaje", $mensaje);  
            }
            if($request->estj_nivel=="ubch") 
            {
                return redirect('/jpsuvEstructuraUBCH')
                ->with("mensaje", $mensaje);  
            }   
            if($request->estj_nivel=="comunidades") 
            {
                return redirect('/jpsuvEstructuraComunidades')
                ->with("mensaje", $mensaje);  
            } 
        }
    }

    public function destroy($id,$pag)
    {
        $var = jpsuv_estructuras::find($id);
        $var->delete();        
        if($pag=='municipios')
        {
            return redirect('/jpsuvEstructuraMunicipios')->with('eliminar','ok');
        } 
        if($pag=='ubch')
        {
            return redirect('/jpsuvEstructuraUBCH')->with('eliminar','ok');
        }    
        if($pag=='comunidades')
        {
            return redirect('/jpsuvEstructuraComunidades')->with('eliminar','ok');
        }     
    }
   
}

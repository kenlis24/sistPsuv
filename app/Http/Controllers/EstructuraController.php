<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\municipios;
use App\Models\parroquias;
use App\Models\agrupaciones;
use App\Models\estructuras;
use App\Models\cargos;
use App\Models\militancias;
use Illuminate\Support\Facades\DB;

class EstructuraController extends Controller
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
       /* $buscar = auth()->user()->usu_mun_id;

        if($buscar=='1')
        { 
            $estructuras = estructuras::join("cargos", "cargos.id", "=", "estructuras.est_car_id")
            ->select("estructuras.id","estructuras.est_nac","estructuras.est_cedula","estructuras.est_nombres","estructuras.est_telefono","cargos.car_cargo")         
            ->where("estructuras.est_nivel","municipios") 
            ->orderBy("cargos.car_cargo")
            ->get();
        }
        else
        {
            $estructuras = estructuras::join("cargos", "cargos.id", "=", "estructuras.est_car_id")
            ->select("estructuras.id","estructuras.est_nac","estructuras.est_cedula","estructuras.est_nombres","estructuras.est_telefono","cargos.car_cargo")         
            ->where("estructuras.est_nivel","municipios") 
            ->where("estructuras.est_nivel_id",$buscar)
            ->orderBy("cargos.car_cargo")
            ->get();
        }*/
        $estructuras = estructuras::join("cargos", "cargos.id", "=", "estructuras.est_car_id")
        ->join("municipios", "municipios.id", "=", "estructuras.est_nivel_id")
        ->select("estructuras.id","estructuras.est_nac","estructuras.est_cedula","estructuras.est_nombres","estructuras.est_telefono","cargos.car_cargo", "municipios.mun_nombre")         
        ->where("estructuras.est_nivel","municipios") 
        ->where("estructuras.est_municipio_usu",$usu) 
        ->orderBy("cargos.car_cargo")
        ->get();
        $cargos = cargos::select("cargos.id","cargos.car_cargo","cargos.car_nivel","cargos.car_cantidad")         
        ->where("cargos.car_nivel","municipio") 
        ->where("cargos.car_estado","A")
        ->orderBy("cargos.car_cargo")
        ->get(); 

        return view('estructura.estructuraMunicipios',  compact('cargos'), compact('municipios'))->with('estructuras',$estructuras);
    }

    public function index2()
    {
        $municipios = municipios::select("municipios.id","municipios.mun_nombre" ) 
        ->orderBy("mun_nombre")
        ->get();

        $usu = auth()->user()->usu_mun_id;

            $estructuras = estructuras::join("cargos", "cargos.id", "=", "estructuras.est_car_id")
            ->join("parroquias", "parroquias.id", "=", "estructuras.est_nivel_id")
            ->select("estructuras.id","estructuras.est_nac","estructuras.est_cedula","estructuras.est_nombres","estructuras.est_telefono","cargos.car_cargo", "parroquias.par_nombre")         
            ->where("estructuras.est_nivel","parroquias") 
            ->where("estructuras.est_municipio_usu",$usu) 
            ->orderBy("cargos.car_cargo")
            ->get();
       
        $cargos = cargos::select("cargos.id","cargos.car_cargo","cargos.car_nivel","cargos.car_cantidad")         
        ->where("cargos.car_nivel","parroquia") 
        ->where("cargos.car_estado","A")
        ->orderBy("cargos.car_cargo")
        ->get(); 

        return view('estructura.estructuraParroquias',  compact('cargos'), compact('municipios'))->with('estructuras',$estructuras);
    }

    public function index3()
    {
        $municipios = municipios::select("municipios.id","municipios.mun_nombre" ) 
        ->orderBy("mun_nombre")
        ->get();
        $usu = auth()->user()->usu_mun_id;


            $estructuras = estructuras::join("cargos", "cargos.id", "=", "estructuras.est_car_id")
            ->join("agrupaciones", "agrupaciones.id", "=", "estructuras.est_nivel_id")
            ->select("estructuras.id","estructuras.est_nac","estructuras.est_cedula","estructuras.est_nombres","estructuras.est_telefono","cargos.car_cargo", "agrupaciones.agr_nombre")         
            ->where("estructuras.est_nivel","ubch") 
            ->where("estructuras.est_municipio_usu",$usu) 
            ->orderBy("cargos.car_cargo")
            ->get();
       
        $cargos = cargos::select("cargos.id","cargos.car_cargo","cargos.car_nivel","cargos.car_cantidad")         
        ->where("cargos.car_nivel","ubch") 
        ->where("cargos.car_estado","A")
        ->orderBy("cargos.car_cargo")
        ->get(); 

        return view('estructura.estructuraUBCH',  compact('cargos'), compact('municipios'))->with('estructuras',$estructuras);
    }
    public function index4()
    {
        $municipios = municipios::select("municipios.id","municipios.mun_nombre" ) 
        ->orderBy("mun_nombre")
        ->get();

        $usu = auth()->user()->usu_mun_id;

            $estructuras = estructuras::join("cargos", "cargos.id", "=", "estructuras.est_car_id")
            ->join("comunidades", "comunidades.id", "=", "estructuras.est_nivel_id")
            ->select("estructuras.id","estructuras.est_nac","estructuras.est_cedula","estructuras.est_nombres","estructuras.est_telefono","cargos.car_cargo", "comunidades.com_nombre")         
            ->where("estructuras.est_nivel","comunidades") 
            ->where("estructuras.est_municipio_usu",$usu) 
            ->orderBy("cargos.car_cargo")
            ->get();
       
        $cargos = cargos::select("cargos.id","cargos.car_cargo","cargos.car_nivel","cargos.car_cantidad")         
        ->where("cargos.car_nivel","comunidad") 
        ->where("cargos.car_estado","A")
        ->orderBy("cargos.car_cargo")
        ->get(); 

        return view('estructura.estructuraComunidades',  compact('cargos'), compact('municipios'))->with('estructuras',$estructuras);
    }

    public function index5()
    {
        $municipios = municipios::select("municipios.id","municipios.mun_nombre" ) 
        ->orderBy("mun_nombre")
        ->get();

        $usu = auth()->user()->usu_mun_id;
        
            $estructuras = estructuras::join("cargos", "cargos.id", "=", "estructuras.est_car_id")
            ->join("calles", "calles.id", "=", "estructuras.est_nivel_id")
            ->select("estructuras.id","estructuras.est_nac","estructuras.est_cedula","estructuras.est_nombres","estructuras.est_telefono","cargos.car_cargo", "calles.cal_nombre")         
            ->where("estructuras.est_nivel","calles") 
            ->where("estructuras.est_municipio_usu",$usu) 
            ->orderBy("cargos.car_cargo")
            ->get();
       
        $cargos = cargos::select("cargos.id","cargos.car_cargo","cargos.car_nivel","cargos.car_cantidad")         
        ->where("cargos.car_nivel","calle") 
        ->where("cargos.car_estado","A")
        ->orderBy("cargos.car_cargo")
        ->get(); 

        return view('estructura.estructuraCalles',  compact('cargos'), compact('municipios'))->with('estructuras',$estructuras);
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
        $existenciaCargo = DB::table('estructuras')
            ->select('id')
            ->where('est_car_id', '=', $request->est_car_id)
            ->where('est_nivel_id', '=', $request->est_nivel_id)
            ->get();        
            
        $existenciaCedula = DB::table('estructuras')
            ->select('id')
            ->where('est_nac', '=', $request->est_nac)
            ->where('est_cedula', '=', $request->est_cedula)
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
        $input['est_tipo_reg'] = $request->est_tipo_reg;
        if($mensaje=="Guardar") 
        {
            Estructuras::create($input);
            if($request->est_nivel=="municipios") 
            {
                return redirect('/estructuraMunicipio');   
            }
            if($request->est_nivel=="parroquias") 
            {
                return redirect('/estructuraParroquia');   
            }
            if($request->est_nivel=="ubch") 
            {
                return redirect('/estructuraUBCH');   
            }
            if($request->est_nivel=="comunidades") 
            {
                return redirect('/estructuraComunidades');   
            }
            if($request->est_nivel=="calles") 
            {
                return redirect('/estructuraCalles');   
            }
        }
        else
        {
            if($request->est_nivel=="municipios") 
            {
                return redirect('/estructuraMunicipio')
                ->with("mensaje", $mensaje);  
            }
            if($request->est_nivel=="parroquias") 
            {
                return redirect('/estructuraParroquia')
                ->with("mensaje", $mensaje);  
            }         
            if($request->est_nivel=="ubch") 
            {
                return redirect('/estructuraUBCH')
                ->with("mensaje", $mensaje);  
            }     
            if($request->est_nivel=="comunidades") 
            {
                return redirect('/estructuraComunidades')
                ->with("mensaje", $mensaje);  
            }   
            if($request->est_nivel=="calles") 
            {
                return redirect('/estructuraCalles')
                ->with("mensaje", $mensaje);  
            }    
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function reporte()
    {
        
        $municipios = municipios::select("municipios.id","municipios.mun_nombre" ) 
        ->orderBy("mun_nombre")
        ->get();

        $centro = DB::select("select distinct estD.est_centro centro, estD.est_nac as nac, estD.est_cedula as cedula, estD.est_nombres as nombres, 
        estD.est_telefono telefono,  (SELECT distinct comu.com_nombre 
                                            FROM comunidades comu
                                            WHERE estD.est_nivel_id = comu.id
                                            and estD.est_nivel = 'comunidades'                                                       
                                                     LIMIT 1) Comunidad ,
        (SELECT distinct calle.cal_nombre 
                                            FROM calles calle
                                            WHERE estD.est_nivel_id = calle.id
                                            and estD.est_nivel = 'calles'                                                       
                                                     LIMIT 1) Calle ,
        (SELECT CONCAT(estU.est_nac,' ',estU.est_cedula,' ',estU.est_nombres,' ',estU.est_telefono) 
                                            FROM estructuras estU
                                            WHERE estU.est_car_id='99'
                                            and estU.est_nivel_id = estD.est_nivel_id
                                                     and estU.est_usuario_creo = estD.est_usuario_creo
                                                     LIMIT 1) JefeComunidad ,
        (SELECT CONCAT(estU.est_nac,' ',estU.est_cedula,' ',estU.est_nombres,' ',estU.est_telefono) 
                                            FROM estructuras estU
                                            WHERE estU.est_car_id='103'
                                            and estU.est_nivel_id = estD.est_nivel_id
                                                     and estU.est_usuario_creo = estD.est_usuario_creo
                                                     LIMIT 1) JefeCalle
        from estructuras estD
        where estD.est_municipio = 'MP. FCO DE MIRANDA'
        union
        select distinct mili.mil_centro centro, mili.mil_nac as nac, mili.mil_cedula as cedula, mili.mil_nombres as nombres,
        mili.mil_telefono telefono,  (SELECT distinct comu.com_nombre 
                                            FROM comunidades comu
                                            WHERE mili.mil_id = comu.id
                                            and mili.mil_tipo_nivel = 'comunidades'                                                       
                                                     LIMIT 1) Comunidad ,
        (SELECT distinct calle.cal_nombre 
                                            FROM calles calle
                                            WHERE mili.mil_id = calle.id
                                            and mili.mil_tipo_nivel = 'calles'                                                           
                                                     LIMIT 1) Calle ,
        (SELECT distinct CONCAT(estU.est_nac,' ',estU.est_cedula,' ',estU.est_nombres,' ',estU.est_telefono) 
                                            FROM estructuras estU
                                            WHERE estU.est_car_id='99'
                                            and estU.est_nivel_id = mil_id 
                                            and estU.est_usuario_creo = mili.mil_usua_crea
                                            LIMIT 1) JefeComunidad,
        (SELECT distinct CONCAT(estU.est_nac,' ',estU.est_cedula,' ',estU.est_nombres,' ',estU.est_telefono) 
                                            FROM estructuras estU
                                            WHERE estU.est_car_id='103'
                                            and estU.est_nivel_id = mil_id 
                                            and estU.est_usuario_creo = mili.mil_usua_crea
                                            LIMIT 1) JefeCalle
        from militancias mili
        where mili.mil_municipio = 'MP. FCO DE MIRANDA'
        order by 1, 3");

        return view('reportes.listadoCarga',  compact('municipios'),  compact('centro'));
    }

    public function reporteCalle()
    {
        
        $municipios = municipios::select("municipios.id","municipios.mun_nombre" ) 
        ->orderBy("mun_nombre")
        ->get();

        $centro = DB::select("select distinct mili.mil_nac as nac, mili.mil_cedula as cedula, mili.mil_nombres as nombres,
            mili.mil_telefono telefono, mili.mil_centro centro, 
			(SELECT distinct CONCAT(estU.est_nac,' ',estU.est_cedula,' ',estU.est_nombres,' ',estU.est_telefono) 
												FROM estructuras estU
												WHERE estU.est_car_id='103'
                                                and estU.est_nivel_id = mil_id 
												and estU.est_usuario_creo = mili.mil_usua_crea
                                                LIMIT 1) JefeCalle
            from militancias mili
            where mili.mil_municipio = 'MP. FCO DE MIRANDA'
            and mili.mil_tipo_nivel = 'calles'
            order by 5, 2");

        return view('reportes.listadoCargaCalle',  compact('municipios'),  compact('centro'));
    }
}

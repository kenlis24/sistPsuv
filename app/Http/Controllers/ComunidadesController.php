<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\municipios;
use App\Models\parroquias;
use App\Models\comunidades;
use App\Models\calles;
use App\Models\agrupaciones;
use App\Models\estructuras;
use App\Models\militancia;
use App\Models\poblacion_familias;
use App\Models\jpsuv_estructuras;
use App\Models\jefe_familias;

use Illuminate\Support\Facades\DB;

class ComunidadesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {       
        $usu = auth()->user()->usu_mun_id;

        $lista = comunidades::join("agrupaciones", "agrupaciones.id", "=", "comunidades.com_agr_id")
        ->join("parroquias", "parroquias.id", "=", "agrupaciones.agr_par_id")
        ->join("municipios", "municipios.id", "=", "parroquias.par_mun_id")
        ->select("comunidades.id","comunidades.com_nombre","agrupaciones.agr_nombre","parroquias.par_nombre")     
        ->where("municipios.id",$usu) 
        ->orderBy("parroquias.par_nombre","asc")
        ->orderBy("agrupaciones.agr_nombre","asc")
        ->orderBy("comunidades.com_nombre","asc")
        ->get(); 


        return view('comunidades.confiComunidades',compact('lista'));
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

        return view('comunidades.create', compact('municipios'));
    }

    public function store(Request $request)
    {       
        $mensaje = "Guardar";
        $existenciaCodigo = DB::table('comunidades')
            ->select('id')
            ->where('com_codigo', '=', $request->com_codigo)
            ->get();                  

        if (count($existenciaCodigo) >= 1) 
            {
                $mensaje = "Este código de comunidad ya existe";
            }   
    
        $input = $request->all();
        $input['com_agr_id'] = $request->com_agr_id;
        if($mensaje=="Guardar") 
        {
            comunidades::create($input);
            return redirect('confComunidades');
        }
        else
        {
            return redirect('createcomunidad')
            ->with("mensaje", $mensaje);  
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comunidades = Comunidades::find($id);
        return view('comunidades.edit')->with('comunidades', $comunidades);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $comunidades = Comunidades::find($id);
        $input = $request->all();
        $comunidades->update($input);
        return redirect('/confComunidades');  
    }

    public function destroy($id)
    {
        $mensaje = "Guardar";
        $existenciaCalles = DB::table('calles')
            ->select('id')
            ->where('cal_com_id', '=', $id)
            ->where('cal_estado', '=', "A")
            ->get(); 

        if (count($existenciaCalles) >= 1) 
        {
            $mensaje = "NO SE PUEDE ELIMINAR COMUNIDAD YA QUE TIENE CALLES ACTIVAS";
            return redirect('/confComunidades')->with("mensaje", $mensaje); 

        }

        if($mensaje=="Guardar") 
        {
            DB::table('estructuras')
            ->where('est_nivel_id', '=', $id)
            ->where('est_nivel', '=', 'comunidades')
            ->delete(); 

            DB::table('militancias')        
            ->where('mil_id', '=', $id)
            ->where('mil_tipo_nivel', '=', 'comunidades')
            ->delete();                               

            DB::table('jpsuv_estructuras')
            ->where('estj_nivel_id', '=', $id)
            ->where('estj_nivel', '=', 'comunidades')
            ->delete();
        
            $var = Comunidades::find($id);
            $var->delete();   
            return redirect('/confComunidades'); 
        }
    }
}

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

class CallesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {       
        $usu = auth()->user()->usu_mun_id;

        $lista = calles::join("comunidades", "comunidades.id", "=", "calles.cal_com_id")
        ->join("agrupaciones", "agrupaciones.id", "=", "comunidades.com_agr_id")
        ->join("parroquias", "parroquias.id", "=", "agrupaciones.agr_par_id")
        ->join("municipios", "municipios.id", "=", "parroquias.par_mun_id")
        ->select("calles.id","calles.cal_nombre","comunidades.com_nombre","agrupaciones.agr_nombre","parroquias.par_nombre")     
        ->where("municipios.id",$usu) 
        ->orderBy("parroquias.par_nombre","asc")
        ->orderBy("agrupaciones.agr_nombre","asc")
        ->orderBy("comunidades.com_nombre","asc")
        ->orderBy("calles.cal_nombre","asc")
        ->get(); 


        return view('calles.confiCalles',compact('lista'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $calles = Calles::find($id);
        return view('calles.edit')->with('calles', $calles);
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
        $calles = Calles::find($id);
        $input = $request->all();
        $calles->update($input);
        return redirect('/confCalles');  
    }

    public function destroy($id)
    {
        DB::table('estructuras')
        ->where('est_nivel_id', '=', $id)
        ->where('est_nivel', '=', 'calles')
        ->delete(); 

        DB::table('militancias')        
        ->where('mil_id', '=', $id)
        ->where('mil_tipo_nivel', '=', 'calles')
        ->delete();  
                
        DB::table('jefe_familias')
        ->where('jfal_calle_id', '=', $id)
        ->delete(); 

        DB::table('poblacion_familias')
        ->where('pofa_calle_id', '=', $id)
        ->delete();

        DB::table('jpsuv_estructuras')
        ->where('estj_nivel_id', '=', $id)
        ->where('estj_nivel', '=', 'calles')
        ->delete();
      
        $var = Calles::find($id);
        $var->delete();   
        return redirect('/confCalles'); 
    }
}

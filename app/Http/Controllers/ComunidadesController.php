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
}

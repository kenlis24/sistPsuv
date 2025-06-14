<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\reuniones;
use App\Models\municipios;
use App\Models\militancias;
use Illuminate\Support\Facades\DB;

class MilitanciaController extends Controller
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

        $reuniones = Reuniones::join("eventos", "eventos.id", "=", "reuniones.reu_eve_id")
        ->select("reuniones.id","reuniones.reu_tipo","reuniones.reu_estado","eventos.eve_nombre","eventos.id" ) 
        ->where("reuniones.reu_tipo","3")   
        ->where("eventos.eve_estado","A")
        ->where("reuniones.reu_estado","A")
        ->get();     
        return view('militancia.militantesUBCH', compact('municipios'), compact('reuniones'));
    }

    public function index2()
    {
        $municipios = municipios::select("municipios.id","municipios.mun_nombre" ) 
        ->orderBy("mun_nombre")
        ->get();

        $reuniones = Reuniones::join("eventos", "eventos.id", "=", "reuniones.reu_eve_id")
        ->select("reuniones.id","reuniones.reu_tipo","reuniones.reu_estado","eventos.eve_nombre","eventos.id" ) 
        ->where("reuniones.reu_tipo","4")   
        ->where("eventos.eve_estado","A")
        ->where("reuniones.reu_estado","A")
        ->get();     
        return view('militancia.militantesComunidades', compact('municipios'), compact('reuniones'));
    }

    public function index3()
    {
        $municipios = municipios::select("municipios.id","municipios.mun_nombre" ) 
        ->orderBy("mun_nombre")
        ->get();

        $militancias = Militancias::join("eventos", "eventos.id", "=", "militancias.mil_eve_id")
                ->join("municipios", "municipios.id", "=", "militancias.mil_id")
                ->select("militancias.id","militancias.mil_nac","militancias.mil_cedula","militancias.mil_nombres","militancias.mil_apellidos","militancias.mil_telefono","municipios.mun_nombre","eventos.eve_nombre")
                ->where('militancias.mil_tipo_nivel', '=', 'municipios')
                ->orderBy('eventos.eve_nombre', 'desc')
                ->get();  

                $reuniones = Reuniones::join("eventos", "eventos.id", "=", "reuniones.reu_eve_id")
                ->select("reuniones.id","reuniones.reu_tipo","reuniones.reu_estado","eventos.eve_nombre","eventos.id" ) 
                ->where("reuniones.reu_tipo","1")   
                ->where("eventos.eve_estado","A")
                ->where("reuniones.reu_estado","A")
                ->get(); 

        return view('militancia.militantesMunicipios', compact('municipios'), compact('reuniones'));
    }

    public function index4()
    {
        $municipios = municipios::select("municipios.id","municipios.mun_nombre" ) 
        ->orderBy("mun_nombre")
        ->get();

        $reuniones = Reuniones::join("eventos", "eventos.id", "=", "reuniones.reu_eve_id")
        ->select("reuniones.id","reuniones.reu_tipo","reuniones.reu_estado","eventos.eve_nombre","eventos.id" ) 
        ->where("reuniones.reu_tipo","2")   
        ->where("eventos.eve_estado","A")
        ->where("reuniones.reu_estado","A")
        ->get();     
        return view('militancia.militantesParroquias', compact('municipios'), compact('reuniones'));
    }

    public function index5()
    {
        $municipios = municipios::select("municipios.id","municipios.mun_nombre" ) 
        ->orderBy("mun_nombre")
        ->get();
         
        $reuniones = Reuniones::join("eventos", "eventos.id", "=", "reuniones.reu_eve_id")
        ->select("reuniones.id","reuniones.reu_tipo","reuniones.reu_estado","eventos.eve_nombre","eventos.id" ) 
        ->where("reuniones.reu_tipo","5")   
        ->where("eventos.eve_estado","A")
        ->where("reuniones.reu_estado","A")
        ->get();     
        return view('militancia.militantesCalles', compact('municipios'), compact('reuniones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('reportes.consultaMilitantes');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {       

        $fecha = $request->mil_fecha;
        $tipo = $request->get("mil_id");
        $eve = $request->mil_eve_id;
        $tipoPag = $request->mil_tipo_nivel;
        $Lugar = $request->mil_lugar;
        
        foreach ($request->inputsCed as $key => $value)
        {
            $input['mil_nac'] = $request->inputsNac[$key];
            $input['mil_cedula'] = $request->inputsCed[$key];
            $input['mil_nombres'] = $request->inputsNombre[$key];
            $input['mil_apellidos'] = '';
            $input['mil_telefono'] = $request->inputsTelefono[$key];
            $input['mil_estado'] = $request->mil_estado_usua[$key];
            $input['mil_municipio'] = $request->mil_mun_usua[$key];
            $input['mil_parroquia'] = $request->mil_parr_usua[$key];
            $input['mil_centro'] = $request->mil_centro_usua[$key];
            if($request->mil_tipo_reg[$key]=='' && $tipoPag!='ubch')
            {
                $input['mil_tipo_reg'] = 'Registro Manual';
            }
            else
            {
                $input['mil_tipo_reg'] = $request->mil_tipo_reg[$key];
            }            
            $input['mil_fecha'] = $fecha;
            $input['mil_id'] = $tipo;
            $input['mil_tipo_nivel'] = $tipoPag;
            $input['mil_lugar'] = $Lugar;
            $input['mil_usua_crea'] = $request->mil_usua_crea[$key];
            $input['mil_eve_id'] = $eve;
            $existencia = DB::table('militancias')
            ->select('id')
            ->where('mil_nac', '=', $input['mil_nac'])
            ->where('mil_cedula', '=', $input['mil_cedula'])
            ->where('mil_fecha', '=', $input['mil_fecha'])
            ->where('mil_id', '=', $input['mil_id'])
            ->where('mil_eve_id', '=', $input['mil_eve_id'])
            ->where('mil_tipo_nivel', '=', $input['mil_tipo_nivel'])
            ->get();            
            if(count($existencia) >= 1) 
            {
                $exist = 'si';
            }
            else
            {
                if($tipoPag=='ubch')
                {
                    if($request->mil_tipo_reg[$key]=='INSCRITO CNE')
                    {
                        Militancias::create($input);
                    }
                }
                else
                {
                    Militancias::create($input);
                }   
            }
            
        }
        if($tipoPag=='ubch')
        {
            return redirect('/militantUBC');
        }   
        if($tipoPag=='comunidades')
        {
            return redirect('/militantComun');
        }  
        if($tipoPag=='municipios')
        {
            return redirect('/militantMunip');
        } 
        if($tipoPag=='parroquias')
        {
            return redirect('/militantParr');
        } 
        if($tipoPag=='calles')
        {
            return redirect('/militantCalle');
        } 
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        //
    }

    public function pdfMunicipios()
    { 
        $usu = auth()->user()->usu_mun_id;        

        $reuniones = Reuniones::join("eventos", "eventos.id", "=", "reuniones.reu_eve_id")
        ->select("reuniones.id","reuniones.reu_tipo","reuniones.reu_estado","eventos.eve_nombre","eventos.id" ) 
        ->where("reuniones.reu_tipo","1")           
        ->where("eventos.eve_estado","A")
        ->where("reuniones.reu_estado","A")
        ->get();  

        $municipios = municipios::select("municipios.id","municipios.mun_nombre" ) 
        ->where("municipios.id",$usu)
        ->orderBy("mun_nombre")
        ->get();

        $pdf = Pdf::loadView('estructura.estructuraUBCHPdf',compact('reuniones'),compact('municipios'));
        return $pdf->stream();
    }
}

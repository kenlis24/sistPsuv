<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\users_sectores;
use App\Models\user;
use App\Models\sectores;
use Illuminate\Support\Facades\DB;

class Users_sectoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {       
        $users_sectores = users_sectores::join("sectores", "sectores.id", "=", "users_sectores.usec_sec_id")
        ->join("users", "users.id", "=", "users_sectores.usec_use_id")
        ->select("users.id","users.name", "sectores.sec_nombre", "sectores.sec_estado", "users_sectores.usec_estado")
        ->where("users_sectores.usec_estado","A")
        ->where("sectores.sec_estado","A")
        ->orderBy("users.name")
        ->get();
        return view('sectores.index')->with('users_sectores',$users_sectores);
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sectores = sectores::select("sectores.id","sectores.sec_nombre","sectores.sec_estado")  
        ->where("sectores.sec_estado","A")
        ->orderBy("sectores.sec_nombre")
        ->get(); 

        $users = user::select("users.id","users.name",) 
        ->orderBy("users.name")
        ->get(); 

        return view('sectores.create', compact('sectores'), compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $mensaje = "Guardar";
        $existenciaUser = DB::table('users_sectores')
            ->select('id')
            ->where('usec_use_id', '=', $input['usec_use_id'])
            ->where('usec_estado', '=', "A")
            ->get(); 

        $existenciaSector = DB::table('users_sectores')
            ->select('id')
            ->where('usec_sec_id', '=', $input['usec_sec_id'])
            ->where('usec_estado', '=', "A")
            ->get(); 

        if (count($existenciaUser) >= 1) 
        {
            $mensaje = "Ya el usuario tiene un sector";
        }

        if (count($existenciaSector) >= 1) 
        {
            $mensaje = "Ya el sector esta cargado para otro usuario";
        }

        if($mensaje=="Guardar") 
        {
            users_sectores::create($input);
            return redirect('/asociarsector');
        }
        else
        {
            return redirect('/asociarsector')
                ->with("mensaje", $mensaje);  
        }
    }
}

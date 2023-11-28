<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users_sectores;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index() 
    {
        $userlogueado = auth()->user()->id;
        $sector = DB::table('Users_sectores')
        ->select("Users_sectores.usec_use_id") 
        ->where("Users_sectores.usec_use_id",$userlogueado) 
        ->get();

        if (count($sector) >= 1) 
        {
            $mensaje = "Si";
        }
        else{
            $mensaje = "No";
        }

        return view('home.index',[ 'mensaje' => $mensaje ]);
    }

    public function militan() 
    {
        return view('home.militancia');
    }
}

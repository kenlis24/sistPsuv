<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\users_sectores;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index() 
    {
        return view('home.index');
    }

    public function militan() 
    {
        return view('home.militancia');
    }
}

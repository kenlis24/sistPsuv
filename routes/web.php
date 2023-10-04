<?php

use App\Models\agrupaciones;
use App\Models\municipios;
use App\Models\parroquias;
use App\Models\militancias;
use App\Models\comunidades;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace' => 'App\Http\Controllers'], function()
{   
    /**
     * Home Routes
     */
    Route::get('/', function () {
        return view('welcome');
    });
    /*Route::get('/login', function () {
        return view('auth.login');
    });*/

    Route::group(['middleware' => ['guest']], function() {
        /**
         * Register Routes
         */
        //Route::get('/register', 'RegisterController@show')->name('register.show');
        //Route::post('/register', 'RegisterController@register')->name('register.perform');

        /**
         * Login Routes
         */
        Route::get('/login', 'LoginController@show')->name('login.show');
        Route::post('/login', 'LoginController@login')->name('login.perform');
        /*Route::get('/create', 'UserController@create')->name('users.create');
        Route::post('/store', 'UserController@store')->name('users.store');*/

    });

    Route::group(['middleware' => ['auth']], function() {
        /**
         * Logout Routes
         */
        Route::get('/', 'HomeController@index')->name('home.index');        
        Route::get('/user', 'UserController@index')->name('users.index');
        Route::get('/create', 'UserController@create')->name('users.create');
        Route::post('/store', 'UserController@store')->name('users.store');
        Route::get('/edituser/{id}', 'UserController@edit')->name('users.edit');
        Route::put('/updateuser/{id}', 'UserController@update')->name('users.update');
        Route::get('/reuniones', 'ReunionesController@index')->name('reuniones.index');
        Route::get('/createreu', 'ReunionesController@create')->name('reuniones.create');
        Route::post('/storereu', 'ReunionesController@store')->name('reuniones.store');
        Route::get('/militantUBC', 'MilitanciaController@index')->name('militancia.militantesUBH');
        Route::post('/storemilitantUBC', 'MilitanciaController@store')->name('militancia.store');
        Route::get('/militantComun', 'MilitanciaController@index2')->name('militancia.militantesComunidades');

        Route::get('/tableMilitancia/{ubch}/{fecha}/{evento}/{pag}/militanciaUBCH', function ($tipo,$fecha,$evento) {

            return $militancias = Militancias::join("eventos", "eventos.id", "=", "militancias.mil_eve_id")
            ->join("agrupaciones", "agrupaciones.id", "=", "militancias.mil_id")
            ->select("militancias.id","militancias.mil_nac","militancias.mil_cedula","militancias.mil_nombres","militancias.mil_apellidos","militancias.mil_telefono","agrupaciones.agr_nombre","eventos.eve_nombre")
            ->where('militancias.mil_fecha', '=', $fecha)
            ->where('militancias.mil_id', '=', $tipo)
            ->where('militancias.mil_eve_id', '=', $evento)
            ->where('militancias.mil_tipo_nivel', '=', $pag)
            ->get();  
        });
        Route::get('/municipios/{id}/parroquias', function ($id) {

            $id=$id-1;
            $municipios = municipios::find($id);
            return parroquias::where('par_mun_id',$municipios->id)
            ->get();
        });

        Route::get('/parroquias/{id}/agrupaciones', function ($id) {

            $id=$id;
            $parroquias = parroquias::find($id);
            return agrupaciones::where('agr_par_id',$parroquias->id)
            ->get();
        });

        Route::get('/ubch/{id}/comunidades', function ($id) {

            $id=$id;
            $ubch = agrupaciones::find($id);
            return comunidades::where('com_agr_id',$ubch->id)
            ->get();
        });

        Route::get('personaconsul/{datosNac}/{datosCed}/datosCNE', function ($datosNac, $datosCed) {

            $nac = $datosNac;
            $ci = $datosCed;
            $url = "http://www.cne.gov.ve/web/registro_electoral/ce.php?nacionalidad=$nac&cedula=$ci";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, FALSE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $xxx1 = curl_exec($ch);
            curl_close($ch);
            $page = strip_tags($xxx1);
            $info = explode(":", $page);
            //var_dump($info);
            $sw = sizeof($info);
            //echo 'aqui '.$sw;
            if ($sw != 8) {
                if($posicion_coincidencia = strpos($info[1], 'objeción'))
                    {
                        return response()->json(
                            [
                                'mensaje' => "Esta cédula de identidad presenta una objeción - OBJETADO",
                                'tipo' => "OBJETADO",
                            ],
                            200
                            );
                    } 
                    else{
                        return response()->json(
                        [
                        'mensaje' => "Esta cédula de identidad no se encuentra inscrito en el Registro Electoral",
                        'tipo' => "NO INSCRITO",
                        ],
                        422
                    );
                } 
            } else if($posicion_coincidencia = strpos($info[1], 'objeción'))
                    {
                        return response()->json(
                            [
                                'mensaje' => "Esta cédula de identidad presenta una objeción - OBJETADO",
                                'tipo' => "OBJETADO",
                            ],
                            200
                            );
                    }   
            else {
            $cn = explode('-', substr(trim($info[1]), 0, -6));
            $result = str_replace(array("Estado"), '', trim($info[2]));
            //$result = preg_replace('([^A-Za-z0-9 ])', ' ', trim($result));
            $result = str_replace(array("  "), ' ', $result);
            $municipioPer = str_replace(array("\n", "\t", "Parroquia"), '',trim($info[4]));
            $parroquiaPer = str_replace(array("\n", "\t","Centro"), '',trim($info[5]));
            $centroVotaPer = str_replace(array("\n", "\t","Dirección"), '',trim($info[6]));
            
            $persona = explode(" ", $result);
            $rows = count($persona);
            if ($rows <= 0) {
                return response()->json(
                [
                    'mensaje' => "Cedula no registrada",
                    'tipo' => "NO INSCRITO",
                ],
                422
                );
            }
            return response()->json(
                [
                'mensaje' => $persona,   
                'tipo' => "INSCRITO", 
                'municipio' => $municipioPer,
                'parroquia' => $parroquiaPer,
                'centro' => $centroVotaPer,         
                ],
                200
            );
            }
        });

        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
    });
});

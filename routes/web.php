<?php

use App\Models\agrupaciones;
use App\Models\municipios;
use App\Models\parroquias;
use App\Models\militancias;
use App\Models\comunidades;
use App\Models\calles;
use App\Models\estructuras;
use App\Models\sectores;
use App\Models\jefe_familias;
use App\Models\agrupaciones_elecs;
use App\Models\comunidades_elecs;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

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
        Route::get('/centros', 'CallesController@index2')->name('poblacion.centrosVotacion');
        Route::get('/municipios2/{id}/parroquias2', function ($id) {

            $municipios = municipios::find($id);
            return parroquias::where('par_mun_id',$municipios->id)
            ->orderBy("par_nombre")
            ->get();
        });
        Route::get('/parroquias2/{id}/agrupaciones2', function ($id) {

                      return $variable = agrupaciones_elecs::join("comunidades_elecs", "comunidades_elecs.com_agr_id", "=", "agrupaciones_elecs.id")
        ->select("comunidades_elecs.id","comunidades_elecs.com_nombre") 
        ->where("agrupaciones_elecs.agr_par_id",$id)  
        ->orderBy("comunidades_elecs.com_nombre","asc")   
        ->get(); 

        });

        Route::get('/comunidades2/{id}/agrupaciones2', function ($id) {

            return $variable = agrupaciones_elecs::join("comunidades_elecs", "comunidades_elecs.com_agr_id", "=", "agrupaciones_elecs.id")
            ->select("agrupaciones_elecs.id","agrupaciones_elecs.agr_nombre") 
            ->where("comunidades_elecs.id",$id)    
            ->orderBy("agrupaciones_elecs.agr_nombre","asc")   
            ->get(); 

            });
        /*Route::get('/create', 'UserController@create')->name('users.create');
        Route::post('/store', 'UserController@store')->name('users.store');*/

    });

    Route::group(['middleware' => ['auth']], function() {
        /**
         * Logout Routes
         */
        Route::get('/', 'HomeController@index')->name('home.index');      
        Route::get('/militancia', 'HomeController@militan')->name('home.militancia');    
        Route::get('/user', 'UserController@index')->name('users.index');
        Route::get('/confCalles', 'CallesController@index')->name('calles.confiCalles');
        Route::get('/Calles/{id}', 'CallesController@edit')->name('calles.edit');
        Route::put('/updatecalles/{id}', 'CallesController@update')->name('calles.update');
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
        Route::get('/militantMunip', 'MilitanciaController@index3')->name('militancia.militantesMunicipios');
        Route::get('/militantParr', 'MilitanciaController@index4')->name('militancia.militantesParroquias');
        Route::get('/militantCalle', 'MilitanciaController@index5')->name('militancia.militantesCalles');
        Route::get('/consultaMilit', 'MilitanciaController@create')->name('reportes.consultaMilitantes');
        Route::get('/estructuraMunicipio', 'EstructuraController@index')->name('estructura.estructuraMunicipios');
        Route::get('/estructuraMunicipioPDF', 'EstructuraController@pdfMunicipios')->name('estructura.estructuraMunicipioPdf'); 
        Route::post('/storeEstru', 'EstructuraController@store')->name('estructura.store');
        Route::get('/destroyEstru/{id}/{pag}', 'EstructuraController@destroy')->name('estructura.destroy');
        Route::get('/estructuraParroquia', 'EstructuraController@index2')->name('estructura.estructuraParroquias');
        Route::get('/estructuraParroquiaPDF', 'EstructuraController@pdfParroquias')->name('estructura.estructuraParroquiasPdf'); 
        Route::get('/estructuraUBCH', 'EstructuraController@index3')->name('estructura.estructuraUBCH');
        Route::get('/estructuraUBCHPDF', 'EstructuraController@pdfUBCH')->name('estructura.estructuraUBCHPdf');
        Route::get('/estructuraComunidades', 'EstructuraController@index4')->name('estructura.estructuraComunidades');
        Route::get('/estructuraComunidadPDF', 'EstructuraController@pdfComunidades')->name('estructura.estructuraComunidadesPdf'); 
        Route::get('/estructuraCalles', 'EstructuraController@index5')->name('estructura.estructuraCalles');
        Route::get('/estructuraCallePDF', 'EstructuraController@pdfCalles')->name('estructura.estructuraCallesPdf'); 
        Route::get('/asociarsector', 'Users_sectoresController@index')->name('sectores.index');
        Route::get('/createasociarsector', 'Users_sectoresController@create')->name('sectores.create');
        Route::post('/asociacionstore', 'Users_sectoresController@store')->name('sectores.store');
        Route::get('/sectorespersonas', 'Sectores_personasController@index')->name('sectores.cargaSectores');        
        Route::post('/cargasectorespersonas', 'Sectores_personasController@store')->name('sectores.storeCarga');
        Route::get('/sectoresPDF', 'Sectores_personasController@pdf')->name('sectores.sectoresPdf'); 
        Route::get('/reporte', 'EstructuraController@reporte')->name('reportes.listadoCarga');
        Route::get('/reporteCalle', 'EstructuraController@reporteCalle')->name('reportes.listadoCargaCalle');
        Route::get('/jpsuvEstructuraMunicipios', 'Jpsuv_estructuraController@index')->name('jpsuvEstructura.jpsuvEstructuraMunicipios');
        Route::post('/storeJpsuvEstru', 'Jpsuv_estructuraController@store')->name('jpsuvEstructura.store');
        Route::get('/destroyEstruJpsuv/{id}/{pag}', 'Jpsuv_estructuraController@destroy')->name('jpsuvEstructura.destroy');
        Route::get('/jpsuvEstructuraUBCH', 'Jpsuv_estructuraController@index3')->name('jpsuvEstructura.jpsuvEstructuraUBCH');
        Route::get('/jpsuvEstructuraComunidades', 'Jpsuv_estructuraController@index4')->name('jpsuvEstructura.jpsuvEstructuraComunidades');
        Route::get('/jpsuvEstructuraParroquia', 'Jpsuv_estructuraController@index2')->name('jpsuvEstructura.jpsuvEstructuraParroquias');
        Route::get('/jefefamilia', 'Jefe_familiasController@index')->name('poblacion.jefeFamilia');
        Route::get('/crearjefefamilia', 'Jefe_familiasController@create')->name('poblacion.createJefeFamilias');
        Route::post('/guardarjefefamilia', 'Jefe_familiasController@store')->name('poblacion.store');
        Route::get('/poblacionpersonas', 'Poblacion_familiasController@index')->name('poblacion.cargaPoblacion');
        Route::post('/guardarpoblacionfamilia', 'Poblacion_familiasController@store')->name('poblacion.storePoblacion');
        Route::get('/destroyCalle/{id}', 'CallesController@destroy')->name('calles.destroy');
        Route::get('/createcalle', 'CallesController@create')->name('calles.create');
        Route::post('/storeCalles', 'CallesController@store')->name('calles.store');
        Route::get('/confComunidades', 'ComunidadesController@index')->name('comunidades.confiComunidades');
        Route::get('/Comunidades/{id}', 'ComunidadesController@edit')->name('comunidades.edit');
        Route::put('/updatecomunidades/{id}', 'ComunidadesController@update')->name('comunidades.update');
        Route::get('/destroyComunidad/{id}', 'ComunidadesController@destroy')->name('comunidades.destroy');
        Route::get('/createcomunidad', 'ComunidadesController@create')->name('comunidades.create');
        Route::post('/storeCComunidades', 'ComunidadesController@store')->name('comunidades.store');
        

        Route::get('/reporteLista/{id}/datosCargados', function ($id) {

            return $centro = DB::select("select distinct estD.est_nac as nac, estD.est_cedula as cedula, estD.est_nombres as nombres, 
			estD.est_telefono telefono, estD.est_centro centro, 
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
            where estD.est_municipio = 'MP. SAN CRISTOBAL'
			union
			select distinct mili.mil_nac as nac, mili.mil_cedula as cedula, mili.mil_nombres as nombres,
            mili.mil_telefono telefono, mili.mil_centro centro, 
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
            where mili.mil_municipio = 'MP. SAN CRISTOBAL'
            order by 5, 2");
        });

        Route::get('/reporteMilitancia/{nac}/{ced}/datos', function ($nac, $ced) {

            return $datos = DB::select("SELECT mil.mil_nac nac, mil.mil_cedula cedula, mil.mil_nombres nombres,mil.mil_apellidos apellidos,
            eve.eve_nombre evento, mil.mil_fecha fecha, mil.mil_id, mil.mil_tipo_nivel nivel, 'Asistencia' tipo
            FROM militancias mil, eventos eve
            WHERE mil.mil_cedula = '$ced'
            and mil.mil_nac = '$nac'
            and mil.mil_eve_id = eve.id
            UNION
            SELECT est.est_nac nac, est.est_cedula cedula, est.est_nombres nombres, '' apellidos,
			car.car_cargo evento, '' fecha, est.est_nivel_id, est.est_nivel nivel, 'Estructura' tipo
			FROM estructuras est, cargos car
			WHERE est.est_nac = '$nac'
			and est.est_cedula = '$ced'
			and est.est_car_id = car.id");
        });


        Route::get('/tableMilitancia/{ubch}/{fecha}/{evento}/{pag}/militanciaUBCH', function ($tipo,$fecha,$evento,$pag) {

            if($pag=='ubch')
            {
                return $militancias = Militancias::join("eventos", "eventos.id", "=", "militancias.mil_eve_id")
                ->join("agrupaciones", "agrupaciones.id", "=", "militancias.mil_id")
                ->select("militancias.id","militancias.mil_nac","militancias.mil_cedula","militancias.mil_nombres","militancias.mil_apellidos","militancias.mil_telefono","agrupaciones.agr_nombre","eventos.eve_nombre")
                ->where('militancias.mil_fecha', '=', $fecha)
                ->where('militancias.mil_id', '=', $tipo)
                ->where('militancias.mil_eve_id', '=', $evento)
                ->where('militancias.mil_tipo_nivel', '=', $pag)
                ->get();  
            }
            if($pag=='comunidades')
            {
                return $militancias = Militancias::join("eventos", "eventos.id", "=", "militancias.mil_eve_id")
                ->join("comunidades", "comunidades.id", "=", "militancias.mil_id")
                ->select("militancias.id","militancias.mil_nac","militancias.mil_cedula","militancias.mil_nombres","militancias.mil_apellidos","militancias.mil_telefono","comunidades.com_nombre","eventos.eve_nombre")
                ->where('militancias.mil_fecha', '=', $fecha)
                ->where('militancias.mil_id', '=', $tipo)
                ->where('militancias.mil_eve_id', '=', $evento)
                ->where('militancias.mil_tipo_nivel', '=', $pag)
                ->get();  
            }
            if($pag=='municipios')
            {
                return $militancias = Militancias::join("eventos", "eventos.id", "=", "militancias.mil_eve_id")
                ->join("municipios", "municipios.id", "=", "militancias.mil_id")
                ->select("militancias.id","militancias.mil_nac","militancias.mil_cedula","militancias.mil_nombres","militancias.mil_apellidos","militancias.mil_telefono","municipios.mun_nombre","eventos.eve_nombre")
                ->where('militancias.mil_fecha', '=', $fecha)
                ->where('militancias.mil_id', '=', $tipo)
                ->where('militancias.mil_eve_id', '=', $evento)
                ->where('militancias.mil_tipo_nivel', '=', $pag)
                ->get();  
            }
            if($pag=='parroquias')
            {
                return $militancias = Militancias::join("eventos", "eventos.id", "=", "militancias.mil_eve_id")
                ->join("parroquias", "parroquias.id", "=", "militancias.mil_id")
                ->select("militancias.id","militancias.mil_nac","militancias.mil_cedula","militancias.mil_nombres","militancias.mil_apellidos","militancias.mil_telefono","parroquias.par_nombre","eventos.eve_nombre")
                ->where('militancias.mil_fecha', '=', $fecha)
                ->where('militancias.mil_id', '=', $tipo)
                ->where('militancias.mil_eve_id', '=', $evento)
                ->where('militancias.mil_tipo_nivel', '=', $pag)
                ->get();  
            }
            if($pag=='calles')
            {
                return $militancias = Militancias::join("eventos", "eventos.id", "=", "militancias.mil_eve_id")
                ->join("calles", "calles.id", "=", "militancias.mil_id")
                ->select("militancias.id","militancias.mil_nac","militancias.mil_cedula","militancias.mil_nombres","militancias.mil_apellidos","militancias.mil_telefono","calles.cal_nombre","eventos.eve_nombre")
                ->where('militancias.mil_fecha', '=', $fecha)
                ->where('militancias.mil_id', '=', $tipo)
                ->where('militancias.mil_eve_id', '=', $evento)
                ->where('militancias.mil_tipo_nivel', '=', $pag)
                ->get();  
            }
        });
        
        Route::get('/municipios/{id}/parroquias', function ($id) {

            $municipios = municipios::find($id);
            return parroquias::where('par_mun_id',$municipios->id)
            ->orderBy("par_nombre")
            ->get();
        });


        Route::get('/sectores', function () {

            $userlogueado = auth()->user()->id;
        
            return $sector = sectores::Join("users_sectores", "users_sectores.id", "=", "sectores.id")
            ->select("sectores.id","sectores.sec_nombre") 
            ->where("users_sectores.usec_use_id",$userlogueado) 
            ->orderBy("sec_nombre")
            ->get();

        });

        Route::get('/parroquias/{id}/agrupaciones', function ($id) {

            $id=$id;
            $parroquias = parroquias::find($id);
            return agrupaciones::where('agr_par_id',$parroquias->id)
            ->orderBy("agr_nombre")
            ->get();
        });

        Route::get('/ubch/{id}/comunidades', function ($id) {

            $id=$id;
            $ubch = agrupaciones::find($id);
            return comunidades::where('com_agr_id',$ubch->id)
            ->orderBy("com_nombre")
            ->get();
        });

        Route::get('/comun/{id}/calles', function ($id) {

            $id=$id;
            $comuni = comunidades::find($id);
            return calles::where('cal_com_id',$comuni->id)
            ->orderBy("cal_nombre")
            ->get();
        });

        Route::get('/calles/{id}/jefes', function ($id) {

            $id=$id;
            return jefe_familias::where('jfal_calle_id',$id)
            ->orderBy("jfal_nombres")
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
            //var_dump($sw);
            $entro='0';
            if($posicion_coincidencia = strpos($info[15], 'no se encuentra inscrita'))
                        {
                            return response()->json(
                            [
                            'mensaje' => "Esta cédula de identidad no se encuentra inscrito en el Registro Electoral",
                            'tipo' => "NO INSCRITO",
                            ],
                            422                         
                            );
                            $entro='1';
                        }
            if ($sw != 22) {
                if($posicion_coincidencia = strpos($info[15], 'objeción'))
                    {
                        return response()->json(
                            [
                                'mensaje' => "Esta cédula de identidad presenta una objeción - OBJETADO",
                                'tipo' => "OBJETADO",
                            ],
                            200
                            );
                            $entro='1';
                    } 
                    else{
                        if($posicion_coincidencia = strpos($info[15], 'no se encuentra inscrito'))
                        {
                            return response()->json(
                            [
                            'mensaje' => "Esta cédula de identidad no se encuentra inscrito en el Registro Electoral",
                            'tipo' => "NO INSCRITO",
                            ],
                            422                         
                            );
                            $entro='1';
                        }
                } 
            } else if($posicion_coincidencia = strpos($info[16], 'objeción'))
                    {
                        return response()->json(
                            [
                                'mensaje' => "Esta cédula de identidad presenta una objeción - OBJETADO",
                                'tipo' => "OBJETADO",
                            ],
                            200
                            );
                            $entro='1';
                    }   
            else {                
            $cn = explode('-', substr(trim($info[15]), 0, -6));
            $result = str_replace(array("Estado"), '', trim($info[16]));
            //$result = preg_replace('([^A-Za-z0-9 ])', ' ', trim($result));
            $result = str_replace(array("  "), ' ', $result);
            $estadoPer = str_replace(array("\n", "\t", "Municipio"), '',trim($info[17]));
            $municipioPer = str_replace(array("\n", "\t", "Parroquia"), '',trim($info[18]));
            $parroquiaPer = str_replace(array("\n", "\t","Centro"), '',trim($info[19]));
            $centroVotaPer = str_replace(array("\n", "\t","Dirección"), '',trim($info[20]));
            
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
                $entro='1';
            }
            return response()->json(
                [
                'mensaje' => $persona,   
                'tipo' => "INSCRITO", 
                'estado' => $estadoPer,
                'municipio' => $municipioPer,
                'parroquia' => $parroquiaPer,
                'centro' => $centroVotaPer,         
                ],
                200
            );
            $entro='1';
            }
            if($entro=='0')
                        {
                            return response()->json(
                            [
                            'mensaje' => "Esta cédula de identidad no se encuentra inscrito en el Registro Electoral",
                            'tipo' => "NO INSCRITO",
                            ],
                            422                         
                            );
                            $entro='1';
                        }
        });

       /* Route::get('personaconsul/{datosNac}/{datosCed}/datosCNE', function ($datosNac, $datosCed) {

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
            $entro='0';
            if($posicion_coincidencia = strpos($info[1], 'no se encuentra inscrita'))
                        {
                            return response()->json(
                            [
                            'mensaje' => "Esta cédula de identidad no se encuentra inscrito en el Registro Electoral",
                            'tipo' => "NO INSCRITO",
                            ],
                            422                         
                            );
                            $entro='1';
                        }
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
                            $entro='1';
                    } 
                    else{
                        if($posicion_coincidencia = strpos($info[1], 'no se encuentra inscrito'))
                        {
                            return response()->json(
                            [
                            'mensaje' => "Esta cédula de identidad no se encuentra inscrito en el Registro Electoral",
                            'tipo' => "NO INSCRITO",
                            ],
                            422                         
                            );
                            $entro='1';
                        }
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
                            $entro='1';
                    }   
            else {                
            $cn = explode('-', substr(trim($info[1]), 0, -6));
            $result = str_replace(array("Estado"), '', trim($info[2]));
            //$result = preg_replace('([^A-Za-z0-9 ])', ' ', trim($result));
            $result = str_replace(array("  "), ' ', $result);
            $estadoPer = str_replace(array("\n", "\t", "Municipio"), '',trim($info[3]));
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
                $entro='1';
            }
            return response()->json(
                [
                'mensaje' => $persona,   
                'tipo' => "INSCRITO", 
                'estado' => $estadoPer,
                'municipio' => $municipioPer,
                'parroquia' => $parroquiaPer,
                'centro' => $centroVotaPer,         
                ],
                200
            );
            $entro='1';
            }
            if($entro=='0')
                        {
                            return response()->json(
                            [
                            'mensaje' => "Esta cédula de identidad no se encuentra inscrito en el Registro Electoral",
                            'tipo' => "NO INSCRITO",
                            ],
                            422                         
                            );
                            $entro='1';
                        }
        });*/

        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
    });
});

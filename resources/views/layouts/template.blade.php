<!--
=========================================================
* Paper Dashboard 2 - v2.0.1
=========================================================

* Product Page: https://www.creative-tim.com/product/paper-dashboard-2
* Copyright 2020 Creative Tim (https://www.creative-tim.com)

Coded by www.creative-tim.com

 =========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Táchira
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  
  <link href="../assets/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/demo/demo.css" rel="stylesheet" />
  <style>
    ul.nav,
      ul.nav * {
      margin: 0;
      padding: 0;
      border: 0;
      }
      ul.nav {
      margin: 10px auto;
      padding: 0;
      list-style: none;
      width: 100%;
      font-size: 18px;
      }
      ul.nav li {
      list-style: none;
      }
      ul.nav li a {
      display: block;
      padding: 10px 10px 10px 20px;      
      color: #eee;      
      text-decoration: none;
      box-sizing: border-box;
      }
      ul.nav li ul {
      max-height: 0;
      margin: 0;
      padding: 0;
      list-style: none;
      overflow: hidden;
      transition: .3s all ease-in;
      margin-left: 30px;
      }
      ul.nav li li a {
      padding: 10px 10px 10px 40px;
      background: rgba(255, 253, 253, 0.685);
      color: #000;
      font-size: 16px;
      border: 0;
      box-sizing: border-box;      
      }
      ul.nav li li:last-child a {
      border-bottom: 0;
      }
      ul.nav li:target ul {
      max-height: 300px;
      transition: .3s all ease-in;
      }
      ul.nav li a:hover {
      background: #f4f3ef;
      color: #fff;
      }
</style>
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="white" data-active-color="danger">
      <div class="logo">        
        <a href="" class="simple-text logo-normal"> 
           <div class="logo-image-big">
            <strong>Sistema</strong>
            <img src="../assets/img/logopsuv2.jpg" alt="" width="120" height="80">
          </div> 
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="active ">
            <a href="{{ route('home.index') }}">
              <i class="nc-icon nc-bank"></i>
              <p>Inicio</p>
            </a>
          </li>    
          @if (auth()->user()->username=='administrador')      
          <li id="opcion1">
            <a href="#opcion1">
              <i class="nc-icon nc-settings-gear-65"></i>
              <p>Administración</p>
            </a>
            <ul>              
              <li> 
                <a href="{{ route('users.index') }}">                  
                  <p>Usuarios</p>
                </a>
              </li>             
              <li>
                <a href="{{ route('reuniones.index') }}">
                  <p>Eventos</p>
                </a>
              </li>  
              <li>
                <a href="{{ route('sectores.index') }}">
                  <p>Asociar Sectores</p>
                </a>
              </li>         
            </ul>
          </li>
          @endif
          <li id="opcion2">
            <a href="#opcion2">
            <i class="nc-icon nc-paper"></i>
            <p>Asistencia</p>
          </a>
            <ul>
              <li>
                <a href="{{ route('militancia.militantesMunicipios') }}">                  
                  <p>Municipios</p>
                </a>
              </li>
              <li>
                <a href="{{ route('militancia.militantesParroquias') }}">
                  <p>Parroquias</p>
                </a>
              </li>
              <li>
                <a href="{{ route('militancia.militantesUBH') }}">
                  <p>UBCH</p>
                </a>
              </li>
              <li>
                <a href="{{ route('militancia.militantesComunidades') }}">
                  <p>Comunidades</p>
                </a>
              </li>
              <li>
              <a href="{{ route('militancia.militantesCalles') }}">
                <p>Calles</p>
              </a>
            </li>            
          </ul>
		  </li>
          <li id="opcion3">
            <a href="#opcion3">
            <i class="nc-icon nc-paper"></i>
            <p>Estructura</p>
          </a>
            <ul>
              <li>
                <a href="{{ route('estructura.estructuraMunicipios') }}">                  
                  <p>Municipios</p>
                </a>
              </li>
              <li>
                <a href="{{ route('estructura.estructuraParroquias') }}">                  
                  <p>Parroquias</p>
                </a>
              </li>
              <li>
                <a href="{{ route('estructura.estructuraUBCH') }}">                  
                  <p>UBCH</p>
                </a>
              </li>
              <li>
                <a href="{{ route('estructura.estructuraComunidades') }}">                  
                  <p>Comunidades</p>
                </a>
              </li>
              <li>
                <a href="{{ route('estructura.estructuraCalles') }}">                  
                  <p>Calles</p>
                </a>
              </li>
			  </ul>
            </li>  
            <li id="opcion4">
              <a href="#opcion4">
              <i class="nc-icon nc-paper"></i>
              <p>Estructura JPSUV</p>
            </a>
              <ul>
                <li>
                  <a href="{{ route('jpsuvEstructura.jpsuvEstructuraMunicipios') }}">                  
                    <p>Municipios</p>
                  </a>
                </li>    
                <li>
                  <a href="{{ route('jpsuvEstructura.jpsuvEstructuraParroquias') }}">                  
                    <p>Parroquias</p>
                  </a>
                </li>   
                <li>
                  <a href="{{ route('jpsuvEstructura.jpsuvEstructuraUBCH') }}">                  
                    <p>UBCH</p>
                  </a>
                </li>     
                <li>
                  <a href="{{ route('jpsuvEstructura.jpsuvEstructuraComunidades') }}">                  
                    <p>Comunidades</p>
                  </a>
                </li>       
              </ul>
            </li> 
          @if (auth()->user()->username=='administrador') 
             <li id="opcion5">
              <a href="#opcion5">
              <i class="nc-icon nc-paper"></i>
              <p>Reportes</p>
              </a>
              <ul>
               <!--  <li>
                  <a href="{{ route('reportes.listadoCarga') }}">                  
                    <p>Listado</p>
                  </a>
                </li>
                <li>
                  <a href="{{ route('reportes.listadoCargaCalle') }}">                  
                    <p>Listado Calle</p>
                  </a>
                </li>-->                     
              <li>
                <a href="{{ route('reportes.consultaMilitantes') }}">
                  <p>Consultar Militantes</p>
                </a>
              </li> 
              </ul>
             </li>  
             @endif
          @if (auth()->user()->username=='administrador') 
            <li id="opcion5">
              <a href="#opcion5">
              <i class="nc-icon nc-paper"></i>
              <p>Sectores</p>
              </a>
              <ul>
                <li>
                  <a href="{{ route('sectores.cargasectores') }}">                  
                    <p>Carga de sectores</p>
                  </a>
                </li>
              </ul>
             </li>  
             @endif
             @if (auth()->user()->username=='administrador') 
            <li id="opcion6">
              <a href="#opcion6">
              <i class="nc-icon nc-paper"></i>
              <p>Población</p>
              </a>
              <ul>
                <li>
                  <a href="{{ route('poblacion.cargaPoblacion') }}">                  
                    <p>Carga de población</p>
                  </a>
                </li>
              </ul>
             </li>  
             @endif
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="javascript:;">Táchira</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <form>
              <div class="input-group no-border">
                <input type="text" value="" class="form-control" placeholder="Search...">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <i class="nc-icon nc-zoom-split"></i>
                  </div>
                </div>
              </div>
            </form>
            <ul class="navbar-nav">             
              <li class="nav-item">
                <a class="nav-link btn-rotate" href="{{ route('logout.perform') }}">
                  <i class="nc-icon nc-button-power"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Account</span>
                  </p>                  
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      @yield('contenido')
      <footer class="footer footer-black  footer-white ">
        <div class="container-fluid">
          <div class="row">
            <nav class="footer-nav">              
            </nav>
            <div class="credits ml-auto">
              <span class="copyright">
                © <script>
                  document.write(new Date().getFullYear())
                </script>
              </span>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript"></script><!-- Paper Dashboard DEMO methods, don't include it in your project! -->
  <script src="../assets/demo/demo.js"></script>
  @yield('js');
</body>

</html>

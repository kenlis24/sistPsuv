<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Data Table </title>
    <meta content="" name="description">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!-- ========================================================= -->


    <link rel="stylesheet" href="assets2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets2/css/datatables.min.css">
    <link rel="stylesheet" href="assets2/css/style.css">






</head>
<!-- =============== Design & Develop By = MJ MARAZ   ====================== -->

<body>
    <header class="header_part">
        <img src="assets/images/logo.png" alt="" class="img-fluid">
        <h4>Listado por municipio de votación</h4>
    </header>
    <!-- =======  Data-Table  = Start  ========================== -->
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="data_table" >
                    <table id="example" class="table table-striped table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>Nac</th>
                                <th>                                    Cedula
                                </th>
                                <th>
                                  Nombres y Apellidos
                                </th>
                                <th>
                                  Telefono
                                </th>      
                                <th>Centro</th>
                                <th>Comunidad</th>
                                <th>Calle</th>
                                <th>Jefe Comunidad</th>
                                <th>Jefe Calle</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($centro as $item)   
                            <tr>
                                <td>
                                    {{ $item->nac }}
                                </td>
                                <td>
                                    {{ $item->cedula }}
                                </td>
                                <td>
                                    {{ $item->nombres }}
                                </td>   
                                <td>
                                  {{ $item->telefono }}
                              </td>                               
                              <td>
                                {{ $item->centro }}
                            </td> 
                            <td>
                                {{ $item->Comunidad }}
                            </td> 
                            <td>
                                {{ $item->Calle }}
                            </td> 
                            <td>
                                {{ $item->JefeComunidad }}
                            </td> 
                            <td>
                                {{ $item->JefeCalle }}
                            </td> 
                            </tr>
                        @endforeach
                       
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- =======  Data-Table  = End  ===================== -->
    <!-- ============ Java Script Files  ================== -->


    <script src="assets2/js/bootstrap.bundle.min.js"></script>
    <script src="assets2/js/jquery-3.6.0.min.js"></script>
    <script src="assets2/js/datatables.min.js"></script>
    <script src="assets2/js/pdfmake.min.js"></script>
    <script src="assets2/js/vfs_fonts.js"></script>
    <script src="assets2/js/custom.js"></script>


    <script> 

        function cargaData(centroConsul)
        {
          let centroVotacion = centroConsul.value;
      
          fetch(`reporteLista/${centroVotacion}/datosCargados`)
            .then( function (response) { 
              return response.json();
            })
      
            .then(function(jsonData){
              buildListado(jsonData);
            })
          }
      
          function buildListado(jsonListado)
          {
              console.log(jsonListado);
              jsonListado.forEach(function (lista) {  
              $('#tableLista').append(
              `<tr> 
                <td> `+lista.nac+` </td>  
                <td> `+lista.cedula+` </td>  
                <td> `+lista.nombres+` </td>     
                <td> `+lista.telefono+` </td>   
                <td> `+lista.centro+` </td>      
                <td> `+lista.JefeComunidad+` </td> 
                <td> `+lista.JefeCalle+` </td>  
               </tr>`);
            });
          }
      
      
          
      </script>

</body>

</html>

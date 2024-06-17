<!DOCTYPE html>
<style>
  @page
  {
    margin: 5cm 0.5cm 1cm 0.5cm;
  }
  .tabla {
    background-color: black;
    color: white;
  }
  #header {
    position: fixed;
    top: -4cm;
    left: 0cm;
  }
  #imgHeader {
    float: left;
    width: 3cm;
  }
</style> 
<html lang="en">
    <body>
      <div id="header">
      <img class="imgHeader" src="data:image/jpeg;base64,{{ base64_encode(file_get_contents(public_path('assets/img/banner2.jpeg'))) }}" alt="" width="750" height="100">
        <h2 style="text-align: center;"> Estructura de comunidades del municipio
          @foreach ($municipios as $item)
          {{ Str::title($item->mun_nombre) }}
        @endforeach
        </h2>
      </div>
    <div class="container">
        <table class="table table-striped table-bordered nowrap" style="width:100%">
            <thead class="tabla">
              <th>
                Nro.
              </th>
              <th>
                Cedula
              </th>
              <th>
                Nombres y Apellidos
              </th>
              <th>
                Telefono
              </th>
              <th>
                Cargo
              </th>
              <th>
                Comunidades
              </th>
            </thead>
            <tbody>
              <?php
                $i=0;
              ?>
              @foreach ($estructuras as $item)  
              <?php
              $i = $i + 1;
              $fondo='#ffffff';
              $resul=$i % 2;
                if($i % 2 == 0);
                  $fondo='#ffffff';
              ?>
                    <tr style="background-color: {{ $fondo }}">
                        <td> {{ $i }}
                        </td>
                        <td> {{ $item->est_cedula }}
                        </td>
                        <td> {{ Str::title($item->est_nombres) }}
                        </td>
                        <td> {{ $item->est_telefono }}
                        </td>
                        <td> {{ $item->car_cargo }}
                        </td>   
                        <td> {{ Str::title($item->com_nombre) }}
                        </td> 
                    </tr>
                    @endforeach
            </tbody>
          </table>
        </div>
    </body>   
</html>
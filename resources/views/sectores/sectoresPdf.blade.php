<!DOCTYPE html>
<style>
  .cabecera {
    background-color: black;
    color: white;
  }
</style> 
<html lang="en">
    <body>
      <div>
      <img src="data:image/jpeg;base64,{{ base64_encode(file_get_contents(public_path('assets/img/logoInicio3.jpeg'))) }}" alt="" width="60" height="60">
        <h2 style="text-align: center;"> Comando @foreach ($sector as $item)
          {{ Str::title($item->sec_nombre) }}
        @endforeach</h2>
        </div>
        <table class="table table-striped table-bordered nowrap" style="width:100%">
            <thead class="cabecera">
              <th>
                Nac
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
                Municipio
              </th>
            </thead>
            <tbody>
              <?php
                $i=0;
              ?>
              @foreach ($sectoresPersonas as $item)  
              <?php
              $resul=$i%2;
                if($resul == 0);
                  $fondo='#FFFFFF';
              ?>
                    <tr style="background-color: #FFFFFF;">
                        <td> {{ $item->secp_nac }}
                        </td>
                        <td> {{ $item->secp_cedula }}
                        </td>
                        <td> {{ Str::title($item->secp_nombres) }}
                        </td>
                        <td> {{ $item->secp_telefono }}
                        </td>
                        <td> {{ $item->secar_cargo }}
                        </td>   
                        <td> {{ Str::title($item->mun_nombre) }}
                        </td> 
                    </tr>
                    @endforeach
            </tbody>
          </table>
    </body>   
</html>
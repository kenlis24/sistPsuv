<!DOCTYPE html>
<html lang="en">
    <body>
        <h1> Sector </h1>
        <table class="table table-striped table-bordered nowrap" style="width:100%">
            <thead class=" text-primary">
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
              @foreach ($sectoresPersonas as $item)  
                    <tr>
                        <td> {{ $item->secp_nac }}
                        </td>
                        <td> {{ $item->secp_cedula }}
                        </td>
                        <td> {{ $item->secp_nombres }}
                        </td>
                        <td> {{ $item->secp_telefono }}
                        </td>
                        <td> {{ $item->secar_cargo }}
                        </td>   
                        <td> {{ $item->mun_nombre }}
                        </td> 
                    </tr>
                    @endforeach
            </tbody>
          </table>
    </body>   
</html>
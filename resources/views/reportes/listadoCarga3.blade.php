@extends('layouts.template')

@section('contenido')
<div class="content">
<div class="row">
<div class="col-md-12">
    <div class="card card-user">
      <div class="card-header">
        <h5 class="card-title">Listado de Carga</h5>
      </div>
      <div class="card-body">
        <form method="post" action="{{ route('sectores.storeCarga') }}">
            {!! csrf_field() !!}
            @php
              $usu = auth()->user()->username;
            @endphp
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Seleccione el centro</label>             
                <select class="form-control" name="secp_municipio_carga" id="secp_municipio_carga" onchange="cargaData(this)">
                  <option value="">Selecciona el centro</option>
                  @foreach ($centro as $item)
                    <option value="{{ $item->centro }}">{{ $item->centro }}</option>
                  @endforeach
                </select>
                
              </div>
            </div>              
          </div> 
          <div class="row">
            <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <div class="">
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
                    </thead>
                    <tbody id="tableLista">  
                            <tr>
                                <td> 
                                </td>
                                <td> 
                                </td>
                                <td> 
                                </td>
                                <td> 
                                </td>
                            </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          </div>
        </form>
      </div>
    </div>
</div>
</div>

</div>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>

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
         </tr>`);
      });
    }


    
</script>

@endsection




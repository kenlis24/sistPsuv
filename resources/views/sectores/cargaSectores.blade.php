@extends('layouts.template')

@section('contenido')
<div class="content">
<div class="row">
<div class="col-md-12">
    <div class="card card-user">
      <div class="card-header">
        <h5 class="card-title">Cargar Usuarios por Sectores</h5>
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
                <label>Municipios del estado Táchira</label>             
                <select class="form-control" name="secp_municipio_carga" id="secp_municipio_carga" required>
                  <option value="">Selecciona el municipio</option>
                  @foreach ($municipios as $item)
                    <option value="{{ $item->id }}">{{ $item->mun_nombre }}</option>
                  @endforeach
                </select>
                
              </div>
            </div>       
            <div class="col-md-6">
              <div class="form-group">
                <label>Sector</label>
                <select class="form-control" name="secp_sec_id" id="secp_sec_id" required>
                  @foreach ($sector as $item)
                    <option value="{{ $item->id }}">{{ $item->sec_nombre }}</option>
                  @endforeach
                </select>
                
              </div>
            </div>         
          </div> 
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <table class="table" id="table">
                  <thead class=" text-primary">
                    <th>
                      Nac
                    </th>
                    <th>
                      Cedula
                    </th>
                    <th>
                      
                    </th>
                    <th>
                      Nombres y Apellidos
                    </th>
                    <th>
                      Telefono
                    </th>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <select class="form-control" name="secp_nac" id="secp_nac">
                          <option value="V">V</option>   
                          <option value="E">E</option>       
                        </select>
                      </td>
                      <td>
                        <input type="text" class="form-control" placeholder="Cedula" name="secp_cedula" id="secp_cedula" required>
                      </td>
                      <td>  
                        <button type="button" class="nc-icon nc-zoom-split" style="border: none; background: none;" onclick="consultarced()"></button>
                      </td>
                      <td>
                        <input type="text" class="form-control" style="text-transform:uppercase;" placeholder="Nombres" name="secp_nombres" id="secp_nombres" required>   
                        <input type="hidden" name="secp_estado" id="secp_estado"/> 
                        <input type="hidden" name="secp_municipio" id="secp_municipio"/>    
                        <input type="hidden" name="secp_parroquia" id="secp_parroquia"/>     
                        <input type="hidden" name="secp_centro" id="secp_centro"/> 
                        <input type="hidden" name="secp_tipo_reg" id="secp_tipo_reg"/> 
                        <input type="hidden" name="secp_usuario_creo" id="secp_usuario_creo" value="{{ $usu }}"/>       
                      </td>                 
                      <td>
                        <input type="text" class="form-control" placeholder="Telefono" name="secp_telefono" required>
                      </td>                  
                    </tr>  
                  </tbody>
                </table>
              </div>
            </div>
          </div>         
          <div class="row">
            <div class="update ml-auto mr-auto">
              <button type="submit" class="btn btn-primary btn-round">Guardar</button>
            </div>            
          </div>
          @if(session("mensaje"))
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <h5 class="card-title">{{session('mensaje')}}</h5>
                    </div>
                  </div>
                </div>
            @endif
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
                      <th>
                        Cargo
                      </th>
                      <th>
                        Parroquia
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
                                <td> {{ $item->sec_nombre }}
                                </td>   
                                <td> {{ $item->mun_nombre }}
                                </td> 
                            </tr>
                            @endforeach
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

  function consultarced()
  {
    var datosNac = document.getElementById("secp_nac").value;
    var datosCed = document.getElementById("secp_cedula").value;

    fetch(`personaconsul/${datosNac}/${datosCed}/datosCNE`)
      .then( function (response) { 
        return response.json();
      })
      .then(function(jsonDataCNE){
        buildDataCNE(jsonDataCNE);
      })
  }

  function buildDataCNE(jsonDataCNE)
    {    
      if(jsonDataCNE.tipo=='OBJETADO')
      {
        alert("\nDebe Cargar los datos de la persona");
        document.getElementById("secp_tipo_reg").value = jsonDataCNE.tipo;
      } 
      if(jsonDataCNE.tipo=='NO INSCRITO')
      {
        alert("\nDebe Cargar los datos de la persona");
        document.getElementById("secp_tipo_reg").value = jsonDataCNE.tipo;
      } 
      if(jsonDataCNE.tipo=='INSCRITO')
      {
        let arrayNombres = jsonDataCNE.mensaje;
            let total = arrayNombres.length;
            if (total <= 3) {
              document.getElementById("secp_nombres").value = jsonDataCNE.mensaje[0]+ " " +jsonDataCNE.mensaje[1]+ " " +jsonDataCNE.mensaje[2];
              document.getElementById("secp_estado").value = jsonDataCNE.estado;
              document.getElementById("secp_municipio").value = jsonDataCNE.municipio;
              document.getElementById("secp_parroquia").value = jsonDataCNE.parroquia;
              document.getElementById("secp_centro").value = jsonDataCNE.centro;
              document.getElementById("secp_tipo_reg").value = jsonDataCNE.tipo;
            } else {
              document.getElementById("secp_nombres").value = jsonDataCNE.mensaje[0]+ " " +jsonDataCNE.mensaje[1]+ " " +jsonDataCNE.mensaje[2]+ " " +jsonDataCNE.mensaje[3];
              document.getElementById("secp_estado").value = jsonDataCNE.estado;
              document.getElementById("secp_municipio").value = jsonDataCNE.municipio;
              document.getElementById("secp_parroquia").value = jsonDataCNE.parroquia;
              document.getElementById("secp_centro").value = jsonDataCNE.centro;
              document.getElementById("secp_tipo_reg").value = jsonDataCNE.tipo;
            }   
            console.log(jsonDataCNE);
      }  
    }

  function loadParroquias(selectMunicipios)
  {
    let municipioId = selectMunicipios.value;
    
    fetch(`municipios/${municipioId}/parroquias`)
      .then( function (response) { 
        return response.json();
      })

      .then(function(jsonData){
        buildParroquiasSelect(jsonData);
      })
    }

    function buildParroquiasSelect(jsonParroquias)
    {
      let parroquiasSelect = document.getElementById('parSelect');      
      clearSelectParroquias(parroquiasSelect);
      
      jsonParroquias.forEach(function (parr) {
        let optionTag = document.createElement('option');
        optionTag.value = parr.id;
        optionTag.innerHTML = parr.par_nombre;
        parroquiasSelect.append(optionTag);
      });
    }

    function clearSelectParroquias(select)
    {
      while(select.options.length > 1){
        select.remove(1);
      }
    }  

    
</script>

@endsection




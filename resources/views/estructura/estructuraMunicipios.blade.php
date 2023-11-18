@extends('layouts.template')

@section('contenido')
<div class="content">
<div class="row">
<div class="col-md-12">
    <div class="card card-user">
      <div class="card-header">
        <h5 class="card-title">Cargar Estructura de Municipios</h5>
      </div>
      <div class="card-body">
        <form method="post" action="{{ route('estructura.store') }}">
            {!! csrf_field() !!}
            @php
              $usu = auth()->user()->username;
            @endphp
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Municipios del estado Táchira</label>
                <input type="hidden" name="est_nivel" id="est_nivel" value="municipios"/>                
                   <input type="hidden" name="est_municipio_usu" id="est_municipio_usu" value="{{ auth()->user()->usu_mun_id }}"/>
                @if(auth()->user()->username!='administrador')
                   <input type="hidden" name="est_nivel_id" id="est_nivel_id" value="{{ auth()->user()->usu_mun_id }}"/>
                @endif
                <select class="form-control" name="est_nivel_id" id="est_nivel_id" {{ auth()->user()->username!='administrador'  ? 'disabled' : '' }} required>
                  <option value="">Selecciona el municipio</option>
                  @foreach ($municipios as $item)
                    <option value="{{ $item->id }}" {{ $item->id == auth()->user()->usu_mun_id  ? 'selected' : '' }}>{{ $item->mun_nombre }}</option>
                  @endforeach
                </select>
                
              </div>
            </div>       
            <div class="col-md-6">
              <div class="form-group">
                <label>Estructura Municipios</label>
                <input type="hidden" name="mil_tipo_nivel" id="mil_tipo_nivel" value="municipios"/>
                <select class="form-control" name="est_car_id" id="est_car_id" required>
                  <option value="">Selecciona el cargo</option>
                  @foreach ($cargos as $item)
                    <option value="{{ $item->id }}">{{ $item->car_cargo }}</option>
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
                    <th>
                      Dirección
                    </th>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <select class="form-control" name="est_nac" id="est_nac">
                          <option value="V">V</option>   
                          <option value="E">E</option>       
                        </select>
                      </td>
                      <td>
                        <input type="text" class="form-control" placeholder="Cedula" name="est_cedula" id="est_cedula" required>
                      </td>
                      <td>  
                        <button type="button" class="nc-icon nc-zoom-split" style="border: none; background: none;" onclick="consultarced()"></button>
                      </td>
                      <td>
                        <input type="text" class="form-control" style="text-transform:uppercase;" placeholder="Nombres" name="est_nombres" id="est_nombres" required>   
                        <input type="hidden" name="est_estado" id="est_estado"/> 
                        <input type="hidden" name="est_municipio" id="est_municipio"/>    
                        <input type="hidden" name="est_parroquia" id="est_parroquia"/>     
                        <input type="hidden" name="est_centro" id="est_centro"/> 
                        <input type="hidden" name="est_tipo_reg" id="est_tipo_reg"/> 
                        <input type="hidden" name="est_usuario_creo" id="est_usuario_creo" value="{{ $usu }}"/>       
                      </td>                 
                      <td>
                        <input type="text" class="form-control" placeholder="Telefono" name="est_telefono" required>
                      </td>     
                      <td>
                        <input type="text" class="form-control" placeholder="Dirección" name="est_direccion" required>
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
                      @foreach ($estructuras as $item)  
                            <tr>
                                <td> {{ $item->est_nac }}
                                </td>
                                <td> {{ $item->est_cedula }}
                                </td>
                                <td> {{ $item->est_nombres }}
                                </td>
                                <td> {{ $item->est_telefono }}
                                </td>
                                <td> {{ $item->car_cargo }}
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
  const $selectOption = document.querySelector("#est_municipio_usu");   
  const $select = document.getElementById("est_municipio_usu").value;  

  function consultarced()
  {
    var datosNac = document.getElementById("est_nac").value;
    var datosCed = document.getElementById("est_cedula").value;

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
        document.getElementById("est_tipo_reg").value = jsonDataCNE.tipo;
      } 
      if(jsonDataCNE.tipo=='NO INSCRITO')
      {
        alert("\nDebe Cargar los datos de la persona");
        document.getElementById("est_tipo_reg").value = jsonDataCNE.tipo;
      } 
      if(jsonDataCNE.tipo=='INSCRITO')
      {
        let arrayNombres = jsonDataCNE.mensaje;
            let total = arrayNombres.length;
            if (total <= 3) {
              document.getElementById("est_nombres").value = jsonDataCNE.mensaje[0]+ " " +jsonDataCNE.mensaje[1]+ " " +jsonDataCNE.mensaje[2];
              document.getElementById("est_estado").value = jsonDataCNE.estado;
              document.getElementById("est_municipio").value = jsonDataCNE.municipio;
              document.getElementById("est_parroquia").value = jsonDataCNE.parroquia;
              document.getElementById("est_centro").value = jsonDataCNE.centro;
              document.getElementById("est_tipo_reg").value = jsonDataCNE.tipo;
            } else {
              document.getElementById("est_nombres").value = jsonDataCNE.mensaje[0]+ " " +jsonDataCNE.mensaje[1]+ " " +jsonDataCNE.mensaje[2]+ " " +jsonDataCNE.mensaje[3];
              document.getElementById("est_estado").value = jsonDataCNE.estado;
              document.getElementById("est_municipio").value = jsonDataCNE.municipio;
              document.getElementById("est_parroquia").value = jsonDataCNE.parroquia;
              document.getElementById("est_centro").value = jsonDataCNE.centro;
              document.getElementById("est_tipo_reg").value = jsonDataCNE.tipo;
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



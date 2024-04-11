@extends('layouts.template')

@section('contenido')
<div class="content">
<div class="row">
<div class="col-md-12">
    <div class="card card-user">
      <div class="card-header">
        <h5 class="card-title">Cargar Estructura de Municipios JPSUV</h5>
      </div>
      <div class="card-body">
        <form method="post" action="{{ route('jpsuvEstructura.store') }}">
            {!! csrf_field() !!}
            @php
              $usu = auth()->user()->username;
            @endphp
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Municipios del estado Táchira</label>
                <input type="hidden" name="estj_nivel" id="estj_nivel" value="municipios"/>                
                   <input type="hidden" name="estj_municipio_usu" id="estj_municipio_usu" value="{{ auth()->user()->usu_mun_id }}"/>
                @if(auth()->user()->username!='administrador')
                   <input type="hidden" name="estj_nivel_id" id="estj_nivel_id" value="{{ auth()->user()->usu_mun_id }}"/>
                @endif
                <select class="form-control" name="estj_nivel_id" id="estj_nivel_id" {{ auth()->user()->username!='administrador'  ? 'disabled' : '' }} required>
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
                <select class="form-control" name="estj_car_id" id="estj_car_id" required>
                  <option value="">Selecciona el cargo</option>
                  @foreach ($jpsuv_cargos as $item)
                    <option value="{{ $item->id }}">{{ $item->carj_cargo }}</option>
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
                        <select class="form-control" name="estj_nac" id="estj_nac">
                          <option value="V">V</option>   
                          <option value="E">E</option>       
                        </select>
                      </td>
                      <td>
                        <input type="text" class="form-control" placeholder="Cedula" name="estj_cedula" id="estj_cedula" required>
                      </td>
                      <td>  
                        <button type="button" class="nc-icon nc-zoom-split" style="border: none; background: none;" onclick="consultarced()"></button>
                      </td>
                      <td>
                        <input type="text" class="form-control" style="text-transform:uppercase;" placeholder="Nombres" name="estj_nombres" id="estj_nombres" required>   
                        <input type="hidden" name="estj_estado" id="estj_estado"/> 
                        <input type="hidden" name="estj_municipio" id="estj_municipio"/>    
                        <input type="hidden" name="estj_parroquia" id="estj_parroquia"/>     
                        <input type="hidden" name="estj_centro" id="estj_centro"/> 
                        <input type="hidden" name="estj_tipo_reg" id="estj_tipo_reg"/> 
                        <input type="hidden" name="estj_usuario_creo" id="estj_usuario_creo" value="{{ $usu }}"/>       
                      </td>                 
                      <td>
                        <input type="text" class="form-control" placeholder="Telefono" name="estj_telefono" required>
                      </td>     
                      <td>
                        <input type="text" class="form-control" placeholder="Dirección" name="estj_direccion" required>
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
          </form>
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
                      <th>
                        Acciones
                      </th>
                    </thead>
                    <tbody>
                      @foreach ($jpsuv_estructuras as $item)  
                            <tr>
                                <td> {{ $item->estj_nac }}
                                </td>
                                <td> {{ $item->estj_cedula }}
                                </td>
                                <td> {{ $item->estj_nombres }}
                                </td>
                                <td> {{ $item->estj_telefono }}
                                </td>
                                <td> {{ $item->carj_cargo }}
                                </td>   
                                <td> {{ $item->mun_nombre }}
                                </td> 
                                <td class="text-right">   
                                  
                                  <form class="miFormulario" action="{{ route('jpsuvEstructura.destroy',['id' => $item->id,'pag' => 'municipios']) }}">
                                    @method("DELETE")
                                      @csrf
                                    <!-- Otros campos del formulario anidado -->
                                    
                                    <button type="submit" id="botonmiFormulario" class="btn btn-danger btn-round">Eliminar</button>
                                </form>
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
        
      </div>
    </div>
</div>
</div>

</div>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>

<script>
  const $selectOption = document.querySelector("#estj_municipio_usu");   
  const $select = document.getElementById("estj_municipio_usu").value;  

  function consultarced()
  {
    var datosNac = document.getElementById("estj_nac").value;
    var datosCed = document.getElementById("estj_cedula").value;

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
        document.getElementById("estj_tipo_reg").value = jsonDataCNE.tipo;
      } 
      if(jsonDataCNE.tipo=='NO INSCRITO')
      {
        alert("\nDebe Cargar los datos de la persona");
        document.getElementById("estj_tipo_reg").value = jsonDataCNE.tipo;
      } 
      if(jsonDataCNE.tipo=='INSCRITO')
      {
        let arrayNombres = jsonDataCNE.mensaje;
            let total = arrayNombres.length;
            if (total <= 3) {
              document.getElementById("estj_nombres").value = jsonDataCNE.mensaje[0]+ " " +jsonDataCNE.mensaje[1]+ " " +jsonDataCNE.mensaje[2];
              document.getElementById("estj_estado").value = jsonDataCNE.estado;
              document.getElementById("estj_municipio").value = jsonDataCNE.municipio;
              document.getElementById("estj_parroquia").value = jsonDataCNE.parroquia;
              document.getElementById("estj_centro").value = jsonDataCNE.centro;
              document.getElementById("estj_tipo_reg").value = jsonDataCNE.tipo;
            } else {
              document.getElementById("estj_nombres").value = jsonDataCNE.mensaje[0]+ " " +jsonDataCNE.mensaje[1]+ " " +jsonDataCNE.mensaje[2]+ " " +jsonDataCNE.mensaje[3];
              document.getElementById("estj_estado").value = jsonDataCNE.estado;
              document.getElementById("estj_municipio").value = jsonDataCNE.municipio;
              document.getElementById("estj_parroquia").value = jsonDataCNE.parroquia;
              document.getElementById("estj_centro").value = jsonDataCNE.centro;
              document.getElementById("estj_tipo_reg").value = jsonDataCNE.tipo;
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

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('eliminar') == 'ok')
  <script>
      Swal.fire({
            title: "Eliminado",
            text: "El registro se eliminó correctamente",
            icon: "success"
          });
  </script>
@endif
<script type="text/javascript">
  $('.miFormulario').submit(function (e) {
    e.preventDefault();

    Swal.fire({
      title: "¿Estas seguro de Eliminar?",
      text: "¡No podrás revertir esto!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "¡Sí, estoy seguro!"
      }).then((result) => {
        if (result.isConfirmed) {
          this.submit();
        }
      });

    });
</script> 
@endsection


@extends('layouts.template')

@section('contenido')
<div class="content">
<div class="row">
<div class="col-md-12">
    <div class="card card-user">
      <div class="card-header">
        <h5 class="card-title">Crear Jefe de Familia</h5>
      </div>
      <div class="card-body">
        <form  method="post" action="{{ route('calles.store') }}">
            {!! csrf_field() !!}
            @php
              $usu = auth()->user()->username;
            @endphp
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Municipios del estado Táchira</label>      
                                     
                <select class="form-control"  id="_municipios" onchange="loadParroquias(this)" {{ auth()->user()->username!='administrador'  ? 'disabled' : '' }} required>
                  <option value="">Selecciona el municipio</option>
                  @foreach ($municipios as $item)
                    <option value="{{ $item->id }}" {{ $item->id == auth()->user()->usu_mun_id  ? 'selected' : '' }}>{{ $item->mun_nombre }}</option>
                  @endforeach
                </select>
                
              </div>
            </div>  
            <div class="col-md-6">
                <div class="form-group">
                  <label>Parroquias del estado Táchira</label>
                  <select class="form-control"  id="parSelect" onchange="loadUBCH(this)" required>  
                    <option value="">Selecciona la parroquia</option>       
                  </select>
                </div>
              </div>     
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>UBCH del estado Táchira</label>
                  <select class="form-control" id="ubchSelect" onchange="loadComunidades(this)" required>  
                    <option value="">Selecciona la UBCH</option>       
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Comunidades</label>
                  <select class="form-control" id="comunSelect" onchange="loadCalles(this)" required>
                    <option value="">Selecciona la comunidad</option>                  
                  </select>
                </div>
              </div>
                    
          </div> 
          <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                  <label>Calles</label>
                  <select class="form-control" name="jfal_calle_id" id="calleSelect" required>
                    <option value="">Selecciona la Calles</option>
                    
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
                        <select class="form-control" name="jfal_nac" id="jfal_nac">
                          <option value="V">V</option>   
                          <option value="E">E</option>       
                        </select>
                      </td>
                      <td>
                        <input type="text" class="form-control" placeholder="Cedula" name="jfal_cedula" id="jfal_cedula" required>
                      </td>
                      <td>  
                        <button type="button" class="nc-icon nc-zoom-split" style="border: none; background: none;" onclick="consultarced()"></button>
                      </td>
                      <td>
                        <input type="text" class="form-control" style="text-transform:uppercase;" placeholder="Nombres" name="jfal_nombres" id="jfal_nombres" required>   
                        <input type="hidden" name="jfal_estado" id="jfal_estado"/> 
                        <input type="hidden" name="jfal_municipio" id="jfal_municipio"/>    
                        <input type="hidden" name="jfal_parroquia" id="jfal_parroquia"/>     
                        <input type="hidden" name="jfal_centro" id="jfal_centro"/> 
                        <input type="hidden" name="jfal_tipo_reg" id="jfal_tipo_reg"/> 
                        <input type="hidden" name="jfal_usuario_creo" id="jfal_usuario_creo" value="{{ $usu }}"/>       
                      </td>                 
                      <td>
                        <input type="text" class="form-control" placeholder="Telefono" name="jfal_telefono" required>
                      </td>     
                      <td>
                        <input type="text" class="form-control" placeholder="Dirección" name="jfal_direccion" required>
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
          </div>        
      </div>
    </div>
</div>
</div>

</div>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>

<script>
  const $selectOption = document.querySelector("#_municipios");   
  const $select = document.getElementById("_municipios").value;  
  if($select>1)
  {
    loadParroquias($selectOption);
  } 
  function loadUBCH(selectParroquias)
  {
    let parroquiaId = selectParroquias.value;
    fetch(`parroquias/${parroquiaId}/agrupaciones`)
      .then( function (response) { 
        return response.json();
      })

      .then(function(jsonData){
        buildUBCHSelect(jsonData);
      })
    }

    function buildUBCHSelect(jsonUBCH)
    {
      let UBCHSelect = document.getElementById('ubchSelect');
      clearSelectUBCH(ubchSelect);
      clearSelectComunindades(comunSelect);
      clearSelectCalles(calleSelect);  
      jsonUBCH.forEach(function (ubch) {
        let optionTag = document.createElement('option');
        optionTag.value = ubch.id;
        optionTag.innerHTML = ubch.agr_nombre;
        ubchSelect.append(optionTag);
      });
    }

    function loadComunidades(selectUBCH)
  {
    let ubchaId = selectUBCH.value;
    fetch(`ubch/${ubchaId}/comunidades`)
      .then( function (response) { 
        return response.json();
      })

      .then(function(jsonData){
        buildComunidadesSelect(jsonData);
      })
    }

    function buildComunidadesSelect(jsonComun)
    {
      let ComunSelect = document.getElementById('comunSelect');
      clearSelectComunindades(comunSelect);
      clearSelectCalles(calleSelect);  
      jsonComun.forEach(function (comun) {
        let optionTag = document.createElement('option');
        optionTag.value = comun.id;
        optionTag.innerHTML = comun.com_nombre;
        comunSelect.append(optionTag);
      });
    }

    function loadCalles(comunSelect)
  {
    let comuniId = comunSelect.value;
    fetch(`comun/${comuniId}/calles`)
      .then( function (response) { 
        return response.json();
      })

      .then(function(jsonData){
        buildCallesSelect(jsonData);
      })
    }

    function buildCallesSelect(jsonCalles)
    {
      let CallesSelect = document.getElementById('calleSelect');
      clearSelectCalles(calleSelect); 
      jsonCalles.forEach(function (calle) {
        let optionTag = document.createElement('option');
        optionTag.value = calle.id;
        optionTag.innerHTML = calle.cal_nombre;
        calleSelect.append(optionTag);
      });
    }

  function consultarced()
  {
    var datosNac = document.getElementById("jfal_nac").value;
    var datosCed = document.getElementById("jfal_cedula").value;
    

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
        document.getElementById("jfal_tipo_reg").value = jsonDataCNE.tipo;
      } 
      if(jsonDataCNE.tipo=='NO INSCRITO')
      {
        alert("\nDebe Cargar los datos de la persona");
        document.getElementById("jfal_tipo_reg").value = jsonDataCNE.tipo;
      } 
      if(jsonDataCNE.tipo=='INSCRITO')
      {
        let arrayNombres = jsonDataCNE.mensaje;
            let total = arrayNombres.length;
            if (total <= 3) {
              document.getElementById("jfal_nombres").value = jsonDataCNE.mensaje[0]+ " " +jsonDataCNE.mensaje[1]+ " " +jsonDataCNE.mensaje[2];
              document.getElementById("jfal_estado").value = jsonDataCNE.estado;
              document.getElementById("jfal_municipio").value = jsonDataCNE.municipio;
              document.getElementById("jfal_parroquia").value = jsonDataCNE.parroquia;
              document.getElementById("jfal_centro").value = jsonDataCNE.centro;
              document.getElementById("jfal_tipo_reg").value = jsonDataCNE.tipo;
            } else {
              document.getElementById("jfal_nombres").value = jsonDataCNE.mensaje[0]+ " " +jsonDataCNE.mensaje[1]+ " " +jsonDataCNE.mensaje[2]+ " " +jsonDataCNE.mensaje[3];
              document.getElementById("jfal_estado").value = jsonDataCNE.estado;
              document.getElementById("jfal_municipio").value = jsonDataCNE.municipio;
              document.getElementById("jfal_parroquia").value = jsonDataCNE.parroquia;
              document.getElementById("jfal_centro").value = jsonDataCNE.centro;
              document.getElementById("jfal_tipo_reg").value = jsonDataCNE.tipo;
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
      clearSelectUBCH(ubchSelect);
      clearSelectComunindades(comunSelect);
      clearSelectCalles(calleSelect);  
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
    function clearSelectUBCH(select)
    {
      while(select.options.length > 1){
        select.remove(1);
      }
    } 

    function clearSelectComunindades(select)
    {
      while(select.options.length > 1){
        select.remove(1);
      }
    }  

    function clearSelectCalles(select)
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


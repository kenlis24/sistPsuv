@extends('layouts.template')

@section('contenido')
<div class="content">
<div class="row">
<div class="col-md-12">
    <div class="card card-user">
      <div class="card-header">
        <h5 class="card-title">Crear Comunidades</h5>
      </div>
      <div class="card-body">
        <form method="post" action="{{ route('comunidades.store') }}">
            {!! csrf_field() !!}
            @php
              $usu = auth()->user()->username;
            @endphp
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Municipios del estado Táchira</label>
                <input type="hidden" name="com_estado" id="com_estado" value="A"/>    
                  
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
                      <select class="form-control" name="com_agr_id" id="ubchSelect" required>  
                        <option value="">Selecciona la UBCH</option>       
                      </select>
                    </div>
                  </div>
                    
          </div> 
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Nombre de Comunidad</label>
                <input type="text" class="form-control" placeholder="Nombre de Comunidad" name="com_nombre">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Código de Comunidad</label>
                <input type="text" class="form-control" placeholder="Código de Comunidad" name="com_codigo">
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
      jsonComun.forEach(function (comun) {
        let optionTag = document.createElement('option');
        optionTag.value = comun.id;
        optionTag.innerHTML = comun.com_nombre;
        comunSelect.append(optionTag);
      });
    }

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
      clearSelectUBCH(ubchSelect);
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
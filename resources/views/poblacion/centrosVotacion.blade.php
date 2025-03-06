@extends('layouts.auth-master')

@section('content')

    <form method="post">
        <br>    
           
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        {!! csrf_field() !!}
        <br>
        <h1 class="navbar-brand">Lugar Asamblea de Postulación</h1>

        @include('layouts.partials.messages')
        <div class="row">
          <div class="col-md-4 px-1">
          </div>
          <div class="ol-md-4 px-1">
            <div class="form-group">
              <label>Municipios del estado Táchira</label>
              <select class="form-control" name="municipios_id" id="_municipios" onchange="loadParroquias(this)">
                <option value="">Selecciona el municipio</option>
                @foreach ($municipios as $item)
                  <option value="{{ $item->id }}">{{ $item->mun_nombre }}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 px-1">
          </div>
          <div class="ol-md-4 px-1">
            <div class="form-group">
              <label>Parroquias del estado Táchira</label>
              <select class="form-control" name="parroquias_id" id="parSelect" onchange="loadUBCH(this)">  
                <option value="">Selecciona la parroquia</option>       
              </select>
            </div>
          </div>            
        </div>
        <div class="row">
          <div class="col-md-4 px-1">
          </div>
          <div class="ol-md-4 px-1">
            <div class="form-group">
              <label>Comunidades del estado Táchira</label>
              <select class="form-control" id="ubchSelect" onchange="loadComunidades(this)"> 
                <option value="">Selecciona comunidades</option>       
              </select>
            </div>
          </div>            
        </div>
        <div class="row">
          <div class="col-md-4 px-1">
          </div>
          <div class="ol-md-4 px-1">
            <div class="form-group">
              <label>Lugar Asamblea de Postulación</label>
              <select class="form-control" id="comunSelect"> 
                <option value="">Selecciona Centros de Votación</option>       
              </select>
             
            </div>
          </div>            
        </div>        
        @include('auth.partials.copy')
    </form>

    <script>
      const $selectOption = document.querySelector("#_municipios");   
      const $select = document.getElementById("_municipios").value; 
      
      function loadParroquias(selectMunicipios)
      {
        let municipioId = selectMunicipios.value;
        
        fetch(`municipios2/${municipioId}/parroquias2`)
          .then( function (response) { 
            return response.json();
          })

          .then(function(jsonData){
            buildParroquiasSelect(jsonData);
          })
        }

    function clearSelectParroquias(select)
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

    function clearSelectUBCH(select)
    {
      while(select.options.length > 1){
        select.remove(1);
      }
    } 

        function buildParroquiasSelect(jsonParroquias)
        {
          let parroquiasSelect = document.getElementById('parSelect'); 
          clearSelectComunindades(comunSelect);
          clearSelectUBCH(ubchSelect);
          clearSelectParroquias(parSelect);
          jsonParroquias.forEach(function (parr) {
            let optionTag = document.createElement('option');
            optionTag.value = parr.id;
            optionTag.innerHTML = parr.par_nombre;
            parroquiasSelect.append(optionTag);
          });
        }

        function loadUBCH(selectParroquias)
  {
    let parroquiaId = selectParroquias.value;
    fetch(`parroquias2/${parroquiaId}/agrupaciones2`)
      .then( function (response) { 
        return response.json();
      })

      .then(function(jsonData){
        buildUBCHSelect(jsonData);
      })
    }

    function loadComunidades(selectUBCH)
  {
    let ubchaId = selectUBCH.value;
    fetch(`comunidades2/${ubchaId}/agrupaciones2`)
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
      jsonComun.forEach(function (agrupaciones) {
        let optionTag = document.createElement('option');
        optionTag.value = agrupaciones.id;
        optionTag.innerHTML = agrupaciones.agr_nombre;
        comunSelect.append(optionTag);
      });
    }

    function buildUBCHSelect(jsonUBCH)
    {
      let UBCHSelect = document.getElementById('ubchSelect');

      jsonUBCH.forEach(function (comunidades) {
        let optionTag = document.createElement('option');
        optionTag.value = comunidades.id;
        optionTag.innerHTML = comunidades.com_nombre;
        ubchSelect.append(optionTag);
      });
    }
    </script>
@endsection

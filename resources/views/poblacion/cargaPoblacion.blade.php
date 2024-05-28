@extends('layouts.template')

@section('contenido')
<div class="content">
<div class="row">
<div class="col-md-12">
    <div class="card card-user">
      <div class="card-header">
        <h5 class="card-title">Cargar Población</h5>
      </div>
      <div class="card-body">
        <form method="post" action="{{ route('poblacion.storePoblacion') }}">
            {!! csrf_field() !!}
            @php
              $usu = auth()->user()->username;
            @endphp
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Municipios del estado Táchira</label>
                <select class="form-control" name="municipios_id" id="_municipios" onchange="loadParroquias(this)" {{ auth()->user()->username!='administrador'  ? 'disabled' : '' }}>
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
                <select class="form-control" name="parroquias_id" id="parSelect" onchange="loadUBCH(this)">  
                  <option value="">Selecciona la parroquia</option>       
                </select>
              </div>
            </div>            
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>UBCH del estado Táchira</label>
                <select class="form-control" id="ubchSelect" onchange="loadComunidades(this)">  
                  <option value="">Selecciona la UBCH</option>       
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Comunidades</label>
                <select class="form-control"  id="comunSelect" onchange="loadCalles(this)" required>
                  <option value="">Selecciona la comunidad</option>
                  
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Calles</label>
                <select class="form-control" name="pofa_calle_id" id="calleSelect" onchange="loadJefes(this)" required>
                  <option value="">Selecciona la Calles</option>
                  
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Jefes de Familia</label>
                <select class="form-control" name="pofa_jefe_id" id="jefeSelect" required>
                  <option value="">Selecciona el Jefe de Familia</option>                 
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
                      Fecha Nac.
                    </th>
                    <th>
                      Acciones
                    </th>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <select class="form-control" name="inputsNac[0]" id="inputsNac[0]">
                          <option value="V">V</option>   
                          <option value="E">E</option>       
                        </select>
                      </td>
                      <td>
                        <input type="text" class="form-control" placeholder="Cedula" name="inputsCed[0]" id="inputsCed[0]" required>
                      </td>
                      <td>  
                        <button type="button" class="nc-icon nc-zoom-split" style="border: none; background: none;" onclick="consultarced(0)"></button>
                      </td>
                      <td>
                        <input type="text" class="form-control" style="text-transform:uppercase;" placeholder="Nombres" name="inputsNombre[0]" id="inputsNombre[0]" required>   
                        <input type="hidden" name="pofa_estado[0]" id="pofa_estado[0]"/> 
                        <input type="hidden" name="pofa_municipio[0]" id="pofa_municipio[0]"/>    
                        <input type="hidden" name="pofa_parroquia[0]" id="pofa_parroquia[0]"/>     
                        <input type="hidden" name="pofa_centro[0]" id="pofa_centro[0]"/> 
                        <input type="hidden" name="pofa_tipo_reg[0]" id="pofa_tipo_reg[0]"/>  
                        <input type="hidden" name="pofa_usuario_creo[0]" id="pofa_usuario_creo[0]" value="{{ $usu }}"/>     
                      </td>                      
                      <td>
                        <input type="text" class="form-control" placeholder="Telefono" name="inputsTelefono[0]" required>
                      </td> 
                      <td>
                        <input type="date" class="form-control" placeholder="Fecha Nac" name="inputsFechaNac[0]" required>
                      </td> 
                      <td>
                        <button type="button" class="nc-icon nc-simple-add" style="border: none; background: none;" name="add" id="add"></button>
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
                        Jefe de Familia 
                      </th>
                    </thead>
                    <tbody>
                      @foreach ($poblacion_familias as $item)  
                            <tr>
                                <td> {{ $item->pofa_nac }}
                                </td>
                                <td> {{ $item->pofa_cedula }}
                                </td>
                                <td> {{ $item->pofa_nombres }}
                                </td>
                                <td> {{ $item->jfal_nombres }}
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
  const $selectOption = document.querySelector("#_municipios");   
  const $select = document.getElementById("_municipios").value;  
  if($select>1)
  {
    loadParroquias($selectOption);
  } 

  function consultarced(i)
  {
    var datosNac = document.getElementById("inputsNac["+i+"]").value;
    var datosCed = document.getElementById("inputsCed["+i+"]").value;
    
    fetch(`personaconsul/${datosNac}/${datosCed}/datosCNE`)
      .then( function (response) { 
        return response.json();
      })
      .then(function(jsonDataCNE){
        buildDataCNE(jsonDataCNE,i);
      })
  }

  function buildDataCNE(jsonDataCNE,i)
    {    
      if(jsonDataCNE.tipo=='OBJETADO')
      {
        alert("\nDebe Cargar los datos de la persona");
        document.getElementById("pofa_tipo_reg["+i+"]").value = jsonDataCNE.tipo;
      } 
      if(jsonDataCNE.tipo=='NO INSCRITO')
      {
        alert("\nDebe Cargar los datos de la persona");
        document.getElementById("pofa_tipo_reg["+i+"]").value = jsonDataCNE.tipo;
      } 
      if(jsonDataCNE.tipo=='INSCRITO')
      {
        let arrayNombres = jsonDataCNE.mensaje;
            let total = arrayNombres.length;
            if (total <= 3) {
              document.getElementById("inputsNombre["+i+"]").value = jsonDataCNE.mensaje[0]+ " " +jsonDataCNE.mensaje[1]+ " " +jsonDataCNE.mensaje[2];
              document.getElementById("pofa_estado["+i+"]").value = jsonDataCNE.estado;
              document.getElementById("pofa_municipio["+i+"]").value = jsonDataCNE.municipio;
              document.getElementById("pofa_parroquia["+i+"]").value = jsonDataCNE.parroquia;
              document.getElementById("pofa_centro["+i+"]").value = jsonDataCNE.centro;
              document.getElementById("pofa_tipo_reg["+i+"]").value = jsonDataCNE.tipo;
            } else {
              document.getElementById("inputsNombre["+i+"]").value = jsonDataCNE.mensaje[0]+ " " +jsonDataCNE.mensaje[1]+ " " +jsonDataCNE.mensaje[2]+ " " +jsonDataCNE.mensaje[3];
              document.getElementById("pofa_estado["+i+"]").value = jsonDataCNE.estado;
              document.getElementById("pofa_municipio["+i+"]").value = jsonDataCNE.municipio;
              document.getElementById("pofa_parroquia["+i+"]").value = jsonDataCNE.parroquia;
              document.getElementById("pofa_centro["+i+"]").value = jsonDataCNE.centro;
              document.getElementById("pofa_tipo_reg["+i+"]").value = jsonDataCNE.tipo;
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

    function loadJefes(calleSelect)
  {
    let calleiId = calleSelect.value;
    fetch(`calles/${calleiId}/jefes`)
      .then( function (response) { 
        return response.json();
      })

      .then(function(jsonData){
        buildJefesSelect(jsonData);
      })
    }

    function buildJefesSelect(jsonJefes)
    {
      let JefesSelect = document.getElementById('jefeSelect');
      /*clearSelectCalles(calleSelect); */
      jsonJefes.forEach(function (jefe) {
        let optionTag = document.createElement('option');
        optionTag.value = jefe.id;
        optionTag.innerHTML = jefe.jfal_nombres;
        jefeSelect.append(optionTag);
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
    
    var i = 0;
    $('#add').click(function(){
      ++i;
      $('#table').append(
        `<tr> 
          <td>
            <select class="form-control" name="inputsNac[`+i+`]" id="inputsNac[`+i+`]">
                          <option value="V">V</option>   
                          <option value="E">E</option>       
                        </select>
                      </td>
                      <td>
                        <input type="text" class="form-control" placeholder="Cedula"  name="inputsCed[`+i+`]" id="inputsCed[`+i+`]" required>
                      </td>
                      <td>                        
                        <button type="button" class="nc-icon nc-zoom-split" style="border: none; background: none;" onclick="consultarced(`+i+`)"></button>
                      </td>
                      <td>
                        <input type="text" class="form-control" placeholder="Nombres" name="inputsNombre[`+i+`]" id="inputsNombre[`+i+`]" required>
                        <input type="hidden" name="pofa_estado[`+i+`]" id="pofa_estado[`+i+`]"/>  
                        <input type="hidden" name="pofa_municipio[`+i+`]" id="pofa_municipio[`+i+`]"/>    
                        <input type="hidden" name="pofa_parroquia[`+i+`]" id="pofa_parroquia[`+i+`]"/>     
                        <input type="hidden" name="pofa_centro[`+i+`]" id="pofa_centro[`+i+`]"/> 
                        <input type="hidden" name="pofa_tipo_reg[`+i+`]" id="pofa_tipo_reg[`+i+`]"/>  
                        <input type="hidden" name="pofa_usuario_creo[`+i+`]" id="pofa_usuario_creo[`+i+`]" value="{{ $usu }}"/>          
                      </td>
                      <td>
                        <input type="text" class="form-control" placeholder="Telefono" name="inputsTelefono[`+i+`]" required>
                      </td>
                      <td>
                        <input type="date" class="form-control" placeholder="Fecha" name="inputsFechaNac[`+i+`]" required>
                      </td>
                      <td>
                        <button type="button" class="nc-icon nc-simple-remove remove-table-row" style="border: none; background: none;" name="add" id="add"></button>
                      </td>       
         </tr>`);
    });

    $(document).on('click','.remove-table-row', function(){
      $(this).parents('tr').remove();
    });

    
</script>

@endsection




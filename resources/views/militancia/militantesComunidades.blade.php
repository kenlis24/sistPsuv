@extends('layouts.template')

@section('contenido')
<div class="content">
<div class="row">
<div class="col-md-12">
    <div class="card card-user">
      <div class="card-header">
        <h5 class="card-title">Cargar Asistencia de Comunidades</h5>
      </div>
      <div class="card-body">
        <form method="post" action="{{ route('militancia.store') }}">
            {!! csrf_field() !!}
            @php
              $usu = auth()->user()->username;
            @endphp
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Municipios del estado Táchira</label>
                <input type="hidden" name="mil_tipo_nivel" id="mil_tipo_nivel" value="comunidades"/>
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
                <select class="form-control" name="mil_id" id="comunSelect" required>
                  <option value="">Selecciona la comunidad</option>                  
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Eventos</label>
                <select class="form-control" name="mil_eve_id" id="mil_eve_id" required>
                  <option value="">Selecciona la Evento</option>
                  @foreach ($reuniones as $item)
                    <option value="{{ $item->id }}">{{ $item->eve_nombre }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Fecha</label>
                    <input type="date" class="form-control" name="mil_fecha" id="mil_fecha" required>
                </div>
            </div>
          </div>   
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Lugar</label>
                <textarea cols="50" rows="2" class="form-control" name="mil_lugar" placeholder="Lugar" required></textarea>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <button type="button" class="btn btn-primary btn-round background: none;"  name="consultar" id="consultar" onclick="consultarLista()">Consultar lista</button>
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
                        <input type="hidden" name="mil_mun_usua[0]" id="mil_mun_usua[0]"/>  
                        <input type="hidden" name="mil_estado_usua[0]" id="mil_estado_usua[0]"/>   
                        <input type="hidden" name="mil_parr_usua[0]" id="mil_parr_usua[0]"/>     
                        <input type="hidden" name="mil_centro_usua[0]" id="mil_centro_usua[0]"/> 
                        <input type="hidden" name="mil_tipo_reg[0]" id="mil_tipo_reg[0]"/>  
                        <input type="hidden" name="mil_usua_crea[0]" id="mil_usua_crea[0]" value="{{ $usu }}"/>   
                        <input type="hidden" name="inputsApellido[0]" id="inputsApellido[0]" value=""/>        
                      </td>                      
                      <td>
                        <input type="text" class="form-control" placeholder="Telefono" name="inputsTelefono[0]" required>
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
    
    fetch(`personaconsullocal/${datosNac}/${datosCed}/datosCNE`)
      .then( function (response) { 
        return response.json();
      })
      .then(function(jsonDataCNE){
        buildDataCNE(jsonDataCNE,i);
      })
  }

  function consultarLista()
  {
    var fecha = document.getElementById("mil_fecha").value;
    var evento = document.getElementById("mil_eve_id").value;
    var comun = document.getElementById("comunSelect").value;
    var pag = 'comunidades';
    
    fetch(`tableMilitancia/${comun}/${fecha}/${evento}/${pag}/militanciaUBCH`)
      .then( function (response) { 
        return response.json();       
        //console.log('Value : ' + response.json());
      })
      .then(function(jsonDataLista){
        buildDataLista(jsonDataLista);        
      })
  }

  function buildDataLista(jsonDataLista)
    { 
      console.log(jsonDataLista);
      jsonDataLista.forEach(function (lista) {   
        if(lista.mil_apellidos==null) 
        {
          nombre = lista.mil_nombres;
        }
        else
        {
          nombre = lista.mil_nombres+` `+lista.mil_apellidos;
        }
        $('#tableLista').append(
        `<tr> 
          <td> `+lista.mil_nac+` </td>  
          <td> `+lista.mil_cedula+` </td>  
          <td> `+nombre+` </td>     
          <td> `+lista.mil_telefono+` </td>      
         </tr>`);
      });
    }

  function buildDataCNE(jsonDataCNE,i)
    {    
      if(jsonDataCNE.tipo=='OBJETADO')
      {
        alert("\nDebe Cargar los datos de la persona");
        document.getElementById("mil_tipo_reg["+i+"]").value = jsonDataCNE.tipo;
      } 
      if(jsonDataCNE.tipo=='NO INSCRITO')
      {
        alert("\nDebe Cargar los datos de la persona");
        document.getElementById("mil_tipo_reg["+i+"]").value = jsonDataCNE.tipo;
      } 
      if(jsonDataCNE.tipo=='INSCRITO')
      {
        let arrayNombres = jsonDataCNE.mensaje;
            let total = arrayNombres.length;
            if (total <= 3) {
              document.getElementById("inputsNombre["+i+"]").value = jsonDataCNE.mensaje[0]+ " " +jsonDataCNE.mensaje[1]+ " " +jsonDataCNE.mensaje[2];
              document.getElementById("mil_estado_usua["+i+"]").value = jsonDataCNE.estado;
              document.getElementById("mil_mun_usua["+i+"]").value = jsonDataCNE.municipio;
              document.getElementById("mil_parr_usua["+i+"]").value = jsonDataCNE.parroquia;
              document.getElementById("mil_centro_usua["+i+"]").value = jsonDataCNE.centro;
              document.getElementById("mil_tipo_reg["+i+"]").value = jsonDataCNE.tipo;
            } else {
              document.getElementById("inputsNombre["+i+"]").value = jsonDataCNE.mensaje[0]+ " " +jsonDataCNE.mensaje[1]+ " " +jsonDataCNE.mensaje[2]+ " " +jsonDataCNE.mensaje[3];
              document.getElementById("mil_estado_usua["+i+"]").value = jsonDataCNE.estado;
              document.getElementById("mil_mun_usua["+i+"]").value = jsonDataCNE.municipio;
              document.getElementById("mil_parr_usua["+i+"]").value = jsonDataCNE.parroquia;
              document.getElementById("mil_centro_usua["+i+"]").value = jsonDataCNE.centro;
              document.getElementById("mil_tipo_reg["+i+"]").value = jsonDataCNE.tipo;
            }   
            console.log(jsonDataCNE);
      }  
      if(jsonDataCNE.tipo=='INSCRITO CNE')
      {
        let arrayNombres = jsonDataCNE.mensaje;
              document.getElementById("inputsNombre["+i+"]").value = jsonDataCNE.mensaje;
              document.getElementById("mil_estado_usua["+i+"]").value = jsonDataCNE.estado;
              document.getElementById("mil_mun_usua["+i+"]").value = jsonDataCNE.municipio;
              document.getElementById("mil_parr_usua["+i+"]").value = jsonDataCNE.parroquia;
              document.getElementById("mil_centro_usua["+i+"]").value = jsonDataCNE.centro;
              document.getElementById("mil_tipo_reg["+i+"]").value = jsonDataCNE.tipo;              
            console.log(jsonDataCNE);
      }
      if(jsonDataCNE.tipo=='NO ESTA')
      {
         alert("\nPersona no registrada en el CNE debe cargar lo datos");
         document.getElementById("inputsNombre["+i+"]").value = '';
              document.getElementById("mil_estado_usua["+i+"]").value = '';
              document.getElementById("mil_mun_usua["+i+"]").value = '';
              document.getElementById("mil_parr_usua["+i+"]").value = '';
              document.getElementById("mil_centro_usua["+i+"]").value = '';  
              document.getElementById("mil_tipo_reg["+i+"]").value = '';   
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
      jsonComun.forEach(function (comun) {
        let optionTag = document.createElement('option');
        optionTag.value = comun.id;
        optionTag.innerHTML = comun.com_nombre;
        comunSelect.append(optionTag);
      });
    }

    function buildUBCHSelect(jsonUBCH)
    {
      let UBCHSelect = document.getElementById('ubchSelect');
      clearSelectUBCH(ubchSelect);
      clearSelectComunindades(comunSelect);
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
                        <input type="hidden" name="mil_mun_usua[`+i+`]" id="mil_mun_usua[`+i+`]"/>  
                        <input type="hidden" name="mil_estado_usua[`+i+`]" id="mil_estado_usua[`+i+`]"/>    
                        <input type="hidden" name="mil_parr_usua[`+i+`]" id="mil_parr_usua[`+i+`]"/>     
                        <input type="hidden" name="mil_centro_usua[`+i+`]" id="mil_centro_usua[`+i+`]"/> 
                        <input type="hidden" name="mil_tipo_reg[`+i+`]" id="mil_tipo_reg[`+i+`]"/>  
                        <input type="hidden" name="mil_usua_crea[`+i+`]" id="mil_usua_crea[`+i+`]" value="{{ $usu }}"/>  
                        <input type="hidden" name="inputsApellido[`+i+`]" id="inputsApellido[`+i+`]" value=""/>         
                      </td>
                      <td>
                        <input type="text" class="form-control" placeholder="Telefono" name="inputsTelefono[`+i+`]" required>
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




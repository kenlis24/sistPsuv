@extends('layouts.template')

@section('contenido')
<div class="content">
<div class="row">
<div class="col-md-12">
    <div class="card card-user">
      <div class="card-header">
        <h5 class="card-title">Cargar personas</h5>
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
                <select class="form-control" name="mil_id" id="ubchSelect">  
                  <option value="">Selecciona la UBCH</option>       
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Eventos</label>
                <select class="form-control" name="mil_eve_id">
                  <option value="">Selecciona el evento</option>
                  @foreach ($reuniones as $item)
                    <option value="{{ $item->id }}">{{ $item->eve_nombre }}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Fecha</label>
                <input type="date" class="form-control" name="mil_fecha">
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
                      Nombres
                    </th>
                    <th>
                      Apellidos
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
                          <option value="">--</option>
                          <option value="V">V</option>   
                          <option value="E">E</option>       
                        </select>
                      </td>
                      <td>
                        <input type="text" class="form-control" placeholder="Cedula" name="inputsCed[0]" id="inputsCed[0]">
                      </td>
                      <td>  
                        <button type="button" class="nc-icon nc-zoom-split" style="border: none; background: none;" onclick="consultarced(0)"></button>
                      </td>
                      <td>
                        <input type="text" class="form-control" style="text-transform:uppercase;" placeholder="Nombres" name="inputsNombre[0]" id="inputsNombre[0]">   
                        <input type="hidden" name="mil_mun_usua[0]" id="mil_mun_usua[0]"/>    
                        <input type="hidden" name="mil_parr_usua[0]" id="mil_parr_usua[0]"/>     
                        <input type="hidden" name="mil_centro_usua[0]" id="mil_centro_usua[0]"/> 
                        <input type="hidden" name="mil_tipo_reg[0]" id="mil_tipo_reg[0]"/>  
                        <input type="hidden" name="mil_usua_crea[0]" id="mil_usua_crea[0]" value="{{ $usu }}"/>          
                      </td>                      
                      <td>
                        <input type="text" class="form-control" style="text-transform:uppercase;" placeholder="Apellidos" name="inputsApellido[0]" id="inputsApellido[0]">
                      </td> 
                      <td>
                        <input type="text" class="form-control" placeholder="Telefono" name="inputsTelefono[0]">
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
        </form>
      </div>
    </div>
</div>
</div>
</div>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>

<script>
  const $select = document.querySelector("#_municipios");
  loadParroquias($select);

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
        alert(jsonDataCNE.mensaje+"\nDebe Cargar los datos de la persona");
      } 
      if(jsonDataCNE.tipo=='NO INSCRITO')
      {
        alert(jsonDataCNE.mensaje+"\nDebe Cargar los datos de la persona");
      } 
      if(jsonDataCNE.tipo=='INSCRITO')
      {
        let arrayNombres = jsonDataCNE.mensaje;
            let total = arrayNombres.length;
            if (total <= 3) {
              document.getElementById("inputsNombre["+i+"]").value = jsonDataCNE.mensaje[0];
              document.getElementById("inputsApellido["+i+"]").value = jsonDataCNE.mensaje[1]+ " " +jsonDataCNE.mensaje[2];
              document.getElementById("mil_mun_usua["+i+"]").value = jsonDataCNE.municipio;
              document.getElementById("mil_parr_usua["+i+"]").value = jsonDataCNE.parroquia;
              document.getElementById("mil_centro_usua["+i+"]").value = jsonDataCNE.centro;
              document.getElementById("mil_tipo_reg["+i+"]").value = jsonDataCNE.tipo;
            } else {
              document.getElementById("inputsNombre["+i+"]").value = jsonDataCNE.mensaje[0]+ " " +jsonDataCNE.mensaje[1];
              document.getElementById("inputsApellido["+i+"]").value = jsonDataCNE.mensaje[2]+ " " +jsonDataCNE.mensaje[3];
              document.getElementById("mil_mun_usua["+i+"]").value = jsonDataCNE.municipio;
              document.getElementById("mil_parr_usua["+i+"]").value = jsonDataCNE.parroquia;
              document.getElementById("mil_centro_usua["+i+"]").value = jsonDataCNE.centro;
              document.getElementById("mil_tipo_reg["+i+"]").value = jsonDataCNE.tipo;
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

    function clearSelectUBCH(select)
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
                          <option value="">--</option>
                          <option value="V">V</option>   
                          <option value="E">E</option>       
                        </select>
                      </td>
                      <td>
                        <input type="text" class="form-control" placeholder="Cedula"  name="inputsCed[`+i+`]" id="inputsCed[`+i+`]">
                      </td>
                      <td>                        
                        <button type="button" class="nc-icon nc-zoom-split" style="border: none; background: none;" onclick="consultarced(`+i+`)"></button>
                      </td>
                      <td>
                        <input type="text" class="form-control" placeholder="Nombres" name="inputsNombre[`+i+`]" id="inputsNombre[`+i+`]">
                        <input type="hidden" name="mil_mun_usua[`+i+`]" id="mil_mun_usua[`+i+`]"/>    
                        <input type="hidden" name="mil_parr_usua[`+i+`]" id="mil_parr_usua[`+i+`]"/>     
                        <input type="hidden" name="mil_centro_usua[`+i+`]" id="mil_centro_usua[`+i+`]"/> 
                        <input type="hidden" name="mil_tipo_reg[`+i+`]" id="mil_tipo_reg[`+i+`]"/>  
                        <input type="hidden" name="mil_usua_crea[`+i+`]" id="mil_usua_crea[`+i+`]" value="{{ $usu }}"/>          
                      </td>
                      <td>
                        <input type="text" class="form-control" placeholder="Apellidos" name="inputsApellido[`+i+`]" id="inputsApellido[`+i+`]">
                      </td> 
                      <td>
                        <input type="text" class="form-control" placeholder="Telefono" name="inputsTelefono[`+i+`]">
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




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
        <form action="">
            {!! csrf_field() !!}
          <div class="row">
            <div class="col-md-6">
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
                <select class="form-control" name="UBCH_id" id="ubchSelect">  
                  <option value="">Selecciona la UBCH</option>       
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Eventos</label>
                <select class="form-control" name="evento_id">
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
                      Nombres
                    </th>
                    <th>
                      Apellidos
                    </th>
                    <th>
                      Acciones
                    </th>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <select class="form-control" name="mil_nac">
                          <option value="">--</option>
                          <option value="V">V</option>   
                          <option value="E">E</option>       
                        </select>
                      </td>
                      <td>
                        <input type="text" class="form-control" placeholder="Cedula" name="inputs[0]['mil_cedula']">
                      </td>
                      <td>
                        <input type="text" class="form-control" placeholder="Nombres" name="mil_nombres">
                      </td>
                      <td>
                        <input type="text" class="form-control" placeholder="Apellidos" name="mil_apellidos">
                      </td> 
                      <td>
                        <button type="submit" class="btn btn-primary btn-round" name="add" id="add">Agregar</button>
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
 /* function loadParroquias(selectMunicipios)
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
    }  */

    
    var i = 0;
    $('#add').click(function(){
      ++i;
      $('#table').append(
        `<tr> 
          <td>
                      </td>
                      <td>
                        
                      </td>
                      <td>
                        
                      </td>
                      <td>
                        
                      </td> 
                      <td>
                        <button type="submit" class="btn btn-danger btn-round" name="add" id="add">Eliminar</button>
                      </td>       
         </tr>`);
    });
</script>

@endsection




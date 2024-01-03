@extends('layouts.template')

@section('contenido')
<div class="content">
<div class="row">
<div class="col-md-12">
    <div class="card card-user">
      <div class="card-header">
        <h5 class="card-title">Consultar Militantes</h5>
      </div>
      <div class="card-body">
        <form method="post" action="">
            {!! csrf_field() !!}
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label>Nacionalidad</label>
                  <select class="form-control" name="nac" id="nac">
                    <option value="V">V</option>   
                    <option value="E">E</option>       
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                  <div class="form-group">
                      <label>Cedula</label>
                      <input type="text" class="form-control" placeholder="Cedula" name="ced" id="ced" required>
                  </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <br>
                  <button type="button" class="btn btn-primary btn-round background: none;"  name="consultar" id="consultar" onclick="consultarDatos()">Consultar</button>
                </div>
              </div>
            </div> 
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <div id="NombrePer"></div>                  
                </div>
              </div>
            </div> 
            <table class="table table-striped table-bordered nowrap" style="width:100%">
              <thead class=" text-primary">
                <th>
                  Evento
                </th>
                <th>
                  Fecha
                </th>
                <th>
                  Nivel
                </th>
                <th>
                  Tipo
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
        </form>
      </div>
    </div>
</div>
</div>

</div>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>

<script>
  function consultarDatos()
  {
    var nac = document.getElementById("nac").value;
    var ced = document.getElementById("ced").value;
    
    fetch(`/reporteMilitancia/${nac}/${ced}/datos`)
      .then( function (response) { 
        return response.json();       
        //console.log('Value : ' + response.json());
      })
      .then(function(jsonData){
        buildData(jsonData);        
      })
  }

  function buildData(jsonData)
    { 
      clearData();
      console.log(jsonData);
      sw = 0;
      jsonData.forEach(function (lista) {   
        if(lista.apellidos==null) 
        {
          nombre = lista.nombres;
          sw = sw + 1;
        }
        else
        {
          nombre = lista.nombres+` `+lista.apellidos;
          sw = sw + 1;
        }
        if(sw==1)
        {
          $('#NombrePer').append(
          `<div> <strong>Nombre: </strong>`+lista.nombres+`    
          </div>`);
        }
        $('#tableLista').append(
        `<tr> 
          <td> `+lista.evento+` </td>  
          <td> `+lista.fecha+` </td>  
          <td> `+lista.nivel+` </td>     
          <td> `+lista.tipo+` </td>      
         </tr>`);
      });
    }

    function clearData()
    {
      document.getElementById("NombrePer").innerHTML = ""; 
      document.getElementById("tableLista").innerHTML = ""; 
    }
</script>

@endsection




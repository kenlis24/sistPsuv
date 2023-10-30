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
                        <button type="button" class="nc-icon nc-simple-add" style="border: none; background: none;" name="add" id="add"></button>
                      </td>                     
                    </tr>  
                  </tbody>
                </table>
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



@endsection




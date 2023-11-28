@extends('layouts.template')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
@endsection

@section('contenido')

    <div class="content">

            <div class="card">
              <div class="card-header">
                <a href="{{ route('sectores.create') }}" class="btn btn-primary btn-round">Asociar Estado con Sector</a>                
                <h4 class="card-title">Lista de Usuarios con sectores</h4>
              </div>
              <div class="card-body">
                @if(session("mensaje"))
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <h5 class="card-title">{{session('mensaje')}}</h5>
                    </div>
                  </div>
                </div>
               @endif
                <div class="table-responsive">
                  <table class="table table-striped table-bordered nowrap" id="usuarios" style="width:100%">
                    <thead class=" text-primary">
                      <th>
                        Usuario
                      </th>
                      <th>
                        Sector
                      </th>
                      <th>
                        Estado
                      </th>
                      <th class="text-center">
                        Acciones
                      </th>
                    </thead>
                    <tbody>
                        @foreach ($users_sectores as $item)                            
                       
                            <tr>
                                <td>
                                    {{ $item->name }}
                                </td>
                                <td>
                                    {{ $item->sec_nombre }}
                                </td>
                                <td>
                                    {{ $item->usec_estado }}
                                </td>                              
                                <td class="text-right">
                                 
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

    </div>


<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap4.min.js"></script>
    <script>      
      $(document).ready(function () {
        new DataTable('#usuarios', {
            responsive: true
        });
      });        
    </script>


@endsection


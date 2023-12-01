@extends('layouts.template')

@section('css')    
    <link rel="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css">
    <link rel="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap4.min.css">
@endsection

@section('contenido')

    <div class="content">

            <div class="card">
              <div class="card-header">
                <a href="{{ route('users.create') }}" class="btn btn-primary btn-round">Nuevo Usuario</a>                
                <h4 class="card-title">Lista de Usuarios</h4>
              </div>
              <div class="card-body">
                <div class="container">
                  <div class="row">
                    <div class="col-12">
                <div class="data_table">
                  <table class="table table-striped table-bordered" style="width:100%" id="usuarios">
                    <thead class=" text-primary">
                      <th>
                        Nombre
                      </th>
                      <th>
                        Correo
                      </th>
                      <th>
                        Nobre de usuario
                      </th>
                      <th>
                        Municipio
                      </th>
                      <th class="text-center">
                        Acciones
                      </th>
                    </thead>
                    <tbody>
                        @foreach ($users as $item)                            
                       
                            <tr>
                                <td>
                                    {{ $item->name }}
                                </td>
                                <td>
                                    {{ $item->email }}
                                </td>
                                <td>
                                    {{ $item->username }}
                                </td>   
                                <td>
                                  {{ $item->mun_nombre }}
                              </td>                               
                                <td class="text-right">
                                    <a href="{{ route('users.edit',$item->id) }}" class="btn btn-success btn-round">Editar</a>                                     
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
            </div>

    </div>
   

   
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.colVis.min.js"></script>

    
    <script>      
      $(document).ready(function () {
        new DataTable('#usuarios', {
            responsive: true,
            lengthChange: false,
            buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
        });

        table.buttons().container()
              .appendTo( '#usuarios_wrapper .col-md-6:eq(0)' );
      });  
      
      /*$(document).ready(function() {
          var table = $('#usuarios').DataTable( {
              lengthChange: false,
              buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
          } );
      
          table.buttons().container()
              .appendTo( '#usuarios_wrapper .col-md-6:eq(0)' );
      } );*/
    </script>


@endsection


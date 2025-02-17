@extends('layouts.template')

@section('css')    
    <link rel="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css">
    <link rel="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap4.min.css">
@endsection

@section('contenido')

    <div class="content">

            <div class="card">
              <div class="card-header">               
                <h4 class="card-title">Lista de Calles</h4>
              </div>
              <div class="card-body">
                <div class="container">
                  <div class="row">
                    <div class="col-12">
                <div class="data_table">
                  <table class="table table-striped table-bordered" style="width:100%" id="usuarios">
                    <thead class=" text-primary">
                      <th>
                        Parroquia
                      </th>
                      <th>
                        UBCH
                      </th>
                      <th>
                        Comunidad
                      </th>
                      <th>
                        Calle
                      </th>
                      <th class="text-center">
                        Acciones
                      </th>
                    </thead>
                    <tbody>
                        @foreach ($lista as $item)                            
                       
                            <tr>
                                <td>
                                    {{ $item->par_nombre }}
                                </td> 
                                <td>
                                    {{ $item->agr_nombre }}
                                </td>  
                                <td>
                                    {{ $item->com_nombre }}
                                </td>  
                                <td>
                                    {{ $item->cal_nombre }}
                                </td>                                            
                                <td class="text-right">
                                    <a href="{{ route('calles.edit',$item->id) }}" class="btn btn-primary btn-round btn-xs" >Editar</a>       
                                    <form class="miFormulario" action="{{ route('calles.destroy',['id' => $item->id]) }}">
                                      @method("DELETE")
                                        @csrf
                                      <!-- Otros campos del formulario anidado -->
                                      
                                      <button type="submit" id="botonmiFormulario" class="btn btn-danger btn-round btn-xs">Eliminar</button>
                                  </form>                                                             
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
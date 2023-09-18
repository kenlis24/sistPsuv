@extends('layouts.template')

@section('contenido')

    <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                @if (auth()->user()->username=='administrador')
                <a href="{{ route('reuniones.create') }}" class="btn btn-primary btn-round">Nuevo Evento</a>
                @endif                
                <h4 class="card-title">Lista de Eventos</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th>
                        Evento
                      </th>
                      <th>
                        Tipo
                      </th>
                      <th>
                        Estado
                      </th>
                    </thead>
                    <tbody>
                        @foreach ($reuniones as $item)                         
                       
                            <tr>
                                <td>
                                    {{ $item->eve_nombre }}
                                </td>
                                <td> 
                                  @if($item->reu_tipo=='1')
                                    Municipio    
                                  @endif    
                                  @if($item->reu_tipo=='2')
                                    Parroquia     
                                  @endif
                                  @if($item->reu_tipo=='3')
                                    UBCH     
                                  @endif
                                  @if($item->reu_tipo=='4')
                                    Comunidad    
                                  @endif
                                  @if($item->reu_tipo=='5')
                                    Calle    
                                  @endif                                                                
                                </td>  
                                <td>
                                  @if($item->reu_estado=='A')
                                    Activo   
                                  @endif  
                                  @if($item->reu_estado=='I')
                                    Inacctivo   
                                  @endif 
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
    </div>

@endsection
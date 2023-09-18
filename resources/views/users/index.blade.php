@extends('layouts.template')

@section('contenido')

    <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <a href="{{ route('users.create') }}" class="btn btn-primary btn-round">Nuevo Usuario</a>                
                <h4 class="card-title">Lista de Usuarios</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
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

@endsection
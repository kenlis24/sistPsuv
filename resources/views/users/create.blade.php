@extends('layouts.template')

@section('contenido')
<div class="content">
<div class="row">
<div class="col-md-12">
    <div class="card card-user">
      <div class="card-header">
        <h5 class="card-title">Crear Usuario</h5>
      </div>
      <div class="card-body">
        <form method="post" action="{{ route('users.store') }}">
            {!! csrf_field() !!}
          <div class="row">            
            <div class="col-md-6">
              <div class="form-group">                
                <label>Nombre de usuario</label>
                <input type="text" class="form-control" placeholder="Nombre de usuario" name="username">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="exampleInputEmail1">Correo</label>
                <input type="email" class="form-control" placeholder="Correo" name="email">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Nombres y Apellidos</label>
                <input type="text" class="form-control" placeholder="Nombres y Apellidos" name="name">
              </div>
            </div>
          </div>
          <div class="row">            
            <div class="col-md-6">
              <div class="form-group">
                <label>Contraseña</label>
                <input type="password" class="form-control" placeholder="Contraseña" name="password">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="exampleInputEmail1">Confirmar Contraseña</label>
                <input type="password" class="form-control" placeholder="Confirmar Contraseña" name="password_confirmation">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Municipios del estado Táchira</label>
                <select name="usu_mun_id" class="form-control">
                  <option value="">Selecciona el municipio</option>
                  @foreach ($municipios as $item)
                    <option value="{{ $item->id }}">{{ $item->mun_nombre }}</option>
                  @endforeach
                </select>
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
@endsection
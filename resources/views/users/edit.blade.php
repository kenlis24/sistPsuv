@extends('layouts.template')

@section('contenido')
<div class="content">
<div class="row">
<div class="col-md-12">
    <div class="card card-user">
      <div class="card-header">
        <h5 class="card-title">Editar Usuario</h5>
      </div>
      <div class="card-body">
        <form method="post" action="{{ route('users.update',$users->id) }}">
            {!! csrf_field() !!}
            @method("PUT")
          <div class="row">            
            <div class="col-md-6">
              <div class="form-group">
                <input type="hidden" name="id" id="id" value="{{$users->id}}"/>
                <label>Nombre de usuario</label>
                <input type="text" disabled class="form-control" value="{{$users->username}}" placeholder="Nombre de usuario" name="username">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="exampleInputEmail1">Correo</label>
                <input type="email" class="form-control" placeholder="Correo" name="email" value="{{$users->email}}">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Nombres y Apellidos</label>
                <input type="text" class="form-control" placeholder="Nombres y Apellidos" name="name" value="{{$users->name}}">
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
            <div class="update ml-auto mr-auto">
              <button type="submit" class="btn btn-primary btn-round">Modificar</button>
            </div>
          </div>
        </form>
      </div>
    </div>
</div>
</div>
</div>
@endsection
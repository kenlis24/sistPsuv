@extends('layouts.template')

@section('contenido')
<div class="content">
<div class="row">
<div class="col-md-12">
    <div class="card card-user">
      <div class="card-header">
        <h5 class="card-title">Crear Asociación de Usuario a un Sector</h5>
      </div>
      <div class="card-body">
        <form method="post" action="{{ route('sectores.store') }}">
            {!! csrf_field() !!}
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Usuarios</label>
                <select name="usec_use_id" class="form-control">
                  <option value="">Selecciona el usuarios</option>
                  @foreach ($users as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Sectores</label>
                <select name="usec_sec_id" class="form-control">
                  <option value="">Selecciona el sector</option>
                  @foreach ($sectores as $item)
                    <option value="{{ $item->id }}">{{ $item->sec_nombre }}</option>
                  @endforeach
                </select>
                <input type="hidden" name="usec_estado" id="usec_estado" value="A"/> 
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
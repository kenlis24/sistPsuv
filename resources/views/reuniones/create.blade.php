@extends('layouts.template')

@section('contenido')
<div class="content">
<div class="row">
<div class="col-md-12">
    <div class="card card-user">
      <div class="card-header">
        <h5 class="card-title">Crear Eventos</h5>
      </div>
      <div class="card-body">
        <form method="post" action="{{ route('reuniones.store') }}">
            {!! csrf_field() !!}
            <input type="hidden" name="reu_estado" id="reu_estado" value="A"/>
          <div class="row">   
            <div class="col-md-12">
              <div class="form-group">
                <label for="exampleInputEmail1">Evento</label>
                <select class="form-control" name="reu_eve_id">
                  <option value="">Selecciona el evento</option>
                  @foreach ($eventos as $itemeventos)
                    <option value="{{ $itemeventos->id }}">{{ $itemeventos->eve_nombre }}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          <div class="row">   
            <div class="col-md-12">
              <div class="form-group">
                <label for="exampleInputEmail1">Nivel</label>
                <select class="form-control" name="reu_tipo">
                  <option value="">Seleccione</option>
                  <option value="1">Municipio</option>   
                  <option value="2">Parroquia</option>
                  <option value="3">UBCH</option>
                  <option value="4">Comunidad</option>       
                  <option value="5">Calle</option>        
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Observación</label>
                <textarea class="form-control textarea" name="reu_observacion"></textarea>
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
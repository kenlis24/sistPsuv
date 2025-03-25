@extends('layouts.template')

@section('contenido')
<div class="content">
<div class="row">
<div class="col-md-12">
    <div class="card card-user">
      <div class="card-header">
        <h5 class="card-title">Editar Comunidad</h5>
      </div>
      <div class="card-body">
        <form method="post" action="{{ route('comunidades.update',$comunidades->id) }}">
            {!! csrf_field() !!}
            @method("PUT")
          <div class="row">            
            <div class="col-md-12">
              <div class="form-group">
                <input type="hidden" name="id" id="id" value="{{$comunidades->id}}"/>
                <label>Nombre de la comunidad</label>
                <input type="text" class="form-control" value="{{$comunidades->com_nombre}}" placeholder="Nombre de la comunidad" name="com_nombre">
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
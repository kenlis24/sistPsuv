@extends('layouts.auth-master')

@section('content')

    <form method="post" action="{{ route('login.perform') }}">
        <br>    
           
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <img class="mb-4" src="{!! url('assets/img/logoInicio3.jpeg') !!}" alt="" width="200" height="200">
        <br>
        <h1 class="navbar-brand">Inicio de sesión</h1>

        @include('layouts.partials.messages')
        <div class="row">
            <div class="col-md-4 px-1">
            </div>
            <div class="col-md-4 px-1">
                <input type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Nombre de usuario" required="required" autofocus>
                <label>Correo o nombre de usuario</label>
                @if ($errors->has('username'))
                    <span class="text-danger text-left">{{ $errors->first('username') }}</span>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 px-1">
            </div>
            <div class="col-md-4 px-1">
                <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Contraseña" required="required">
                <label>Contraseña</label>
                @if ($errors->has('password'))
                    <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                @endif
            </div>
        </div>
        <button class="btn btn-primary btn-round" type="submit">Iniciar</button>
        <br> 
        <!-- <a href="{{ route('poblacion.centrosVotacion') }}" class="btn btn-primary btn-round">Lugar Asamblea de Postulación</a> -->
        @include('auth.partials.copy')
    </form>
@endsection
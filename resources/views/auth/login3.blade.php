@extends('layouts.auth-master')

@section('content')

    <form method="post" action="{{ route('login.perform') }}">
        <br>    
           
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <img class="mb-4" src="{!! url('assets/img/inactivo.jpeg') !!}" alt="" width="300" height="300">
        <br>
        <br>
        <br>
        <br>
        <br>
    </form>
@endsection
@extends('layout.template')
@section('title') Bienvenido a {{env('APP_NAME')}} @endsection

@section('content')
    @if(Auth::check())
        @include('layout.includes.home')
    @else
        @include('layout.includes.login')
    @endif
@endsection

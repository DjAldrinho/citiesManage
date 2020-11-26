@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        <h2>Bienvenido, {{Auth::user()->name}}</h2>

                        <ul>
                            <li>
                                <a href="{{url('clients/')}}">Listar Clientes</a>
                            </li>
                            <li>
                                <a href="{{url('cities/')}}">Listar Ciudades</a>
                            </li>
                            @if(Auth::user()->id === 1)
                                <li>
                                    <a href="{{url('users/')}}">Listar Usuarios</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

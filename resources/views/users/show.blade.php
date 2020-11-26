@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card">
                    <div class="card-header">
                        Informacion de {{$user->name}}
                    </div>
                    <div class="card-body">
                        <p>
                            Nombre: {{$user->name}}
                        </p>
                        <p>
                            Email: {{$user->email}}
                        </p>
                        <p>
                            Creado: {{$user->created_at->toFormattedDateString()}}
                        </p>
                        <p>
                            Actualizado: {{$user->updated_at->toFormattedDateString()}}
                        </p>
                        <p>
                            <a href="{{url('users/')}}" class="btn btn-primary">
                                Listar Usuarios
                            </a>
                            <a href="{{route('home')}}" class="btn btn-light">
                                Ir a Home
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

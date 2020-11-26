@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card">
                    <div class="card-header">
                        Informacion de {{$city->name}}
                    </div>
                    <div class="card-body">
                        <p>
                            Nombre: {{$city->name}}
                        </p>
                        <br>
                        <div>
                            Clientes: <br>
                            <ul>
                                @foreach($city->clients as $client)
                                    <li>{{$client->name}}</li>
                                @endforeach
                            </ul>

                        </div>
                        <p>
                            <a href="{{url('cities/')}}" class="btn btn-primary">
                                Listar Ciudades
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

@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card">
                    <div class="card-header">
                        Informacion de {{$client->name}}
                    </div>
                    <div class="card-body">
                        <p>
                            Code: {{$client->code}}
                        </p>
                        <p>
                            Name: {{$client->name}}
                        </p>
                        <p>
                            City: {{$client->city->name}}
                        </p>
                        <p>
                            <a href="{{url('clients/')}}" class="btn btn-primary">
                                Listar Clientes
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

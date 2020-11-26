@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card">
                    <div class="card-header">
                        Clientes
                    </div>
                    <div class="card-body">
                        <form method="GET">
                            <div class="row justify-content-between mb-4">
                                <div class="d-flex justify-content-start">
                                    <a href="{{url('clients/create')}}" class="btn btn-success">Agregar cliente</a>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <div>
                                        <input type="search" name="city" id="search" class="form-control"
                                               placeholder="Buscar por ciudad" value="{{$filter}}">
                                    </div>
                                    <div class=" pl-1">
                                        <button class="btn btn-primary" type="submit">
                                            Buscar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="row p-2">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Ciudad</th>
                                    <th colspan=2></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($clients as $client)
                                    <tr>
                                        <td>{{$client->id}}</td>
                                        <td>
                                            <a href="{{ route('clients.show',$client->id)}}"
                                               class="btn-link">{{$client->name}}</a>
                                        </td>
                                        <td>{{$client->city->name}}</td>
                                        <td>
                                            <a href="{{ route('clients.edit',$client->id)}}"
                                               class="btn btn-primary">Editar</a>
                                        </td>
                                        <td>
                                            <form action="{{ route('clients.destroy', $client->id)}}"
                                                  method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger" type="submit">Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex align-items-middle justify-content-between">
                            <div class="col-8 text-left">
                                {{$clients->appends(['city' => $filter])->links()}}
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{route('home')}}" class="btn btn-primary">Ir a Home</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

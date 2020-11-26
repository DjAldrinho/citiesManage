@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card">
                    <div class="card-header">
                        Ciudades
                    </div>
                    <div class="card-body">
                        <div class="row p-2">
                            <div class="d-flex justify-content-start mb-4">
                                <a href="{{url('cities/create')}}" class="btn btn-success">
                                    <i class="fa fa-plus"></i>Agregar ciudad</a>
                            </div>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Clientes</th>
                                    <th colspan="2"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($cities as $city)
                                    <tr>
                                        <td>{{$city->id}}</td>
                                        <td>
                                            <a href="{{ route('cities.show',$city->id)}}"
                                               class="btn-link">{{$city->name}}</a>
                                        </td>
                                        <td>{{count($city->clients)}}</td>
                                        <td colspan="2" class="d-flex align-items-center justify-content-center">
                                            <a href="{{ route('cities.edit',$city->id)}}"
                                               class="btn btn-primary">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <form action="{{ route('cities.destroy', $city->id)}}"
                                                  method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger" type="submit">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex align-items-middle justify-content-between">
                            @if(count($cities) > 10)
                                <div class="col-8 text-left">
                                    {{$cities->links()}}
                                </div>
                            @endif
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

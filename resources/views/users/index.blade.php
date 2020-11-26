@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card">
                    <div class="card-header">
                        Usuarios
                    </div>
                    <div class="card-body">
                        <div class="row p-2">
                            <div class="d-flex justify-content-start mb-4">
                                <a href="{{url('users/create')}}" class="btn btn-success">
                                    <i class="fa fa-plus"></i>Agregar usuario</a>
                            </div>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th colspan="2"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    @if($user->id !== Auth::user()->id)
                                        <tr>
                                            <td>{{$user->id}}</td>
                                            <td>
                                                <a href="{{ route('users.show',$user->id)}}"
                                                   class="btn-link">{{$user->name}}</a>
                                            </td>
                                            <td>{{$user->email}}</td>
                                            <td colspan="2" class="d-flex align-items-center justify-content-center">
                                                <a href="{{ route('users.edit',$user->id)}}"
                                                   class="btn btn-primary">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <form action="{{ route('users.destroy', $user->id)}}"
                                                      method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger" type="submit">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex align-items-middle justify-content-between">
                            @if(count($users) > 10)
                                <div class="col-8 text-left">
                                    {{$users->links()}}
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

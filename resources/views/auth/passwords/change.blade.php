@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">@lang('auth.change_password')</div>

                    <div class="card-body">
                        @lang('auth.change_password_text')

                        <form method="POST" action="{{ route('create-password') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{$id}}">
                            <div class="form-group row">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-right">@lang('auth.new_password')
                                </label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           required>

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="new_password"
                                       class="col-md-4 col-form-label text-md-right">@lang('auth.confirm_new_password')</label>

                                <div class="col-md-6">
                                    <input id="row" type="password"
                                           class="form-control @error('new_password') is-invalid @enderror"
                                           name="password_confirmation"
                                           required>

                                    @error('new_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        @lang('auth.change_password')
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')
@section('title', 'Authentification')
@section('content')

<main class="login-form">
    <div class="container">
        <div class="row justify-content-center">
        <div class="col-md-4 pt-4">
            <div class="card">
                <h3 class="card-header text-center">
                @lang('lang.text_registration')
                </h3>
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
                    <!-- <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Holy guacamole!</strong> You should check in on some of those fields below.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div> -->
                        @endif
                        <form action="" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <input type="text" placeholder="@lang('lang.text_name')" class="form-control" name="name" value="{{old('name')}}">
                                @if ($errors->has('name'))
                                    <div class="text-danger mt-2">
                                        {{$errors->first('name')}}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <input type="email" placeholder="@lang('lang.text_mail')" class="form-control" name="email" value="{{old('email')}}">
                                @if ($errors->has('email'))
                                    <div class="text-danger mt-2">
                                        {{$errors->first('email')}}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <input type="password" placeholder="@lang('lang.text_password')" class="form-control" name="password">
                                @if ($errors->has('password'))
                                    <div class="text-danger mt-2">
                                        {{$errors->first('password')}}
                                    </div>
                                @endif
                            </div>
                            <div class="d-grid mx-auto">
                                <input type="submit" class="btn btn-dark" value="@lang('lang.btn_send')">
                            </div>
                        </form>
                </div>
            </div>

        </div>
        </div>
    </div>
</main>











@endsection

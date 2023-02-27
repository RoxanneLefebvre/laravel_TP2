@extends('layouts.app')
@section('title', 'Authentification')
@section('content')

<main class="login-form">
    <div class="container">
        <div class="row justify-content-center">
        <div class="col-md-4 pt-4">
            <div class="card">
                <h3 class="card-header text-center">
                    Forgot Password
                </h3>
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
                    @endif
                    @if($errors)
                    <ul>
                        @foreach($errors->all() as $error)
                        <li class="text-danger">{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif
                    <!-- <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Holy guacamole!</strong> You should check in on some of those fields below.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div> -->
                        <form action="{{ route('temp.pass')}}"  method="POST">
                            @csrf

                            <div class="form-group mb-3">
                                <input type="email" placeholder="email" class="form-control" name="email" value="{{old('email')}}">
                                @if ($errors->has('email'))
                                    <div class="text-danger mt-2">
                                        {{$errors->first('email')}}
                                    </div>
                                @endif
                            </div>
                           
                        
                            <div class="d-grid mx-auto">
                                <input type="submit" class="btn btn-dark" value="Envoyer">
                            </div>
                        </form>
                </div>
            </div>

        </div>
        </div>
    </div>
</main>











@endsection

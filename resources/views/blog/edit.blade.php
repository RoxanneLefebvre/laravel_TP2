@extends('layouts.app')
@section('title', 'mettre a jour')
@section('content')




<div class="container">
    
    <div class="row">
        <div class="col-12 text-center mt-2">
            <h1 class="display-one">mettre a jour un article</h1>
        </div>
    </div>

 <hr>



 <div class="row justify-content-center">
    <div class="col-md-6 text-center">

        <form method="post">
            @csrf
            @method('put')

            <div class="card">
                <div class="card-header">
                    formulaire
                </div>
                <div class="card-body">
                    <div class="control-group col-12">
                        <label for="title">Titre du post</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ $blogPost->title }}">
                    </div>
                    <div class="control-group col-12">
                        <label for="body">post</label>
                        <textarea name="body" id="body" class="form-control">{{ $blogPost->body }}</textarea>
                    </div>
                    
                </div>
                <div class="card-footer">
                @if($errors)
                    <ul>
                        @foreach($errors->all() as $error)
                        <li class="text-danger">{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif
                    <input type="submit" value="mettre a jour" class="btn btn-success">

                </div>
            </div>

        </form>

    </div>
</div>
@endsection


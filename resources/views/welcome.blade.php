@extends('layouts.app')
@section('title', 'Accueil')
@section('content')
    


<div class="container">
    <div class="row">
        <div class="col-12 text-center pt-5">
            <h1 class="display-one mt-5">
            {{ config('app.name')}}
            </h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic saepe voluptatibus, ex, dolor magni illo deleniti cum amet quod, tempora itaque incidunt eligendi molestias? Error voluptas vero ea eveniet. Aliquam, facilis dolore voluptatem reprehenderit et delectus nostrum vel amet illum itaque! Modi maxime voluptates quia dolorem earum ullam aperiam sapiente?

            </p>
            <a href="{{ route('blog.index')}}" class="btn btn-outline-primary">Afficher le blog</a>
        </div>
    </div>
</div>
@endsection
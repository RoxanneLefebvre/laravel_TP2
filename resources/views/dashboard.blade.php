@extends('layouts.app')
@section('title', 'dashboard')
@section('content')
@php $locale = session()->get('locale'); @endphp



<div class="container_dashboard">
@if(session('success'))
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
                    @endif
    <div class="dash">
    @if($locale=='fr')
        <h1>Bienvenue @if(Auth::check()) {{ Auth::user()->name }} @else guest @endif </h1>
        <p>voir le <a href="{{route('blog.index')}}">Forum</a> ou consulter le <a href="{{route('repo.repository')}}"> depot de fichier</a> </p>
    @endif
    @if($locale=='en'||!'fr'&&'null')
        <h1>Welcome @if(Auth::check()) {{ Auth::user()->name }} @else guest @endif </h1>
        <p>See the <a href="{{route('blog.index')}}">Forum</a> or consult the<a href="{{route('repo.repository')}}"> Repository </a> </p>
    @endif
    </div>

    <!-- <div class="exemple_dash_container">
        <div class="exemple_dash">

        </div>

        <div class="exemple_dash">

        </div>

        <div class="exemple_dash">

        </div>

        <div class="exemple_dash">

        </div>

        <div class="exemple_dash">

        </div>

        <div class="exemple_dash">

        </div>


        <div class="exemple_dash">

        </div>
        <div class="exemple_dash">

        </div>


    </div>

</div> -->


@endsection

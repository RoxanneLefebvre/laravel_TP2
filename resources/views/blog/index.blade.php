@extends('layouts.app')
@section('title', 'Blog list')
@section('content')
@php $locale = session()->get('locale'); @endphp

<div class="container">
    <div class="row">
        <div class="col-12 text-center pt-5">
            <h2>
                FORUM

            </h2>
            <hr>
            <div class="row">
                <div class="col-8">

                </div>
                <div class="col-md-4">
                    <a href="{{ route('blog.create')}}" class="btn btn-outline-primary">@lang('lang.add_post')</a>
                </div>
            </div>
            <hr>
        </div>

            <div class="row mb-5">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <p>FORUM

                            </p>
                            
                            <small>@lang('lang.forum_note')</small>
                        </div>
                        <div class="card-body">
                            <ul>
                                @forelse($blogs as $blog)
                                    
                                @if($locale=='en')
                        <div class="w-100 mb-2">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center ">
                                        <div class="col mr-2">

                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                <a href="{{ route('blog.show', $blog->id)}}">{{ $blog->title }}</a></div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800 text-truncate">{{ $blog->body }}</div>
                                            <i class="text-gray-300">{{ $blog->blogHasUser->name }}</i>

                                        </div>

                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if($locale=='fr')
                            @if($blog->body_fr)
                            <div class="w-100 mb-2">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center ">
                                            <div class="col mr-2">

                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    <a href="{{ route('blog.show', $blog->id)}}">{{ $blog->title_fr }}</a></div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800 text-truncate">{{ $blog->body_fr }}</div>
                                                <i class="text-gray-300">{{ $blog->blogHasUser->name }}</i>
                                                
                                            </div>
                                            
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @endif
                                    @empty
                                    <li class="text-danger">Aucun article trouver</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
           
    </div>
</div> 





@endsection
    

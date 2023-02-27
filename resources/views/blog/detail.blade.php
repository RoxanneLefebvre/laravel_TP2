@extends('layouts.app')
@section('title', 'detail')
@section('content')
@php $locale = session()->get('locale'); @endphp




<div class="container">

    <div class="row">
      <div class="col-12 text-center pt-5">
        @if($locale=='en')
        <h1 class="display-one mt-5">
          {{ $blogPost->title }}
        </h1>
        <hr>
        <p>{{ $blogPost->body }}
        </p>
        @endif
        @if($locale=='fr')
        <h1 class="display-one mt-5">
          {{ $blogPost->title_fr }}
        </h1>
        <hr>
        <p>{{ $blogPost->body_fr }}
        </p>
        @endif
        <strong><span>@lang('lang.post_timestamp')</strong>{{ $blogPost->created_at }}</span>
        <strong><span>@lang('lang.post_categorie')</strong> @isset($blogPost->blogHasCategorie) {{ $blogPost->blogHasCategorie->categorie }} @endisset</span>
        <strong><span>@lang('lang.post_author')</strong> {{ $blogPost->blogHasUser->name }}</span>
        <hr>
      </div>
    </div>

  <div class="row text-center">
    <div class="col-4">
      <a href="{{ route('blog.pdf', $blogPost->id)}}" class="btn btn-warning">PDF</a>
    </div>
    <div class="col-4">
      @can('update', $blogPost)
      <a href="{{ route('blog.edit', $blogPost->id) }} " class="btn btn-primary">@lang('lang.post_edit')</a>
      @endcan
      @can('delete', $blogPost)
    </div>
    <div class="col-4">
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
        @lang('lang.post_erase')
      </button>

    </div>


@endcan









<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="deleteModalLabel">Effacer un Article</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        etes vous certain de vouloir effacer ce post.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <form action="{{ route('blog.edit', $blogPost->id)}}" method="post">
          @csrf
          @method('delete')
          <input type="submit" class="btn btn-danger" value="Effacer">
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
@extends('layouts.app')
@section('title', 'Repo list')
@section('content')
@php $locale = session()->get('locale'); @endphp

<div class="container">
    <div class="row">
        <div class="col-12 text-center pt-5">
            <h2>
                @lang('lang.nav_repo')


            </h2>
            <hr>
            @if(session('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
            @endif
            <div class="row">
                <div class="col-8">
                    
                </div>
                <div class="col-md-4">
                    <a href="{{ route('repo.create')}}" class="btn btn-outline-primary">@lang('lang.add_file')</a>
                </div>
            </div>
            <hr>
        </div>

        <div class="container">
            <div class="card mt-3">
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>@lang('lang.repo_fileName')</th>
                            <th>Date</th>
                            <th>@lang('lang.repo_author')</th>
                            <th>Type</th>
                            
                            <th>@lang('lang.repo_edit')</th>
                            
                            
                            <th>@lang('lang.repo_delete')</th>
                            
                
                        </tr>
                        @forelse($files as $file)
                        <tr>
                            <td><a href="{{$file->path}}">{{ $file->title}}</a></td>
                            <td>{{ $file->created_at}}</td>
                            <td>{{ $file->repoHasUser->name }}</td>
                            <td><i class="fa fa-file-{{$icons[$file->type]}}-o fa-3x text-center"></i></td>
                            @can('update', $file)
                            <td><a href="{{ route('repo.edit', $file->id)}}" class="btn btn-warning">@lang('lang.repo_edit')</a></td>
                            @else
                            <td>@lang('lang.repo_cant_edit')</td>
                            @endcan
                            @can('delete', $file)
                            <td><form action="{{ route('repo.edit', $file->id)}}" method="post">
                                            @csrf
                                            @method('delete')
                                            <input type="submit" class="btn btn-danger" value="@lang('lang.repo_delete')">
                                        </form>
                            </td>
                            @else
                            <td>@lang('lang.repo_cant_delete')</td>
                            @endcan


                        </tr>


                        
                        @empty
                        <td class="text-danger">Aucun file trouver</td>
                        @endforelse
                    </table>
                    {{$files}}
                </div>

            </div>
        </div>










    </div>
</div>





@endsection
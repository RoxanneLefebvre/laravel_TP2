@extends('layouts.app')
@section('title', 'mettre a jour')
@section('content')




<div class="container">
    
    <div class="row">
        <div class="col-12 text-center mt-2">
            <h1 class="display-one">@lang('lang.repo_edit')</h1>
        </div>
    </div>

 <hr>



 <div class="row justify-content-center">
    <div class="col-md-6 text-center">

        <form method="post" enctype="multipart/form-data">
            @csrf
            @method('put')

            <div class="card">
                <div class="card-header">
                @lang('lang.header_form')
                </div>
                <div class="card-body">
                    <div class="control-group col-12">
                        <label for="title">@lang('lang.repo_title')*</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ $repository->title }}">
                    </div>
                    @if ($errors->has('title'))
                        <div class="text-danger mt-2">
                            {{$errors->first('title')}}
                        </div>
                        @endif
                    <div class="control-group col-12">
                        <label for="title_fr">@lang('lang.repo_title_fr')</label>
                        <input type="text" name="title_fr" id="title_fr" class="form-control" value="{{ $repository->title_fr }}">
                    </div>
                    <div class="control-group col-12">
                            <label class="custom-file-label" for="chooseFile">@lang('lang.repo_select')*</label>
                            <input type="file" name="file" class="form-control" id="chooseFile">
                        </div>
                        @if ($errors->has('file'))
                        <div class="text-danger mt-2">
                            {{$errors->first('file')}}
                        </div>
                        @endif
                    
                </div>
                <div class="card-footer">
                
                    <input type="submit" value="@lang('lang.btn_update')" class="btn btn-success">

                </div>
            </div>

        </form>

    </div>
</div>
@endsection


@extends('layouts.app')
@section('title', 'ajouter')
@section('content')




<div class="container">

    <div class="row">
        <div class="col-12 text-center mt-2">
            <h1 class="display-one">@lang('lang.add_file')</h1>
        </div>
    </div>

    <hr>



    <div class="row justify-content-center">
        <div class="col-md-6 text-center">

            <form method="post" enctype="multipart/form-data">
                @csrf

                <div class="card">

                    <div class="card-header">
                        @lang('lang.header_form')
                    </div>






                    <div class="card-body">


                        <div class="control-group col-12">
                            <label for="title">@lang('lang.repo_title')*</label>
                            <input type="text" name="title" id="title" class="form-control">
                        </div>
                        @if ($errors->has('title'))
                        <div class="text-danger mt-2">
                            {{$errors->first('title')}}
                        </div>
                        @endif
                        <div class="control-group col-12">
                            <label for="title">@lang('lang.repo_title_fr')</label>
                            <input type="text" name="title_fr" id="title" class="form-control">
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

                        <button type="submit" name="submit" class="btn btn-success btn-block mt-4">
                        @lang('lang.btn_upload')
                        </button>
                    </div>
                </div>


        </div>






        </form>


    </div>
</div>
@endsection
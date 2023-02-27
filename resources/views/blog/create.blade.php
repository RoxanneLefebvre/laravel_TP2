@extends('layouts.app')
@section('title', 'ajouter')
@section('content')




<div class="container">

    <div class="row">
        <div class="col-12 text-center mt-2">
            <h1 class="display-one">@lang('lang.add_post')</h1>
        </div>
    </div>

    <hr>



    <div class="row justify-content-center">
        <div class="col-md-6 text-center">

            <form method="post">
                @csrf

                <div class="card">
                    <div class="card-header">
                    @lang('lang.header_form')
                    </div>

                    <ul class="nav nav-tabs" id="myTab" role="tablist">

                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="english-tab" data-bs-toggle="tab" data-bs-target="#english" type="button" role="tab" aria-controls="english" aria-selected="true">English *</button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="francais-tab" data-bs-toggle="tab" data-bs-target="#francais" type="button" role="tab" aria-controls="francais" aria-selected="false">Francais</button>
                        </li>

                    </ul>


                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="english" role="tabpanel" aria-labelledby="english-tab">

                            <div class="card-body">
                                <div class="control-group col-12">
                                    <label for="title">Title *</label>
                                    <input type="text" name="title" id="title" class="form-control">
                                </div>
                                <div class="control-group col-12">
                                    <label for="body">post *</label>
                                    <textarea name="body" id="body" class="form-control"></textarea>
                                </div>
                                <div class="control-group col-12">
                                    <label for="categorie">category *</label>
                                    <select name="categories_id" id="categorie" class="form-control">
                                        <option value="" selected disabled>select a value</option>
                                        @foreach($categories as $categorie)
                                        <option value="{{$categorie->id}}">{{$categorie->categorie}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="card-footer">
                                <input type="submit" value="send" class="btn btn-success">

                            </div>
                        </div>

                        <div class="tab-pane fade" id="francais" role="tabpanel" aria-labelledby="francais-tab">

                            <div class="card-body">
                                <div class="control-group col-12">
                                    <label for="title_fr">titre</label>
                                    <input type="text" name="title_fr" id="title_fr" class="form-control">
                                </div>
                                <div class="control-group col-12">
                                    <label for="body_fr">post</label>
                                    <textarea name="body_fr" id="body_fr" class="form-control"></textarea>
                                </div>
                                
                            </div>
                            <div class="card-footer">
                                <input type="submit" value="envoyer" class="btn btn-success">

                            </div>
                        </div>


                    </div>





                </div>



            </form>


        </div>
    </div>
    @endsection
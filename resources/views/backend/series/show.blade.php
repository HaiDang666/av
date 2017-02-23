@extends('layouts.app')

@section('htmlheader_title')
    {{$series->name}} Series
@endsection

@section('contentheader_title')
    {{$series->name}} Series
@endsection

@section('main-content')
    <div class="container spark-screen">
        <div class="row">
            <div id="movie-list" class="col-md-9">
                @include('backend.movies.partials.table')
            </div>

            <div id="movie-form" class="col-md-2">
                <a href="{{url('movies/create')}}" target="_blank"><button type="button" class="btn btn-primary btn-block">Add Movie</button></a>
            </div>
        </div>
    </div>
    @include('backend.movies.partials.modal')
@endsection

@section('page_style')
@endsection

@section('page_script')
    @include('bladejs.movie_index')
@endsection
@extends('layouts.app')

@section('htmlheader_title')
    {{$tag->name}}'s Movies
@endsection

@section('contentheader_title')
    {{$tag->name}}'s Movies
@endsection

@section('main-content')
    <div class="container spark-screen">
        <div class="row">
            <div id="movie-list" class="col-md-9">
                @include('movies.partials.table')
            </div>

            <div id="movie-form" class="col-md-2">
                <a href="{{url('movies/create')}}" target="_blank"><button type="button" class="btn btn-primary btn-block">Add Movie</button></a>
            </div>
        </div>
    </div>
    @include('movies.partials.modal')
@endsection

@section('page-style')
@endsection

@section('page-script')
    @include('bladejs.movie_index')
@endsection
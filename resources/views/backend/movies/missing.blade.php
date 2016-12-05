@extends('layouts.app')

@section('htmlheader_title')
    List Movies
@endsection

@section('contentheader_title')
    List Movies
@endsection

@section('main-content')
    <div class="container spark-screen">
        <div class="row">
            <div id="movie-list" class="col-md-9">
                <div class="box box-info">
                    <div class="box-body">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th style="width: 2%">ID</th>
                                <th>Name</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($movies as $movie)
                                <tr>
                                    <td>{{$movie->id}}</td>
                                    <td><a href="{{url('movies/' . $movie->id)}}" target="_blank">{{$movie->name}}</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
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
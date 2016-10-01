@extends('layouts.app')

@section('htmlheader_title')
    Movies
@endsection

@section('contentheader_title')
    Movies List
@endsection

@section('main-content')
    <div class="container spark-screen">
        <div class="row">
            <div id="actress-list" class="col-md-9">
                @include('movies.partials.table')
            </div>

            <div id="actress-form" class="col-md-2">
                <a href="{{url('movies/create')}}" target="_blank"><button type="button" class="btn btn-primary btn-block">Add Movie</button></a>
            </div>
        </div>
    </div>
@endsection

@section('page-style')
@endsection

@section('page-script')
@endsection
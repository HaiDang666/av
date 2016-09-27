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
        </div>
    </div>
@endsection

@section('page-style')
@endsection

@section('page-script')
@endsection
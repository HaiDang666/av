@extends('layouts.app')

@section('htmlheader_title')
    Studios
@endsection

@section('contentheader_title')
    Studio List
@endsection

@section('main-content')
    <div class="container spark-screen">
        <div class="row">
            <div id="studio-list" class="col-md-6">
                @include('studios.partials.table')
            </div>
            <div id="studio-form" class="col-md-5">
                @include('studios.partials.create')
            </div>
        </div>
    </div>
    @include('studios.partials.modal')
@endsection

@section('page-style')
    @include('bladecss.studio')
@endsection

@section('page-script')
    @include('bladejs.studio_index')
@endsection
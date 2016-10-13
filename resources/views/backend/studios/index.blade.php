@extends('layouts.app')

@section('htmlheader_title')
    List Studios
@endsection

@section('contentheader_title')
    List Studios
@endsection

@section('main-content')
    <div class="container spark-screen">
        <div class="row">
            <div id="studio-list" class="col-md-6">
                @include('backend.studios.partials.table')
            </div>
            <div id="studio-form" class="col-md-5">
                @include('backend.studios.partials.create')
            </div>
        </div>
    </div>
    @include('backend.studios.partials.modal')
@endsection

@section('page_style')
@endsection

@section('page_script')
    @include('bladejs.studio_index')
@endsection
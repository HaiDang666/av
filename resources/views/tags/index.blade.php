@extends('layouts.app')

@section('htmlheader_title')
    List Tags
@endsection

@section('contentheader_title')
    List Tags
@endsection

@section('main-content')
    <div class="container spark-screen">
        <div class="row">
            <div id="tag-list" class="col-md-6">
                @include('tags.partials.table')
            </div>
            <div id="tag-form" class="col-md-5">
                @include('tags.partials.create')
            </div>
        </div>
    </div>
    @include('tags.partials.modal')
@endsection

@section('page-style')
@endsection

@section('page-script')
    @include('bladejs.tag_index')
@endsection
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
                @include('backend.tags.partials.table')
            </div>
            <div id="tag-form" class="col-md-5">
                @include('backend.tags.partials.create')
            </div>
        </div>
    </div>
    @include('backend.tags.partials.modal')
@endsection

@section('page_style')
@endsection

@section('page_script')
    @include('bladejs.tag_index')
@endsection
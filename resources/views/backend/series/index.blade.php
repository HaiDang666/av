@extends('layouts.app')

@section('htmlheader_title')
    List Series
@endsection

@section('contentheader_title')
    List Series
@endsection

@section('main-content')
    <div class="container spark-screen">
        <div class="row">
            <div id="series-list" class="col-md-6">
                @include('backend.series.partials.table')
            </div>
            <div id="series-form" class="col-md-5">
                @include('backend.series.partials.create')
            </div>
        </div>
    </div>
    @include('backend.series.partials.modal')
@endsection

@section('page_style')
@endsection

@section('page_script')
    @include('bladejs.series_index')
@endsection
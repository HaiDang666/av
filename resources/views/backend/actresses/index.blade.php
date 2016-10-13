@extends('layouts.app')

@section('htmlheader_title')
    List Actresses
@endsection

@section('contentheader_title')
    List Actresses
@endsection

@section('main-content')
    <div class="container spark-screen">
        <div class="row">
            <div id="actress-list" class="col-md-9">
                @include('backend.actresses.partials.table')
            </div>
            <div id="actress-form" class="col-md-2">
                <a href="{{url('actresses/create')}}" target="_blank"><button type="button" class="btn btn-primary btn-block">Add Actress</button></a>
            </div>
        </div>
    </div>
    @include('backend.actresses.partials.modal')
@endsection

@section('page_style')
@endsection

@section('page_script')
    @include('bladejs.actress_index')
@endsection
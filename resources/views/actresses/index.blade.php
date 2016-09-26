@extends('layouts.app')

@section('htmlheader_title')
    Actresses
@endsection

@section('contentheader_title')
    Actress List
@endsection

@section('main-content')
    <div class="container spark-screen">
        <div class="row">
            <div id="actress-list" class="col-md-9">
                @include('actresses.partials.table')
            </div>
            <div id="actress-form" class="col-md-2">
                <button type="button" class="btn btn-primary" id="btn-open-add-actress">Add Actress</button>
                @include('actresses.partials.create')
                @include('actresses.partials.edit')
            </div>
        </div>
    </div>
    @include('actresses.partials.modal')
@endsection

@section('page-style')

@endsection

@section('page-script')
    @include('bladejs.actress_index')
@endsection
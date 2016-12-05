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
                            @foreach($actresses as $actress)
                                <tr>
                                    <td>{{$actress->id}}</td>
                                    <td><a href="{{url('actresses/' . $actress->id)}}" target="_blank">{{$actress->name}}</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
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
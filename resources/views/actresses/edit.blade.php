@extends('layouts.app')

@section('page_plugin_css')
    <!-- bootstrap datepicker -->
    <link href="{{ asset('/plugins/datepicker/datepicker3.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('htmlheader_title')
    {{$actress->name}}
@endsection

@section('contentheader_title')
    Edit {{$actress->name}}'s profile
@endsection

@section('main-content')
    <div class="container spark-screen">
        <div class="row">
            <div class="col-md-7">
                <div class="box box-info">
                    {!! Form::open(['action'=>['ActressesController@update', $actress->id], 'files'=>true]) !!}
                    <input type="hidden" name="_method" value="PUT">
                        <div class="box-body">
                            <table class="table table-form">
                                <tr>
                                    <th width="10%">Name</th>
                                    <td>
                                        <input type="text" class="form-control" id="inputName" name="name"
                                               placeholder="Enter actress name" required pattern=".*\S.*"
                                               title="at least 1 character" value="{{$actress->name}}">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Other name</th>
                                    <td>
                                        <input type="text" class="form-control" name="alias" pattern=".*\S.*"
                                               placeholder="Enter other name" value="{{$actress->alias}}">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Birthdate</th>
                                    <td>
                                        <div class="input-group date">
                                            <input type="text" class="form-control pull-right" name="dob" 
                                            id="datepicker" placeholder="Enter birthday" value="{{$actress->dob}}">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Debut</th>
                                    <td>
                                        <input type="number" class="form-control" name="debut"
                                               placeholder="Enter debut year" value="@if($actress->debut != 0){{$actress->debut}}@endif">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Measurements</th>
                                    <td>
                                        <input type="text" class="form-control" name="measurements"
                                               placeholder="Enter measurements" value="{{$actress->measurements}}">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Note</th>
                                    <td>
                                        <input type="text" class="form-control" name="note"
                                               placeholder="Enter note" value="{{$actress->note}}">
                                    </td>
                                </tr>

                                @if($actress->thumbnail != '')
                                    <tr>
                                        <th>Current Avatar</th>
                                        <td>
                                            <img width="60px" height="60px" alt="act avatar" src="{{url('/image?category=actress&type=thumbnail&filename='. $actress->thumbnail)}}"/>
                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    <th>Avatar</th>
                                    <td>
                                        <input id="inputThumbnail" name="thumbnail" type="file"
                                               class="file-loading form-control">
                                    </td>
                                </tr>

                                @if($actress->image != '')
                                    <tr>
                                        <th>Current Image</th>
                                        <td>
                                            <img width="230px" alt="act image" src="{{url('/image?category=actress&type=image&filename='. $actress->image)}}"/>
                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    <th>Image</th>
                                    <td>
                                        <input id="inputImage" name="image" type="file"
                                               class="file-loading form-control">
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="box-footer">
                            <div class="col-md-4 col-md-offset-8">
                                <button class="btn btn-primary btn-block">Update</button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page_plugin_js')
    <!-- Upload file -->
    <script src="{{ asset('/js/fileinput.min.js') }}"></script>
    <!-- bootstrap datepicker -->
    <script src="{{ asset('/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
@endsection

@section('page-style')
@endsection

@section('page-script')
    @include('bladejs.actress_create')
@endsection
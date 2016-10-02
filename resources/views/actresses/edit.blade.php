@extends('layouts.app')

@section('htmlheader_title')
    {{$actress->name}}
@endsection

@section('contentheader_title')
    Edit {{$actress->name}}'s profile
@endsection

@section('main-content')
    <div class="container spark-screen">
        <div class="row">
            <div class="col-md-10">
                <div class="box box-info">
                    {!! Form::open(['action'=>['ActressesController@update', $actress->id], 'files'=>true]) !!}
                    <input type="hidden" name="_method" value="PUT">
                        <div class="box-body">
                            <div class="row">
                                <div class="form-group">

                                    <label for="inputName" class="col-sm-1 control-label">Name</label>

                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="inputName" name="name"
                                               placeholder="Enter actress name" required pattern=".*\S.*"
                                               title="at least 1 character" value="{{$actress->name}}">
                                    </div>
                                </div>
                            </div>

                            @if($actress->thumbnail != '')
                            <div>
                                <label>Current Avatar</label>
                                <img width="60px" height="60px" alt="act avatar" src="{{url('/image?category=actress&type=thumbnail&filename='. $actress->thumbnail)}}"/>
                            </div>
                            @endif

                            <div class="row">
                                <div class="form-group">
                                    <label class="col-sm-1 control-label" style="padding-top: 25px" >Avatar</label>
                                    <div class="col-sm-7">
                                        <input id="inputThumbnail" name="thumbnail" type="file"
                                               class="file-loading form-control">
                                    </div>
                                    <div class="col-sm-3" style="padding-top: 15px">
                                        <span style="font-style: italic; font-size: small">max 1 file</span><br/>
                                        <span style="font-style: italic; font-size: small">alow: xxxxxxxxxxxxxxxxxxxxxxxxx</span>
                                    </div>
                                </div>
                            </div>

                            @if($actress->image != '')
                                <div>
                                    <label>Current Image</label>
                                    <img width="430px" alt="act image" src="{{url('/image?category=actress&type=image&filename='. $actress->image)}}"/>
                                </div>
                            @endif

                            <div class="row">
                                <div class="form-group">
                                    <label class="col-sm-1 control-label"  style="padding-top: 25px" >Image</label>
                                    <div class="col-sm-7">
                                        <input id="inputImage" name="image" type="file"
                                               class="file-loading form-control">
                                    </div>
                                    <div class="col-sm-3" style="padding-top: 15px">
                                        <span style="font-style: italic; font-size: small">max 1 files</span><br/>
                                        <span style="font-style: italic; font-size: small">alow: xxxxxxxxxxxxxxxxxxxxxxxxx</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <div class="col-md-2 col-lg-offset-10">
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
@endsection

@section('page-style')
@endsection

@section('page-script')
    @include('bladejs.actress_create')
@endsection
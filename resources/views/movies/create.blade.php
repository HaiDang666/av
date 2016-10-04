@extends('layouts.app')

@section('page_plugin_css')
    <!-- Select2 -->
    <link href="{{ asset('/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('htmlheader_title')
    Movie
@endsection

@section('contentheader_title')
    Add Movie
@endsection

@section('main-content')
    <div class="container spark-screen">
        <div class="row">
            <div class="col-md-10">
                {!! Form::open(['action'=>'MoviesController@store', 'files'=>true]) !!}
                    <div class="form-group">
                        <label for="inputCode" class="control-label">Code</label>
                        <div class="">
                            <input type="text" class="form-control" id="inputCode" name="code" placeholder="Enter movie code" required pattern=".*\S.*" title="at least 1 character">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputName" class="control-label">Name</label>
                        <div class="">
                            <input type="text" class="form-control" id="inputName" name="name" placeholder="Enter movie name" pattern=".*\S.*" title="at least 1 character">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputLink" class="control-label">Link</label>
                        <div class="">
                            <input type="text" class="form-control" id="inputLink" name="link" placeholder="Enter movie link">
                        </div>
                    </div>

                    <div class="form-group">
                        {!! \app\UIBuilder\AppTemplate::select($studios, ['name' => 'studio_id', 'id' => 'inputStudio', 'label' => 'Choose Studio']) !!}
                    </div>

                    <div class="form-group">
                        {!! \app\UIBuilder\AppTemplate::select($actresses,
                        ['name' => 'existActresses[]',
                         'id' => 'inputExistActresses',
                         'label' => 'Choose Actresses',
                         'multiple' => 'multiple']) !!}
                    </div>

                    <div class="form-group">
                        {!! \app\UIBuilder\AppTemplate::select([],
                        ['name' => 'newActresses[]',
                         'id' => 'inputNewActresses',
                         'label' => 'Add Actresses',
                         'multiple' => 'multiple']) !!}
                    </div>

                    <div class="form-group">
                        <label for="inputStored" class="control-label">Store</label>
                        <input type="checkbox" class="flat-red" id="inputStored" name="stored" checked>
                    </div>

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

                    <br />
                    <div class="col-md-2 col-lg-offset-10">
                        <button class="btn btn-primary btn-block">Add</button>
                    </div>


                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('page_plugin_js')
    <!-- Select2 -->
    <script src="{{ asset('/plugins/select2/select2.full.min.js') }}"></script>
    <!-- iCheck -->
    <script src="{{ asset('/plugins/iCheck/icheck.min.js') }}"></script>
    <!-- Upload file -->
    <script src="{{ asset('/js/fileinput.min.js') }}"></script>
@endsection

@section('page-style')
@endsection

@section('page-script')
    @include('bladejs.movie_create')
@endsection


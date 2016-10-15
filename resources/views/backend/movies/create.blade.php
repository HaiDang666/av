@extends('layouts.app')

@section('page_plugin_css')
    <!-- bootstrap datepicker -->
    <link href="{{ asset('/plugins/datepicker/datepicker3.css') }}" rel="stylesheet" type="text/css" />
    <!-- Select2 -->
    <link href="{{ asset('/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('htmlheader_title')
    Add Movie
@endsection

@section('contentheader_title')
    Add Movie
@endsection

@section('main-content')
    <div class="container spark-screen">
        <div class="row">
            {!! Form::open(['action'=>'MoviesController@store', 'files'=>true]) !!}
            <div class="col-md-6">
                <div class="box box-info">
                    <div class="box-body">
                        <table class="table table-form">
                            <tr>
                                <th>Code</th>
                                <td>
                                    <input type="text" class="form-control"
                                           name="code" placeholder="Enter code"
                                           required pattern=".*\S.*" title="at least 1 character">
                                </td>
                            </tr>
                            <tr>
                                <th>Name</th>
                                <td>
                                    <input type="text" class="form-control"
                                           name="name" placeholder="Enter name"
                                           pattern=".*\S.*" title="at least 1 character">
                                </td>
                            </tr>
                            <tr>
                                <th>Release</th>
                                <td>
                                    <div class="input-group date">
                                        <input type="text" class="form-control pull-right" id="datepicker" name="release"
                                               placeholder="Enter release">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>Length</th>
                                <td>
                                    <input type="number" class="form-control"
                                           name="length" placeholder="Enter length in min">
                                </td>
                            </tr>
                            <tr>
                                <th>Link</th>
                                <td>
                                    <input type="text" class="form-control"
                                           name="link" placeholder="Enter link">
                                </td>
                            </tr>
                            <tr>
                                <th style="width: 15%">Included in</th>
                                <td>
                                    <input type="text" class="form-control"
                                           name="included" placeholder="Enter father movie code separate by ;">
                                </td>
                            </tr>
                            <tr>
                                <th>Contain</th>
                                <td>
                                    <input type="text" class="form-control"
                                           name="contain" placeholder="Enter son movie code separate by ;">
                                </td>
                            </tr>
                            <tr>
                                <th>Note</th>
                                <td>
                                    <input type="text" class="form-control"
                                           name="note" placeholder="Enter note">
                                </td>
                            </tr>
                            <tr>
                                <th>Thumbnail Link</th>
                                <td>
                                    <input type="text" class="form-control"
                                           name="thumbnaillink" placeholder="Enter link">
                                </td>
                            </tr>
                            <tr>
                                <th>Image Link</th>
                                <td>
                                    <input type="text" class="form-control"
                                           name="imagelink" placeholder="Enter link">
                                </td>
                            </tr>
                            <tr>
                                <th>Store</th>
                                <td>
                                    <input type="checkbox" class="flat-red" id="inputStored"
                                           name="stored" checked>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="box box-info">
                    <div class="box-body">
                        <table class="table table-form">
                            <tr>
                                <th>Choose Tags</th>
                                <td class="form-group">
                                    {!! \app\UIBuilder\AppTemplate::select($tags,
                                    ['name' => 'tags[]',
                                        'id' => 'inputTags',
                                        'multiple' => 'multiple']) !!}
                                </td>
                            </tr>
                            <tr>
                                <th>Choose Studio</th>
                                <td>
                                    {!! \app\UIBuilder\AppTemplate::select($studios, ['name' => 'studio_id', 'id' => 'inputStudio']) !!}
                                </td>
                            </tr>
                            <tr>
                                <th>Choose Actresses</th>
                                <td class="form-group">
                                    {!! \app\UIBuilder\AppTemplate::select($actresses,
                                    ['name' => 'existActresses[]',
                                        'id' => 'inputExistActresses',
                                        'multiple' => 'multiple']) !!}
                                </td>
                            </tr>
                            <tr>
                                <th>Add Actresses</th>
                                <td class="form-group">
                                    {!! \app\UIBuilder\AppTemplate::select([],
                                    ['name' => 'newActresses[]',
                                        'id' => 'inputNewActresses',
                                        'multiple' => 'multiple']) !!}
                                </td>
                            </tr>
                            <tr>
                                <th>Thumbnail</th>
                                <td>
                                    <input id="inputThumbnail" name="thumbnail" type="file"
                                           class="file-loading form-control">
                                </td>
                            </tr>
                            <tr>
                                <th>Image</th>
                                <td>
                                    <input id="inputImage" name="image" type="file"
                                           class="file-loading form-control">
                                </td>
                            </tr>
                        </table>
                        <button style="margin-top: 4%" class="btn btn-success btn-block">Add</button>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('page_plugin_js')
    <!-- Select2 -->
    <script src="{{ asset('/plugins/select2/select2.full.min.js') }}"></script>
    <!-- bootstrap datepicker -->
    <script src="{{ asset('/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
    <!-- iCheck -->
    <script src="{{ asset('/plugins/iCheck/icheck.min.js') }}"></script>
    <!-- Upload file -->
    <script src="{{ asset('/js/fileinput.min.js') }}"></script>
@endsection

@section('page_style')
@endsection

@section('page_script')
    @include('bladejs.movie_create')
@endsection


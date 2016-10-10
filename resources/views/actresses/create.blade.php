@extends('layouts.app')

@section('page_plugin_css')
    <!-- bootstrap datepicker -->
    <link href="{{ asset('/plugins/datepicker/datepicker3.css') }}" rel="stylesheet" type="text/css" />
    <!-- Select2 -->
    <link href="{{ asset('/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('htmlheader_title')
    Add Actress
@endsection

@section('contentheader_title')
    Add Actress
@endsection

@section('main-content')
    <div class="container spark-screen">
        <div class="row">
            <div class="col-md-7">
                <div class="box box-info">
                    {!! Form::open(['action'=>'ActressesController@store', 'files'=>true]) !!}
                        <div class="box-body">
                            <table class="table table-form">
                                <tr>
                                    <th width="10%">Name</th>
                                    <td>
                                        <input type="text" class="form-control" id="inputName" name="name"
                                               placeholder="Enter name" required pattern=".*\S.*"
                                               title="at least 1 character">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Other name</th>
                                    <td>
                                        <input type="text" class="form-control" name="alias" pattern=".*\S.*"
                                               placeholder="Enter other name">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Japanese name</th>
                                    <td>
                                        <input type="text" class="form-control" name="jp_name" pattern=".*\S.*"
                                               placeholder="Enter Japanese name">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Birthday</th>
                                    <td>
                                        <div class="input-group date">
                                            <input type="text" class="form-control pull-right" id="datepicker" name="dob"  placeholder="Enter birthday">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Birthplace</th>
                                    <td>
                                        <input type="text" class="form-control" name="pob" pattern=".*\S.*"
                                               placeholder="Enter birthplace">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Height</th>
                                    <td>
                                        <input type="number" class="form-control" name="height"
                                               placeholder="Enter height in cm">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Weight</th>
                                    <td>
                                        <input type="number" class="form-control" name="weight"
                                               placeholder="Enter weight in kg">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Measurements</th>
                                    <td>
                                        <input type="text" class="form-control" name="measurements"
                                               placeholder="Enter measurements">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Cup size</th>
                                    <td style="padding-right: 0" class="form-group">
                                        {!! \app\UIBuilder\AppTemplate::select($cupSizeList,
                                        ['name' => 'cup_size',
                                            'id' => 'inputCupSize']) !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Debut</th>
                                    <td>
                                        <input type="number" class="form-control" name="debut"
                                               placeholder="Enter debut year">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Choose Tags</th>
                                    <td style="padding-right: 0" class="form-group">
                                        {!! \app\UIBuilder\AppTemplate::select($tags,
                                        ['name' => 'tags[]',
                                            'id' => 'inputTags',
                                            'multiple' => 'multiple']) !!}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Description</th>
                                    <td>
                                        <input type="text" class="form-control" name="description"
                                               placeholder="Enter description">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Note</th>
                                    <td>
                                        <input type="text" class="form-control" name="note"
                                               placeholder="Enter note">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Avatar</th>
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
                        </div>
                        <div class="box-footer">
                            <div class="col-md-4 col-md-offset-8">
                                <button class="btn btn-primary btn-block">Add</button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="box box-info">
                    <p>FUCK YOU!!!</p>
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
    <!-- Select2 -->
    <script src="{{ asset('/plugins/select2/select2.full.min.js') }}"></script>
@endsection

@section('page-style')
@endsection

@section('page-script')
    @include('bladejs.actress_create')
@endsection
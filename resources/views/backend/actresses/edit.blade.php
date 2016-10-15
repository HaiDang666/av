@extends('layouts.app')

@section('page_plugin_css')
    <!-- bootstrap datepicker -->
    <link href="{{ asset('/plugins/datepicker/datepicker3.css') }}" rel="stylesheet" type="text/css" />
    <!-- Select2 -->
    <link href="{{ asset('/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
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
            {!! Form::open(['action'=>['ActressesController@update', $actress->id], 'files'=>true]) !!}
            <div class="col-md-6">
                <div class="box box-info">
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
                                <th>Japanese name</th>
                                <td>
                                    <input type="text" class="form-control" name="jp_name" pattern=".*\S.*"
                                           placeholder="Enter Japanese name" value="{{$actress->jp_name}}">
                                </td>
                            </tr>
                            <tr>
                                <th>Birthday</th>
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
                                <th>Birthplace</th>
                                <td>
                                    <input type="text" class="form-control" name="pob" pattern=".*\S.*"
                                           placeholder="Enter birthplace" value="{{$actress->pob}}">
                                </td>
                            </tr>
                            <tr>
                                <th>Debut</th>
                                <td>
                                    <input type="number" class="form-control" name="debut"
                                           placeholder="Enter debut year"
                                           value="@if($actress->debut != 0){{$actress->debut}}@endif">
                                </td>
                            </tr>
                            <tr>
                                <th>Description</th>
                                <td>
                                    <input type="text" class="form-control" name="description"
                                           placeholder="Enter description" value="{{$actress->description}}">
                                </td>
                            </tr>
                            <tr>
                                <th>Note</th>
                                <td>
                                    <input type="text" class="form-control" name="note"
                                           placeholder="Enter note" value="{{$actress->note}}">
                                </td>
                            </tr>
                            <tr>
                                <th>Avatar Link</th>
                                <td>
                                    <input type="text" class="form-control"
                                           name="thumbnaillink" placeholder="Enter link"
                                           value="@if(substr($actress->thumbnail, 0, 7) == 'http://'){{$actress->thumbnail}}@endif">
                                </td>
                            </tr>
                            <tr>
                                <th>Image Link</th>
                                <td>
                                    <input type="text" class="form-control"
                                           name="imagelink" placeholder="Enter link"
                                           value="@if(substr($actress->image, 0, 7) == 'http://'){{$actress->image}}@endif">
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
                                <th width="30%">Height</th>
                                <td>
                                    <input type="number" class="form-control" name="height"
                                           placeholder="Enter height in cm"
                                           value="@if($actress->height != 0){{$actress->height}}@endif">
                                </td>
                            </tr>
                            <tr>
                                <th>Weight</th>
                                <td>
                                    <input type="number" class="form-control" name="weight"
                                           placeholder="Enter weight in kg"
                                           value="@if($actress->weight != 0){{$actress->weight}}@endif">
                                </td>
                            </tr>
                            <tr>
                                <th>Measurements</th>
                                <td>
                                    <input type="text" class="form-control" name="measurements"
                                           placeholder="Enter measurements"
                                           value="@if($actress->measurements != 0){{$actress->measurements}}@endif">
                                </td>
                            </tr>
                            <tr>
                                <th>Cup size</th>
                                <td>
                                    {!! \app\UIBuilder\AppTemplate::select($cupSizeList,
                                    ['name' => 'cup_size',
                                        'id' => 'inputCupSize']) !!}
                                </td>
                            </tr>
                            <tr>
                                <th>Choose Tags</th>
                                <td>
                                    {!! \app\UIBuilder\AppTemplate::select($tags,
                                    ['name' => 'tags[]',
                                        'id' => 'inputTags',
                                        'multiple' => 'multiple']) !!}
                                </td>
                            </tr>
                            @if($actress->thumbnail != '')
                                <tr>
                                    <th>Current Avatar</th>
                                    <td>
                                        <img width="80px" height="100px" alt="actress avatar"
                                             src="@if(substr($actress->thumbnail, 0, 7) == 'http://'){{$actress->thumbnail}}@else{{url('/image?category=actress&type=thumbnail&filename='. $actress->thumbnail)}}@endif"/>
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
                                        <img width="230px" alt="actress image"
                                             src="@if(substr($actress->image, 0, 7) == 'http://'){{$actress->image}}@else{{url('/image?category=actress&type=image&filename='. $actress->image)}}@endif"/>
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
                        <button class="btn btn-success btn-block">Update</button>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
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

@section('page_style')
@endsection

@section('page_script')
    @include('bladejs.actress_create')
    <script>
        $( document ).ready(function() {
            $('#inputCupSize').val({{$actress->cup_size}}).change();
            $('#inputTags').val({{json_encode($selectedTag)}}).change();
        });
    </script>
@endsection
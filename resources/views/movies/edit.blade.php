@extends('layouts.app')

@section('page_plugin_css')
    <!-- Select2 -->
    <link href="{{ asset('/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('htmlheader_title')
    {{$movie->name}}
@endsection

@section('contentheader_title')
    Edit {{$movie->name}}'s info
@endsection

@section('main-content')
    <div class="container spark-screen">
        <div class="row">
            <div class="col-md-7">
                <div class="box box-info">
                    {!! Form::open(['action'=>['MoviesController@update', $movie->id], 'files'=>true]) !!}
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="oldActresses" value="{{json_encode($selectedActresses)}}">
                    <div class="box-body">
                        <table class="table table-form">
                            <tr>
                                <th width="10%">Code</th>
                                <td class="fix-padding">
                                    <input type="text" class="form-control"
                                           name="code" placeholder="Enter code"
                                           required pattern=".*\S.*" title="at least 1 character"
                                           value="{{$movie->code}}">
                                </td>
                            </tr>
                            <tr>
                                <th>Name</th>
                                <td class="fix-padding">
                                    <input type="text" class="form-control"
                                           name="name" placeholder="Enter name"
                                           pattern=".*\S.*" title="at least 1 character" value="{{$movie->name}}">
                                </td>
                            </tr>
                            <tr>
                                <th>Length</th>
                                <td style="padding-right: 17px">
                                    <input type="number" class="form-control"
                                           name="length" placeholder="Enter length in min" value="@if($movie->length != 0){{$movie->length}}@endif">
                                </td>
                            </tr>
                            <tr>
                                <th>Link</th>
                                <td class="fix-padding">
                                    <input type="text" class="form-control"
                                           name="link" placeholder="Enter link" value="{{$movie->link}}">
                                </td>
                            </tr>
                            <tr>
                                <th>Included in</th>
                                <td style="padding-right: 17px">
                                    <input type="text" class="form-control"
                                           name="included" placeholder="Enter father movie code separate by ;"
                                           value="{{$movie->included}}">
                                </td>
                            </tr>
                            <tr>
                                <th>Contain</th>
                                <td style="padding-right: 17px">
                                    <input type="text" class="form-control"
                                           name="contain" placeholder="Enter son movie code separate by ;"
                                           value="{{$movie->contain}}">
                                </td>
                            </tr>
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
                                <th>Note</th>
                                <td class="fix-padding">
                                    <input type="text" class="form-control"
                                           name="note" placeholder="Enter note" value="{{$movie->note}}">
                                </td>
                            </tr>
                            <tr>
                                <th>Choose studio</th>
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
                                <th>Store</th>
                                <td>
                                    <input type="checkbox" class="flat-red" id="inputStored"
                                           name="stored" checked>
                                </td>
                            </tr>
                            @if($movie->thumbnail != '')
                                <tr>
                                    <th>Current Thumbnail</th>
                                    <td>
                                        <img width="80px" height="100px" alt="act avatar"
                                             src="{{url('/image?category=movie&type=thumbnail&filename='. $movie->thumbnail)}}"/>
                                    </td>
                                </tr>
                            @endif
                            <tr>
                                <th>Thumbnail</th>
                                <td>
                                    <input id="inputThumbnail" name="thumbnail" type="file"
                                           class="file-loading form-control">
                                </td>
                            </tr>

                            @if($movie->image != '')
                                <tr>
                                    <th>Current Image</th>
                                    <td>
                                        <img width="230px" alt="act image"
                                             src="{{url('/image?category=movie&type=image&filename='. $movie->image)}}"/>
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
    <script>
        $( document ).ready(function() {
            $('#inputStudio').val({{$movie->studio_id}}).change();
            $('#inputExistActresses').val({{json_encode($selectedActresses)}}).change();
            $('#inputTags').val({{json_encode($selectedTag)}}).change();
        });
    </script>
@endsection


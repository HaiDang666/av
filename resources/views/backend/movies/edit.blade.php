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
            {!! Form::open(['action'=>['MoviesController@update', $movie->id], 'files'=>true]) !!}
            <div class="col-md-6">
                <div class="box box-info">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="oldActresses" value="{{json_encode($selectedActresses)}}">
                    <div class="box-body">
                        <table class="table table-form">
                            <tr>
                                <th width="10%">Code</th>
                                <td>
                                    <input type="text" class="form-control"
                                           name="code" placeholder="Enter code"
                                           required pattern=".*\S.*" title="at least 1 character"
                                           value="{{$movie->code}}">
                                </td>
                            </tr>
                            <tr>
                                <th>Name</th>
                                <td>
                                    <input type="text" class="form-control"
                                           name="name" placeholder="Enter name"
                                           pattern=".*\S.*" title="at least 1 character" value="{{$movie->name}}">
                                </td>
                            </tr>
                            <tr>
                                <th>Length</th>
                                <td>
                                    <input type="number" class="form-control"
                                           name="length" placeholder="Enter length in min" value="@if($movie->length != 0){{$movie->length}}@endif">
                                </td>
                            </tr>
                            <tr>
                                <th>Link</th>
                                <td>
                                    <input type="text" class="form-control"
                                           name="link" placeholder="Enter link" value="{{$movie->link}}">
                                </td>
                            </tr>
                            <tr>
                                <th>Included in</th>
                                <td>
                                    <input type="text" class="form-control"
                                           name="included" placeholder="Enter father movie code separate by ;"
                                           value="{{$movie->included}}">
                                </td>
                            </tr>
                            <tr>
                                <th>Contain</th>
                                <td>
                                    <input type="text" class="form-control"
                                           name="contain" placeholder="Enter son movie code separate by ;"
                                           value="{{$movie->contain}}">
                                </td>
                            </tr>
                            <tr>
                                <th>Note</th>
                                <td>
                                    <input type="text" class="form-control"
                                           name="note" placeholder="Enter note" value="{{$movie->note}}">
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
                            @if($movie->thumbnail != '')
                                <tr>
                                    <th>Current Thumbnail</th>
                                    <td>
                                        <img width="80px" height="100px" alt="movie thumbnail"
                                             src="@if(substr($movie->thumbnail, 0, 7) == 'http://'){{$movie->thumbnail}}@else{{url('/image?category=movie&type=thumbnail&filename='. $movie->thumbnail)}}@endif"/>
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
                                        <img width="230px" alt="movie image"
                                             src="@if(substr($movie->image, 0, 7) == 'http://'){{$movie->image}}@else{{url('/image?category=movie&type=image&filename='. $movie->image)}}@endif"/>
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
                        <button style="margin-top: 4%" class="btn btn-success btn-block">Update</button>
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
    <!-- iCheck -->
    <script src="{{ asset('/plugins/iCheck/icheck.min.js') }}"></script>
    <!-- Upload file -->
    <script src="{{ asset('/js/fileinput.min.js') }}"></script>
@endsection

@section('page_style')
@endsection

@section('page_script')
    @include('bladejs.movie_create')
    <script>
        $( document ).ready(function() {
            $('#inputStudio').val({{$movie->studio_id}}).change();
            $('#inputExistActresses').val({{json_encode($selectedActresses)}}).change();
            $('#inputTags').val({{json_encode($selectedTag)}}).change();
        });
    </script>
@endsection


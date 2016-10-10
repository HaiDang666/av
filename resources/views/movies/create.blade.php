@extends('layouts.app')

@section('page_plugin_css')
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
            <div class="col-md-7">
                <div class="box box-info">
                    {!! Form::open(['action'=>'MoviesController@store', 'files'=>true]) !!}
                        <div class="box-body">
                            <table class="table table-form">
                                <tr>
                                    <th width="10%">Code</th>
                                    <td style="padding-right: 17px">
                                        <input type="text" class="form-control"
                                              name="code" placeholder="Enter code"
                                              required pattern=".*\S.*" title="at least 1 character">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <td style="padding-right: 17px">
                                        <input type="text" class="form-control"
                                              name="name" placeholder="Enter name"
                                              pattern=".*\S.*" title="at least 1 character">
                                   </td>
                                </tr>
                                <tr>
                                    <th>Length</th>
                                    <td style="padding-right: 17px">
                                        <input type="number" class="form-control"
                                              name="length" placeholder="Enter length in min">
                                   </td>
                                </tr>
                                <tr>
                                    <th>Link</th>
                                    <td style="padding-right: 17px">
                                        <input type="text" class="form-control"
                                              name="link" placeholder="Enter link">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Included in</th>
                                    <td style="padding-right: 17px">
                                        <input type="text" class="form-control"
                                              name="included" placeholder="Enter father movie code separate by ;">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Contain</th>
                                    <td style="padding-right: 17px">
                                        <input type="text" class="form-control"
                                              name="contain" placeholder="Enter son movie code separate by ;">
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
                                    <td style="padding-right: 17px">
                                           <input type="text" class="form-control"
                                              name="note" placeholder="Enter note">
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
                                    <th>Store</th>
                                    <td>
                                        <input type="checkbox" class="flat-red" id="inputStored"
                                               name="stored" checked>
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


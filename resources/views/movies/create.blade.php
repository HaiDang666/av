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
                <form class="form-horizontal" id="frm-add-movie">
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
                        {!! \app\UIBuilder\AppTemplate::select($studios, ['name' => 'studio', 'id' => 'inputStudio', 'label' => 'Choose Studio']) !!}
                    </div>

                    <div class="form-group">
                        {!! \app\UIBuilder\AppTemplate::select($actresses,
                        ['name' => 'existActresses',
                         'id' => 'inputExistActresses',
                         'label' => 'Choose Actresses',
                         'multiple' => 'multiple']) !!}
                    </div>

                    <div class="form-group">
                        {!! \app\UIBuilder\AppTemplate::select([],
                        ['name' => 'newActresses',
                         'id' => 'inputNewActresses',
                         'label' => 'Add Actresses',
                         'multiple' => 'multiple']) !!}
                    </div>

                    <div class="form-group">
                        <label for="inputStored" class="control-label">Store</label>
                        <input type="checkbox" class="flat-red" id="inputStored" name="stored" checked>
                    </div>

                    <button type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('page_plugin_js')
    <!-- Select2 -->
    <script src="{{ asset('/plugins/select2/select2.full.min.js') }}"></script>
    <!-- iCheck -->
    <script src="{{ asset('/plugins/iCheck/icheck.min.js') }}"></script>
@endsection

@section('page-style')
@endsection

@section('page-script')
    @include('bladejs.movie_create')
@endsection


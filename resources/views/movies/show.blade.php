@extends('layouts.app')

@section('htmlheader_title')
    {{$movie->code}}
@endsection

@section('contentheader_title')
    {{$movie->code}} - {{$movie->name}}
@endsection

@section('main-content')
    <div class="container spark-screen">
        <div class="row">
            <div class="col-md-7">
                <div class="box box-info">
                    <div class="box-body" style="min-height:478px">
                        <img src="{{url('/image?category=movie&type=image&filename='. $movie->image)}}">
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="box box-success">
                    <div class="box-header"><strong class="custom-box-header">Info</strong></div>
                    <div class="box-body">
                        <table class="table">
                            <tr>
                                <th width="30%">ID</th>
                                <td>{{$movie->id}}</td>
                            </tr>
                            <tr>
                                <th>Code</th>
                                <td>{{$movie->code}}</td>
                            </tr>
                            <tr>
                                <th>Name</th>
                                <td>{{$movie->name}}</td>
                            </tr>
                            <tr>
                                <th>Studio</th>
                                <td>{{$movie->studio_id}}</td>
                            </tr>
                            <tr>
                                <th>more info</th>
                                <td>???????</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-2">
                <a href="{{url('movies/' . $movie->id . '/edit')}}"><button class="btn btn-primary btn-block"><i class="fa fa-pencil-square-o"></i>  Edit information</button></a>
            </div>

            <div class="col-md-6">
                @include('movies.partials.cast_table')
            </div>
        </div>
    </div>
@endsection

@section('page-style')
@endsection

@section('page-script')
@endsection
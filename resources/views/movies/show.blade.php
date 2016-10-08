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
            <div class="col-md-5">
                <div class="box box-info">
                    <div class="box-body content-center">
                        <img id="profileImage" class="img-rounded" width="440px" height="480px"
                             src="{{url('/image?category=movie&type=image&filename='. $movie->image)}}">
                        <button id="viewImage" type="button" class="btn btn-clean text-blue"> <i class="fa fa-search"></i> View Thumbnail</button>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="box box-info">
                    <div class="box-header"><strong class="custom-box-header">Info</strong></div>
                    <div class="box-body">
                        <table class="table table-hover table-info">
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
                                <th>Rate</th>
                                <td>{{$movie->rate}}</td>
                            </tr>
                            <tr>
                                <th>Tags</th>
                                <td>@foreach($tags as $tag) {{$tag->name}} @endforeach</td>
                            </tr>
                            <tr>
                                <th>Note</th>
                                <td>{{$movie->note}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-2">
                <a href="{{url('movies/create')}}"><button style="margin-bottom: 5px;" class="btn btn-primary btn-block"><i class="fa fa-plus"></i>  Add Movie</button></a>
                <a href="{{url('movies/' . $movie->id . '/edit')}}"><button class="btn btn-primary btn-block"><i class="fa fa-pencil-square-o"></i>  Edit information</button></a>
                <br />
                @if($movie->link != "")
                <a href="{{$movie->link}}" target="_blank"><button class="btn btn-success btn-block"><i class="fa fa-play"></i>  Watch online</button></a>
                @endif
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
@extends('layouts.app')

@section('htmlheader_title')
    {{$actress->name}}
@endsection

@section('contentheader_title')
    {{$actress->name}}
@endsection

@section('main-content')
    <div class="container spark-screen">
        <div class="row">
            <div class="col-md-5">
                <div class="box box-info">
                    <div class="box-body">
                        <img width="430px" src="{{url('/image?category=actress&type=image&filename='. $actress->image)}}">
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
                                <td>{{$actress->id}}</td>
                            </tr>
                            <tr>
                                <th>Name</th>
                                <td>{{$actress->name}}</td>
                            </tr>
                            <tr>
                                <th>#movie</th>
                                <td>{{$actress->movie_count}}</td>
                            </tr>
                            <tr>
                                <th>more info</th>
                                <td>{{$actress->movie_count}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-2">
                <a href="{{url('actresses/' . $actress->id . '/edit')}}"><button class="btn btn-primary btn-block"><i class="fa fa-pencil-square-o"></i>  Edit profile</button></a>
            </div>

            <div class="col-md-6">
                @include('actresses.partials.cast_in_table')
            </div>
        </div>
    </div>
@endsection

@section('page-style')
@endsection

@section('page-script')
@endsection
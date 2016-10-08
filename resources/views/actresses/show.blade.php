@extends('layouts.app')

@section('htmlheader_title')
    {{$actress->name}}
@endsection

@section('contentheader_title')
    {{$actress->name}}'s Profile
@endsection

@section('main-content')
    <div class="container spark-screen">
        <div class="row">
            <div class="col-md-5">
                <div class="box box-info">
                    <div class="box-body content-center">
                        <img id="profileImage" class="img-rounded" width="440px" height="480px"
                             src="{{url('/image?category=actress&type=image&filename='. $actress->image)}}">
                        <button id="viewImage" type="button" class="btn btn-clean text-blue"> <i class="fa fa-search"></i>  View Avatar</button>
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
                                <td>{{$actress->id}}</td>
                            </tr>
                            <tr>
                                <th>Name</th>
                                <td>{{$actress->name}}</td>
                            </tr>
                            <tr>
                                <th>Other name</th>
                                <td>{{$actress->alias}}</td>
                            </tr>
                            <tr>
                                <th>Birthday</th>
                                <td>@if($actress->dob != '1970-01-01'){{$actress->dob}}@endif</td>
                            </tr>
                            <tr>
                                <th>Debut</th>
                                <td>@if($actress->debut != 0){{$actress->debut}}@endif</td>
                            </tr>
                            <tr>
                                <th>Measurements</th>
                                <td>{{$actress->measurements}}</td>
                            </tr>
                            <tr>
                                <th>Rate</th>
                                <td>{{$actress->rate}}</td>
                            </tr>
                            <tr>
                                <th>Tags</th>
                                <td>@foreach($tags as $tag) {{$tag->name}} @endforeach</td>
                            </tr>
                            <tr>
                                <th>Note</th>
                                <td>{{$actress->note}}</td>
                            </tr>
                            <tr>
                                <th>#movie</th>
                                <td>{{$actress->movie_count}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <a href="{{url('actresses/create')}}"><button style="margin-bottom: 5px;" class="btn btn-primary btn-block"><i class="fa fa-plus"></i>  Add Actress</button></a>
                <a href="{{url('actresses/' . $actress->id . '/edit')}}"><button class="btn btn-primary btn-block"><i class="fa fa-pencil-square-o"></i>  Edit profile</button></a>
                <br />
                <a href="https://www.google.com/search?q={{str_replace(' ', '+', $actress->name)}}+jav" target="_blank"><button class="btn btn-success btn-block"><i class="fa fa-search"></i>  Google her</button></a>
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
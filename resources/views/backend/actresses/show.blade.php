@extends('layouts.app')

@section('htmlheader_title')
    {{$actress->name}}
@endsection

@section('contentheader_title')
    {{$actress->name}}'s Profile
@endsection

@section('main-content')
    <div class="container spark-screen">
        <input type="hidden" id="actressID" value="{{$actress->id}}">
        <div class="row">
            <div class="col-md-3">
                <div class="box box-info">
                    <div class="box-body">
                        <img id="profileImage" class="img-rounded" style="max-width: 100%;" alt="actress profile image"
                             src="@if($actress->thumbnail == ''){{asset('img/no_image.png')}}@elseif(substr($actress->thumbnail, 0, 4) == 'http'){{$actress->thumbnail}}@else{{url('/image?category=actress&type=thumbnail&filename='. $actress->thumbnail)}}@endif">
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="box box-info">
                    <div class="box-header"><strong class="custom-box-header">Infomation</strong></div>
                    <div class="box-body">
                        <table class="table table-hover table-info">
                            <tr>
                                <th>ID</th>
                                <td>{{$actress->id}}</td>
                                <th>Height</th>
                                <td>{{$actress->height}}</td>
                            </tr>
                            <tr>
                                <th>Name</th>
                                <td>{{$actress->name}}</td>
                                <th>Weight</th>
                                <td>{{$actress->weight}}</td>
                            </tr>
                            <tr>
                                <th>Other name</th>
                                <td>{{$actress->alias}}</td>
                                <th>Cup size</th>
                                <td>{{$actress->cup_size}}</td>
                            </tr>
                            <tr>
                                <th>Japanese name</th>
                                <td>{{$actress->jp_name}}</td>
                                <th>Measurements</th>
                                <td>{{$actress->measurements}}</td>
                            </tr>
                            <tr>
                                <th>Birthplace</th>
                                <td>{{$actress->pob}}</td>
                                <th>#movie</th>
                                <td>{{$actress->movie_count}}</td>
                            </tr>
                            <tr>
                                <th>Birthday</th>
                                <td>@if($actress->dob != '1970-01-01'){{$actress->dob}}@endif</td>
                                <th>Point</th>
                                <td>{{$actress->rate}}</td>
                            </tr>
                            <tr>
                                <th>Debut</th>
                                <td colspan="3">{{$actress->debut}}</td>
                            </tr>
                            <tr>
                                <th>Note</th>
                                <td colspan="3">{{$actress->note}}</td>
                            </tr>
                            <tr>
                                <th>Tags</th>
                                <td colspan="3">@foreach($tags as $tag)<span class="tags">{{$tag->name}}</span>@endforeach</td>
                            </tr>
                            <tr>
                                <th>Description</th>
                                <td colspan="3">{{$actress->description}}</td>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <a href="{{url('actresses/create')}}"><button style="margin-bottom: 5px;" class="btn btn-warning btn-block"><i class="fa fa-plus"></i>  Add Actress</button></a>
                <a href="{{url('actresses/' . $actress->id . '/edit')}}"><button class="btn btn-primary btn-block"><i class="fa fa-pencil-square-o"></i>  Edit profile</button></a>
                <br />
                <a href="https://www.google.com/search?q={{str_replace(' ', '+', $actress->name)}}+jav" target="_blank"><button class="btn btn-success btn-block"><i class="fa fa-search"></i>  Google her</button></a><br />
                @if($flaged)
                    <button id="btn-unflag" type="button" class="btn btn-warning btn-block btn-list"><i class="fa fa-flag-o"></i> Flaged</button><br />
                @else
                    <button id="btn-flag" type="button" class="btn btn-danger btn-block btn-list"><i class="fa fa-flag-o"></i> Flag</button><br />
                @endif
            </div>

            <div class="col-md-9">
                @include('backend.actresses.partials.cast_in_table')
            </div>
        </div>
    </div>
    <div class="modal fade" id="md-confirm-remove-movie" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Remove Movie</h4>
                </div>
                <div class="modal-body">
                    <h4><i class="fa fa-trash-o fa-2x text-red" aria-hidden="true"></i> Are you sure you want to remove this movie?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btn-confirm-remove-movie">Yes</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page_style')
    <style>
        #profileImage{
            width: 175px !important;
            height: 238px !important;
            margin-left: 15%;
        }
    </style>
@endsection

@section('page_script')
    @include('bladejs.actress_show')
@endsection
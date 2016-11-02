@extends('layouts.app')

@section('htmlheader_title')
    {{$movie->code}}
@endsection

@section('contentheader_title')
    {{$movie->code}} - {{$movie->name}}
@endsection

@section('main-content')
    <div class="container spark-screen">
        <input type="hidden" id="movieID" value="{{$movie->id}}">
        <div class="row">
            <div class="col-md-9">
                <div class="box box-info">
                    <div class="box-body content-center">
                        <img id="profileImage" width="800px" height="450px" alt="movie image"
                             src="@if(substr($movie->image, 0, 4) == 'http'){{$movie->image}}@else{{url('/image?category=movie&type=image&filename='. $movie->image)}}@endif">
                    </div>
                </div>
            </div>

            <div class="col-md-2" id="stickyheader" style="right: 0;">
                <div class="box box-info" >
                    <div class="box-body content-center">
                        <img id="profileImage" class="img-rounded" style="max-width: 100%;" alt="movie thumbnail"
                             src="@if(substr($movie->thumbnail, 0, 4) == 'http'){{$movie->thumbnail}}@else{{url('/image?category=movie&type=thumbnail&filename='. $movie->thumbnail)}}@endif">
                        <br /><br />
                        <a href="{{url('movies/create')}}"><button class="btn btn-warning btn-block btn-list"><i class="fa fa-plus"></i>  Add Movie</button></a>
                        <a href="#information"><button class="btn btn-primary btn-block btn-list"><i class="fa fa-search"></i> Information</button></a>
                        <a href="{{url('movies/' . $movie->id . '/edit')}}"><button class="btn btn-primary btn-block btn-list"><i class="fa fa-pencil-square-o"></i>  Edit information</button></a>
                        <br />
                        @if($movie->link != "")
                            <a href="{{$movie->link}}" target="_blank"><button class="btn btn-success btn-block"><i class="fa fa-play"></i>  Watch online</button></a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-4" id="information" >
                <div class="box box-info">
                    <div class="box-header"><strong class="custom-box-header">Movie Information</strong></div>
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
                                <th>Release</th>
                                <td>{{$movie->release}}</td>
                            </tr>
                            <tr>
                                <th>Length</th>
                                <td>{{$movie->length}}</td>
                            </tr>
                            <tr>
                                <th>Included in</th>
                                <td>{{$movie->included}}</td>
                            </tr>
                            <tr>
                                <th>Contain</th>
                                <td>{{$movie->contain}}</td>
                            </tr>
                            <tr>
                                <th>Studio</th>
                                <td>{{$movie->studio_id}}</td>
                            </tr>
                            <tr>
                                <th>Point</th>
                                <td>{{$movie->rate}}</td>
                            </tr>
                            <tr>
                                <th>Tags</th>
                                <td>@foreach($tags as $tag)<span class="tags">{{$tag->name}}</span>@endforeach</td>
                            </tr>
                            <tr>
                                <th>Note</th>
                                <td>{{$movie->note}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                @include('backend.movies.partials.cast_table')
            </div>
        </div>
    </div>
    <div class="modal fade" id="md-confirm-remove-actress" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Remove Actress</h4>
                </div>
                <div class="modal-body">
                    <h4><i class="fa fa-trash-o fa-2x text-red" aria-hidden="true"></i> Are you sure you want to remove this actress?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btn-confirm-remove-actress">Yes</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page_style')
@endsection

@section('page_script')
    <script type="text/javascript">
        $(function(){
            // Check the initial Poistion of the Sticky Header
            var stickyHeaderTop = $('#stickyheader').offset().top;

            $('#stickyheader').affix({
                offset: {
                    top: stickyHeaderTop,
                    bottom: 10
                }
            });
        });
    </script>
    @include('bladejs.movie_show')
@endsection
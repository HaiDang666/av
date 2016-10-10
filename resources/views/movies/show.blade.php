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
            <div class="col-md-9">
                <div class="box box-info">
                    <div class="box-body content-center">
                        <img id="profileImage" width="800px" height="450px"
                             src="{{url('/image?category=movie&type=image&filename='. $movie->image)}}">
                    </div>
                </div>
            </div>

            <div class="col-md-2" id="stickyheader" style="right: 0;">
                <div class="box box-info" >
                    <div class="box-body content-center">
                        <img id="profileImage" class="img-rounded" style="max-width: 100%;"
                             src="{{url('/image?category=movie&type=thumbnail&filename='. $movie->thumbnail)}}">
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

            <div class="col-md-5">
                @include('movies.partials.cast_table')
            </div>
        </div>
    </div>
@endsection

@section('page-style')
@endsection

@section('page-script')
    <script type="text/javascript">
        $(function(){
            // Check the initial Poistion of the Sticky Header
            var stickyHeaderTop = $('#stickyheader').offset().top;

            $('#stickyheader').affix({
                offset: {
                    top: stickyHeaderTop,
                    bottom: function () {
                        return (this.bottom = $('.footer').outerHeight(true))
                    }
                }
            })
        });

    </script>
@endsection
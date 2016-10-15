@extends('frontend.app')

@section('htmlheader_title')
    {{$movie->code}}
@endsection

@section('main-content')
    <div class="single-page-agile-main" style="padding-bottom: 0">
        <div class="container">
            <div class="agileits-single-top">
                <ol class="breadcrumb">
                    <li><a href="index.html">Home</a></li>
                    <li>Movies</li>
                    <li class="active">Single</li>
                </ol>
            </div>

            <div class="single-page-agile-info">
                <div class="show-top-grids-w3lagile">
                    <div class="col-sm-8 single-left">
                        <div class="song">
                            <div class="song-info">
                                <h3>{{$movie->code}} - {{$movie->name}}</h3>
                            </div>
                            <div class="video-grid-single-page-agileits">
                                <div data-video="dLmKio67pVQ" id="video">
                                    <img src="@if(substr($movie->image, 0, 7) == 'http://'){{$movie->image}}@else{{url('/image?category=movie&type=image&filename='. $movie->image)}}@endif"
                                         alt="" class="img-responsive" />
                                </div>
                            </div>
                        </div>

                        <div class="song-grid-right"></div>

                        <div class="all-comments">
                            <div class="all-comments-info"></div>
                            <div class="media-grids" style="margin-top: 0">
                                <div class="media" style="margin-bottom: 0">
                                    <h5>MOVIE DETAIL</h5>
                                    <div class="media-left">
                                        <a href="#">
                                            <img src="@if(substr($movie->thumbnail, 0, 7) == 'http://'){{$movie->thumbnail}}@else{{url('/image?category=movie&type=thumbnail&filename='. $movie->thumbnail)}}@endif" title="One movies" alt=" " />
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <table class="table-info table">
                                            <tr>
                                                <th width="15%">Name</th>
                                                <td>{{$movie->name}}</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td>{{$movie->code}}</td>
                                            </tr>
                                            <tr>
                                                <th>Length</th>
                                                <td>{{$movie->length}} min</td>
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
                                                <th>Actresses</th>
                                                <td>@foreach($actresses as $actress)<a href="{{url('actresses/' . str_replace(' ', '_', $actress->name) . '?id='. $actress->id)}}">{{$actress->name}}</a>&nbsp;@endforeach</td>
                                            </tr>
                                            <tr>
                                                <th>Tags</th>
                                                <td>@foreach($tags as $tag)<span class="tags">{{$tag->name}}</span>@endforeach</td>
                                            </tr>
                                            <tr>
                                                <th colspan="2">Description</th>
                                            </tr>
                                            <tr>
                                                <td colspan="2">{{$movie->note}}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="col-md-4 single-right">
                        <h3>Up Next</h3>
                        <div class="single-grid-right">
                            <div class="single-right-grids">
                                <div class="col-md-4 single-right-grid-left">
                                    <a href="single.html"><img src="{{asset('img/m1.jpg')}}" alt="" /></a>
                                </div>
                                <div class="col-md-8 single-right-grid-right">
                                    <a href="single.html" class="title"> Nullam interdum metus</a>
                                    <p class="author"><a href="#" class="author">John Maniya</a></p>
                                    <p class="views">2,114,200 views</p>
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
    <a href="#" id="toTop" style="display: block;"><span id="toTopHover" style="opacity: 0;"></span>To Top</a>
@endsection

@section('page_plugin_css')
@endsection

@section('page_plugin_js')
@endsection

@section('page_style')
    <style>
        .table-info th, .table-info td {
            padding: 2px !important;
        }
    </style>
@endsection

@section('page_script')
@endsection
@extends('frontend.app')

@section('htmlheader_title')
    {{$actress->name}}
@endsection

@section('main-content')
    <div class="single-page-agile-main" style="padding-bottom: 0">
        <div class="container">
            <div class="agileits-single-top">
                <ol class="breadcrumb">
                    <li><a href="index.html">Home</a></li>
                    <li>Actresses</li>
                    <li class="active">Single</li>
                </ol>
            </div>

            <div class="single-page-agile-info">
                <div class="show-top-grids-w3lagile">
                    <div class="col-sm-8 single-left">
                        <div class="all-comments" style="margin-top: 0">
                            <div style="margin-bottom: 10px">
                                <h2>{{$actress->name}} Information</h2>
                            </div>

                            <div class="media-grids" style="margin-top: 0">
                                <div class="media" style="margin-bottom: 0">
                                    <div class="media-left">
                                        <a href="#">
                                            <img src="@if(substr($actress->image, 0, 7) == 'http://'){{$actress->image}}@else{{url('/image?category=actress&type=image&filename='. $actress->image)}}@endif"
                                                 title="{{$actress->name}}" alt=" " class="img-rounded" />
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <table class="table-info table">
                                            <tr>
                                                <th>Name</th>
                                                <td>{{$actress->name}}</td>
                                                <th>Rate</th>
                                                <td>{{$actress->rate}}</td>
                                            </tr>
                                            <tr>
                                                <th>Other name</th>
                                                <td>{{$actress->alias}}</td>
                                                <th>Height</th>
                                                <td>{{$actress->height}}</td>
                                            </tr>
                                            <tr>
                                                <th>Japanese name</th>
                                                <td>{{$actress->jp_name}}</td>
                                                <th>Weight</th>
                                                <td>{{$actress->weight}}</td>
                                            </tr>
                                            <tr>
                                                <th>Birthplace</th>
                                                <td>{{$actress->pob}}</td>
                                                <th>Cup size</th>
                                                <td>{{$actress->cup_size}}</td>
                                            </tr>
                                            <tr>
                                                <th>Birthday</th>
                                                <td>@if($actress->dob != '1970-01-01'){{$actress->dob}}@endif</td>
                                                <th>Measurements</th>
                                                <td>{{$actress->measurements}}</td>
                                            </tr>
                                            <tr>
                                                <th>Debut</th>
                                                <td>{{$actress->debut}}</td>
                                                <th>#movie</th>
                                                <td>{{$actress->movie_count}}</td>
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
                            <hr>
                            <div style="margin-bottom: 10px; margin-top: 20px">
                                <h2>Filmography</h2>
                            </div>

                            <div class="w3_agile_featured_movies">
                                @if($movies->total() == 0)
                                    <i><h5>No such thing here</h5></i>
                                @endif
                                @foreach($movies as $movie)
                                    <div class="col-md-2 w3l-movie-gride-agile">
                                        <a href="{{url('movies/' . $movie->code . '?id='. $movie->id)}}" class="hvr-shutter-out-horizontal">
                                            <img src="@if(substr($movie->thumbnail, 0, 7) == 'http://'){{$movie->thumbnail}}@else{{url('/image?category=movie&type=thumbnail&filename='. $movie->thumbnail)}}@endif"
                                                 title="{{$movie->note}}" class="img-responsive" alt=" " />
                                            <div class="w3l-action-icon"><i class="fa fa-play-circle" aria-hidden="true"></i></div>
                                        </a>
                                        <div class="mid-1 agileits_w3layouts_mid_1_home">
                                            <div class="w3l-movie-text">
                                                <h6><a href="{{url('movies/' . $movie->code)}}">{{$movie->code}}</a></h6>
                                            </div>
                                        </div>
                                        <div class="ribben">
                                            <p>NEW</p>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="clearfix"> </div>
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
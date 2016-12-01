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
                    <div class="col-sm-12 single-left">
                        <div class="all-comments" style="margin-top: 0">
                            <div class="all-comments-info"></div>
                            <div class="song">
                                <div class="song-info">
                                    <h2>{{$movie->code}} - {{$movie->name}}</h2>
                                </div>
                                <div class="video-grid-single-page-agileits" align="center">
                                    <div data-video="dLmKio67pVQ" id="video">
                                        <img src="@if(substr($movie->image, 0, 4) == 'http'){{$movie->image}}@else{{url('/image?category=movie&type=image&filename='. $movie->image)}}@endif"
                                             alt="" class="img-responsive img-image-size" />
                                    </div>
                                </div>
                            </div>
                            <div class="media-grids" style="margin-top: 0">
                                <div class="media" style="margin-bottom: 0">
                                    <h2>Movie Information - <?php
                                        switch ($movie->studio_id){
                                            case 1:
                                                $link = 'http://www.caribbeancom.com/moviepages/'.$movie->code.'/index.html';
                                                break;
                                            case 2:
                                                $link = 'http://www.heyzo.com/moviepages/'.$movie->code.'/index.html';
                                                break;
                                            case 3:
                                                $link = 'http://www.10musume.com/moviepages/'.$movie->code.'/index.html';
                                                break;
                                            case 4:
                                                $link = 'http://www.1pondo.tv/movies/'.$movie->code.'/';
                                                break;
                                            case 5:
                                                $link = 'http://www.caribbeancompr.com/moviepages/'.$movie->code.'/index.html';
                                                break;
                                        }
                                        echo '<a href='.$link.'>Official link</a>';
                                        ?></h2>
                                    <div class="media-left">
                                        <a href="#">
                                            <img src="@if(substr($movie->thumbnail, 0, 4) == 'http'){{$movie->thumbnail}}@else{{url('/image?category=movie&type=thumbnail&filename='. $movie->thumbnail)}}@endif"
                                                 class="img-thumbnail-size" title="One movies" alt=" " />
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <table class="table-info table">
                                            <tr>
                                                <th width="15%">Name</th>
                                                <td>{{$movie->note}}</td>
                                            </tr>
                                            <tr>
                                                <th>Code</th>
                                                <td>{{$movie->code}}</td>
                                            </tr>
                                            <tr>
                                                <th>Starting</th>
                                                <td>@foreach($actresses as $actress)<a href="{{url('actresses/' . str_replace(' ', '_', $actress->name) . '?id='. $actress->id)}}">{{$actress->name}}</a>&nbsp;@endforeach</td>
                                            </tr>
                                            <tr>
                                                <th>Length</th>
                                                <td>{{$movie->length}} min</td>
                                            </tr>
                                            <tr>
                                                <th>Release</th>
                                                <td>{{$movie->release}}</td>
                                            </tr>
                                            <tr>
                                                <th>Series</th>
                                                <td>{{$movie->series_id}}</td>
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
                                                <td>@foreach($tags as $tag)<span class="tags">{{$tag->name}}&nbsp;</span>@endforeach</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            @if($movie->studio_id != 5)
                            <hr>
                            <div style="margin-bottom: 10px; margin-top: 20px">
                                <h2>Images review</h2>
                                <div class="table-images-review">
                                    <table class="table">
                                        <tbody>
                                            <tr id="images_review">
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @endif
                            <hr>
                            <div style="margin-bottom: 10px; margin-top: 20px">
                                <h2>Related Movies</h2>
                            </div>

                            <div class="w3_agile_featured_movies">
                                @foreach($movies as $movie_)
                                    <div class="col-md-2 w3l-movie-gride-agile">
                                        <a href="{{url('movies/' . $movie_->code . '?id='. $movie_->id)}}" class="hvr-shutter-out-horizontal">
                                            <img src="@if(substr($movie_->thumbnail, 0, 4) == 'http'){{$movie_->thumbnail}}@else{{url('/image?category=movie&type=thumbnail&filename='. $movie_->thumbnail)}}@endif"
                                                 title="{{$movie_->note}}" class="img-responsive img-movie-thumbnail-small" alt=" " />
                                            <div class="w3l-action-icon"><i class="fa fa-play-circle" aria-hidden="true"></i></div>
                                        </a>
                                        <div class="mid-1 agileits_w3layouts_mid_1_home">
                                            <div class="w3l-movie-text">
                                                <h6><a href="{{url('movies/' . $movie_->code)}}">{{$movie_->code}}</a></h6>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="clearfix"> </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
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
        .table-info{
            margin-left: 30px;
        }
        .table-info th, .table-info td {
            padding: 2px !important;
        }
        .single-left{
            padding-right: 0 !important;
        }
        .table-images-review td{
            height: 130px;
            width: 130px;
            padding: 0;
            text-align: center;
        }
    </style>
@endsection

@section('page_script')
    @include('bladejs.movie_show_fe')
@endsection
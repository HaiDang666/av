@extends('frontend.app')

@section('htmlheader_title')
    Movies
@endsection

@section('main-content')
    {{-- movies list --}}
    <div class="general">
        <div class="container">
            <div class="agileits-news-top">
                <ol class="breadcrumb">
                    <li><a href="{{url('/home')}}">Home</a></li>
                    <li class="active">Movies</li>
                </ol>
            </div>
        </div>
        <h4 class="latest-text w3_latest_text">Movies</h4>
        <div class="container">
            <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
                <div id="myTabContent" class="tab-content">
                    {{-- latest --}}
                    <div role="tabpanel" class="tab-pane fade active in" id="latest" aria-labelledby="latest-tab">
                        <div class="w3_agile_featured_movies">
                            @foreach($movies as $movie)
                                <div class="col-md-2 w3l-movie-gride-agile">
                                    <a href="{{url('movies/' . $movie->code . '?id='. $movie->id)}}" class="hvr-shutter-out-horizontal">
                                        <img src="@if(substr($movie->thumbnail, 0, 4) == 'http'){{$movie->thumbnail}}@else{{url('/image?category=movie&type=thumbnail&filename='. $movie->thumbnail)}}@endif"
                                             title="{{$movie->note}}" class="img-responsive img-thumbnail-size" alt="" />
                                        <div class="w3l-action-icon"><i class="fa fa-play-circle" aria-hidden="true"></i></div>
                                    </a>
                                    <div class="mid-1 agileits_w3layouts_mid_1_home">
                                        <div class="w3l-movie-text">
                                            <h6><a href="{{url('movies/' . $movie->code)}}">{{$movie->name}}</a></h6>
                                        </div>
                                        <div class="mid-2 agile_mid_2_home">
                                            <p>{{$movie->code}}</p>
                                            {!! \app\UIBuilder\AppTemplate::stars($movie->rate) !!}
                                            <div class="clearfix"></div>
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
                </div>
                <div style="float: right;">
                    {!! $movies->render() !!}
                </div>
            </div>
        </div>
    </div>
    {{-- //movies list --}}

    <a href="#" id="toTop" style="display: block;"><span id="toTopHover" style="opacity: 0;"></span>To Top</a>
@endsection

@section('page_plugin_css')
@endsection

@section('page_plugin_js')

@endsection

@section('page_style')
@endsection

@section('page_script')
@endsection
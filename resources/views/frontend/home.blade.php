@extends('frontend.app')

@section('htmlheader_title')
    Home
@endsection

@section('main-content')
    @include('frontend.partials.banner')

    {{-- movies list --}}
    <div class="general">
        <h4 class="latest-text w3_latest_text">Movies</h4>
        <div class="container">
            <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
                <ul id="myTab" class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#latest" id="latest-tab" role="tab" data-toggle="tab" aria-controls="latest" aria-expanded="true">Featured</a></li>
                    <li role="presentation"><a href="#viewed" role="tab" id="viewed-tab" data-toggle="tab" aria-controls="viewed" aria-expanded="false">Top viewed</a></li>
                    <li role="presentation"><a href="#rating" role="tab" id="rating-tab"  data-toggle="tab" aria-controls="rating" aria-expanded="true">Top Rating</a></li>
                    <li role="presentation"><a href="#added" role="tab" id="added-tab" data-toggle="tab" aria-controls="added" aria-expanded="false">Recently Added</a></li>
                </ul>
                <div id="myTabContent" class="tab-content">
                    {{-- latest --}}
                    <div role="tabpanel" class="tab-pane fade active in" id="latest" aria-labelledby="latest-tab">
                        <div class="w3_agile_featured_movies">
                            @foreach($latestMovies as $movie)
                                <div class="col-md-2 w3l-movie-gride-agile">
                                    <a href="{{url('movies/' . $movie->code . '?id='. $movie->id)}}" class="hvr-shutter-out-horizontal">
                                        <img src="@if(substr($movie->thumbnail, 0, 7) == 'http://'){{$movie->thumbnail}}@else{{url('/image?category=movie&type=thumbnail&filename='. $movie->thumbnail)}}@endif"
                                             title="{{$movie->note}}" class="img-responsive" alt=" " />
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
                    {{-- top viewed --}}
                    <div role="tabpanel" class="tab-pane fade" id="viewed" aria-labelledby="viewed-tab">
                        @foreach($topViewedMovies as $movie)
                            <div class="col-md-2 w3l-movie-gride-agile">
                                <a href="{{url('movies/' . $movie->code . '?id='. $movie->id)}}" class="hvr-shutter-out-horizontal">
                                    <img src="@if(substr($movie->thumbnail, 0, 7) == 'http://'){{$movie->thumbnail}}@else{{url('/image?category=movie&type=thumbnail&filename='. $movie->thumbnail)}}@endif"
                                         title="{{$movie->note}}" class="img-responsive" alt=" " />
                                    <div class="w3l-action-icon"><i class="fa fa-play-circle" aria-hidden="true"></i></div>
                                </a>
                                <div class="mid-1 agileits_w3layouts_mid_1_home">
                                    <div class="w3l-movie-text">
                                        <h6><a href="{{url('movies/' . $movie->code)}}">{{$movie->name}}</a></h6>
                                    </div>
                                    <div class="mid-2 agile_mid_2_home">
                                        <p>{{$movie->code}}</p>
                                        <div class="block-stars"><i class="fa fa-eye" aria-hidden="true"></i> {{$movie->views}}</div>
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
                    {{-- top rating --}}
                    <div role="tabpanel" class="tab-pane fade" id="rating" aria-labelledby="rating-tab">
                        <div class="col-md-2 w3l-movie-gride-agile">
                            <a href="#" class="hvr-shutter-out-horizontal"><img src="{{ asset('img/m15.jpg') }}" title="album-name" class="img-responsive" alt=" " />
                                <div class="w3l-action-icon"><i class="fa fa-play-circle" aria-hidden="true"></i></div>
                            </a>
                            <div class="mid-1 agileits_w3layouts_mid_1_home">
                                <div class="w3l-movie-text">
                                    <h6><a href="#">Light B/t Oceans</a></h6>
                                </div>
                                <div class="mid-2 agile_mid_2_home">
                                    <p>2016</p>
                                    <div class="block-stars">
                                        <ul class="w3l-ratings">
                                            <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                                            <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                                            <li><a href="#"><i class="fa fa-star" aria-hidden="true"></i></a></li>
                                            <li><a href="#"><i class="fa fa-star-half-o" aria-hidden="true"></i></a></li>
                                            <li><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="ribben">
                                <p>NEW</p>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    {{-- recently added --}}
                    <div role="tabpanel" class="tab-pane fade" id="added" aria-labelledby="added-tab">
                        @foreach($recentlyAddedMovies as $movie)
                            <div class="col-md-2 w3l-movie-gride-agile">
                                <a href="{{url('movies/' . $movie->code . '?id='. $movie->id)}}" class="hvr-shutter-out-horizontal">
                                    <img src="@if(substr($movie->thumbnail, 0, 7) == 'http://'){{$movie->thumbnail}}@else{{url('/image?category=movie&type=thumbnail&filename='. $movie->thumbnail)}}@endif"
                                         title="{{$movie->note}}" class="img-responsive" alt=" " />
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
        </div>
    </div>
    {{-- //movies list --}}

    <a href="#" id="toTop" style="display: block;"><span id="toTopHover" style="opacity: 0;"></span>To Top</a>
@endsection

@section('page_plugin_css')
@endsection

@section('page_plugin_js')
    <!-- banner -->
    <script src="{{ asset('js/jquery.slidey.js') }}"></script>
    <script src="{{ asset('js/jquery.dotdotdot.min.js') }}"></script>
    <!-- pop-up-box -->
    <script src="{{ asset('js/jquery.magnific-popup.js') }}" type="text/javascript"></script>
    <!-- bottom-banner -->
    <script src="{{ asset('js/owl.carousel.js') }}" type="text/javascript"></script>
@endsection

@section('page_style')
@endsection

@section('page_script')
    <!-- banner -->
    <script type="text/javascript">
        $("#slidey").slidey({
            interval: 8000,
            listCount: 5,
            autoplay: false,
            showList: true
        });
        $(".slidey-list-description").dotdotdot();
    </script>

    <script>
        $(document).ready(function() {
            <!-- bottom-banner -->
            $('#owl-demo').owlCarousel({

                autoPlay: 3000, //Set AutoPlay to 3 seconds

                items : 5,
                itemsDesktop : [640,4],
                itemsDesktopSmall : [414,3]

            });
        });
    </script>
@endsection
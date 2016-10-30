{{-- Most movie --}}
<div class="Latest-tv-series" id="remind_movies">
    <h4 class="latest-text w3_latest_text w3_home_popular">REMIND MOVIES</h4>
    <div class="container">
        <section class="slider">
            <div class="flexslider">
                <ul class="slides">
                    @foreach($todayMovies as $movie)
                    <li>
                        <div class="agile_tv_series_grid">
                            <div class="col-md-6 agile_tv_series_grid_left">
                                <div class="w3ls_market_video_grid1">
                                    <img src="@if(substr($movie->image, 0, 7) == 'http://'){{$movie->image}}@else{{url('/image?category=movie&type=image&filename='. $movie->image)}}@endif"
                                         alt="" class="img-responsive img-slide-size" />
                                    <a class="w3_play_icon" href="#small-dialog">
                                        <span class="glyphicon glyphicon-play-circle" aria-hidden="true"></span>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6 agile_tv_series_grid_right">
                                <p class="fexi_header">{{$movie->code}} - {{$movie->name}}</p>
                                <p class="fexi_header_para">
                                    <span>Starting: </span>
                                    @foreach($movie->included as $actress)
                                        <a href="{{url('actresses/' . str_replace(' ', '_', $actress->name) . '?id='. $actress->id)}}">{{$actress->name}}&nbsp;</a>
                                    @endforeach
                                </p><br />
                                <p class="fexi_header_para"><span>Date of Release: </span> {{$movie->release}} </p><br />
                                <p class="fexi_header_para">
                                    <span>Genres: </span>
                                    @foreach($movie->contain as $tag)
                                        <a href="{{url('tags/' . str_replace(' ', '_', $tag->name) . '?id='. $tag->id)}}">{{$tag->name}}&nbsp;</a>
                                    @endforeach
                                </p> <br />
                                <p class="fexi_header_para"><span>Star Rating: </span>
                                    {{$movie->rate}}
                                </p>
                            </div>
                            <div class="clearfix"> </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </section>
    </div>
</div>
<div id="small-dialog" class="mfp-hide">
    <iframe src=""></iframe>
</div>
<div id="small-dialog1" class="mfp-hide">
    <iframe src=""></iframe>
</div>
<div id="small-dialog2" class="mfp-hide">
    <iframe src=""></iframe>
</div>
{{-- //Most movie --}}
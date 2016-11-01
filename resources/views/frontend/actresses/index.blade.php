@extends('frontend.app')

@section('htmlheader_title')
    Actresses
@endsection

@section('main-content')
    {{-- actresses list --}}
    <div class="general">
        <div class="container">
            <div class="agileits-news-top">
                <ol class="breadcrumb">
                    <li><a href="{{url('/home')}}">Home</a></li>
                    <li class="active">Actresses</li>
                </ol>
            </div>
        </div>
        <h4 class="latest-text w3_latest_text">Actresses</h4>
        <div class="container">
            <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
                <div id="myTabContent" class="tab-content">
                    {{-- latest --}}
                    <div role="tabpanel" class="tab-pane fade active in" id="latest" aria-labelledby="latest-tab">
                        <div class="w3_agile_featured_movies">
                            @foreach($actresses as $actress)
                                <div class="col-md-2 w3l-movie-gride-agile">
                                    <a href="{{url('actresses/' . str_replace(' ', '_', $actress->name) . '?id='. $actress->id)}}" class="hvr-shutter-out-horizontal">
                                        <img src="@if($actress->thumbnail == ''){{asset('img/no_image.png')}}@elseif(substr($actress->thumbnail, 0, 4) == 'http'){{$actress->thumbnail}}@else{{url('/image?category=actress&type=thumbnail&filename='. $actress->thumbnail)}}@endif"
                                             title="{{$actress->name}}" class="img-responsive img-thumbnail-size" alt="" />
                                    </a>
                                    <div class="mid-1 agileits_w3layouts_mid_1_home">
                                        <div class="w3l-movie-text">
                                            <h6><a href="{{url('actresses/' . str_replace(' ', '_', $actress->name) . '?id='. $actress->id)}}">{{$actress->name}}</a></h6>
                                        </div>
                                        <div class="mid-2 agile_mid_2_home">
                                            <p>{{$actress->dob}}</p>
                                            {!! \app\UIBuilder\AppTemplate::stars($actress->rate) !!}
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="clearfix"> </div>
                        </div>
                    </div>
                </div>
                <div style="float: right;">
                    {!! $actresses->render() !!}
                </div>
            </div>
        </div>
    </div>
    {{-- //actresses list --}}

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
@extends('layouts.app')

@section('htmlheader_title')
	Dashboard
@endsection

@section('contentheader_title')
    Dashboard
@endsection

@section('main-content')
	<div class="container spark-screen">
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{ $totalActress }}</h3>
                        <p>Total Actress</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-smile-o"></i>
                    </div>
                    <a href="{{ url('actresses') }}" target="_blank" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>{{ $totalMovie }}</h3>
                        <p>Total Movie</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-film"></i>
                    </div>
                    <a href="{{url('movies')}}"  target="_blank" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>44</h3>

                        <p>User Registrations</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-venus-double"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

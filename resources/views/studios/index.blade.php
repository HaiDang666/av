@extends('layouts.app')

@section('htmlheader_title')
    Studios
@endsection

@section('contentheader_title')
    Studio List
@endsection

@section('main-content')
    <div class="container spark-screen">
        <div class="row">
            <div class="col-md-10">
                <div class="box">
                    <div class="box-body">
                        @foreach($studios as $studio)
                            {{$studio->name}}
                            <br />
                        @endforeach
                        <br />
                    </div>
                    <div class="box-footer clearfix">
                        {{$studios->render()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-style')
    @include('cssjs.studio')
@endsection
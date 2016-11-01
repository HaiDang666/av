<input type="hidden" id="inactionMovie" value="">
<div class="box box-info">
    <div class="box-header"><strong class="custom-box-header">Filmography</strong></div>
    <div class="box-body">
        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <th style="width: 2%">ID</th>
                <th>Thumbnail</th>
                <th>Name</th>
                <th>Code</th>
                <th>Studio</th>
                <th>Stored</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @if($movies->total() == 0)
                <tr>
                    <td colspan="7">No such thing here</td>
                </tr>
            @endif
            @foreach($movies as $movie)
                <tr id="movie{{$movie->id}}">
                    <td>{{$movie->id}}</td>
                    <td><a href="{{url('movies/'. $movie->id)}}" target="_blank"><img width="80px" height="100px" alt="movie thumbnail" src="@if(substr($movie->thumbnail, 0, 4) == 'http'){{$movie->thumbnail}}@else{{url('/image?category=movie&type=thumbnail&filename='. $movie->thumbnail)}}@endif" /></a></td>
                    <td>{{$movie->name}}</td>
                    <td>{{$movie->code}}</td>
                    <td>{{$movie->studio_id}}</td>
                    <td>{{$movie->stored}}</td>
                    <td>
                        <button type="button" class="btn btn-block btn-danger clear-padding text-white btn-remove-movie" data-id="{{$movie->id}}">
                            <i class="fa fa-trash-o"></i> remove</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="box-footer clearfix">
        {{$movies->render()}}
    </div>
</div>
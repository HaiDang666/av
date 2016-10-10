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
                <tr>
                    <td>{{$movie->id}}</td>
                    <td><a href="{{url('movies/'. $movie->id)}}" target="_blank"><img width="80px" height="100px" src="{{url('/image?category=movie&type=thumbnail&filename='. $movie->thumbnail)}}" /></a></td>
                    <td>{{$movie->name}}</td>
                    <td>{{$movie->code}}</td>
                    <td>{{$movie->studio_id}}</td>
                    <td>{{$movie->stored}}</td>
                    <td>
                        <button type="button" class="btn-link clear-padding text-red btn-delete-movie" data-id="{{$movie->id}}">
                            <i class="fa fa-trash-o"></i></button>
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
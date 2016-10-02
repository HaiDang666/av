<input type="hidden" id="inactionMovie" value="">
<div class="box box-info">
    <div class="box-body">
        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <th style="width: 2%">ID</th>
                <th>Thumbnail</th>
                <th>Code</th>
                <th>Name</th>
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
                    <td><a href="{{url('movies/'. $movie->id)}}" target="_blank"><img width="60px" height="60px" src="{{url('/image?category=movie&type=thumbnail&filename='. $movie->thumbnail)}}" /></a></td>
                    <td>{{$movie->code}}</td>
                    <td>{{$movie->name}}</td>
                    <td>{{$movie->studio_id}}</td>
                    <td>{{$movie->stored}}</td>
                    <td>
                        <a href="{{url('movies/'. $movie->id . '/edit')}}" target="_blank"><button type="button" class="btn-link clear-padding btn-edit-movie" data-id="{{$movie->id}}">
                            <i class="fa fa-pencil"></i></button></a>
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
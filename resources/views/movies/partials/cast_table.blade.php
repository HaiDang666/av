<input type="hidden" id="inactionActress" value="">
<div class="box box-info">
    <div class="box-header"><strong class="custom-box-header">Cast</strong></div>
    <div class="box-body">
        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <th style="width: 2%">ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>#m</th>
                <th>Updated</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @if(count($actresses) == 0)
                <tr>
                    <td colspan="6">No such thing here</td>
                </tr>
            @endif
            @foreach($actresses as $actress)
                <tr id="actress{{$actress->id}}">
                    <td>{{$actress->id}}</td>
                    <td><a href="{{url('actresses/' . $actress->id)}}" target="_blank"><img width="80px" height="100px" alt="act avatar" src="{{url('/image?category=actress&type=thumbnail&filename='. $actress->thumbnail)}}"/></a></td>
                    <td>{{$actress->name}}</td>
                    <td>{{$actress->movie_count}}</td>
                    <td>{{$actress->updated_at->format('Y-m-d')}}</td>
                    <td>
                        <button type="button" class="btn btn-block btn-danger clear-padding text-white btn-remove-actress" data-id="{{$actress->id}}">
                            <i class="fa fa-trash-o"></i> remove</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
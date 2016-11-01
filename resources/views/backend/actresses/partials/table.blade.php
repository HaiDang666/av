<input type="hidden" id="inactionActress" value="">
<div class="box box-info">
    <div class="box-body">
        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <th style="width: 2%">ID</th>
                <th style="width: 12%">Image</th>
                <th>Name</th>
                <th>#movie</th>
                <th>Updated</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @if($actresses->total() == 0)
                <tr>
                    <td colspan="6">No such thing here</td>
                </tr>
            @endif
            @foreach($actresses as $actress)
                <tr>
                    <td>{{$actress->id}}</td>
                    <td><a href="{{url('actresses/' . $actress->id)}}" target="_blank"><img width="80px" height="100px" alt="actress avatar" src="@if($actress->thumbnail == ''){{asset('img/no_image.png')}}@elseif(substr($actress->thumbnail, 0, 4) == 'http'){{$actress->thumbnail}}@else{{url('/image?category=actress&type=thumbnail&filename='. $actress->thumbnail)}}@endif"/></a></td>
                    <td>{{$actress->name}}</td>
                    <td>{{$actress->movie_count}}</td>
                    <td>{{$actress->updated_at}}</td>
                    <td>
                        <a href="{{url('actresses/' . $actress->id . '/edit')}}" target="_blank"><button type="button" class="btn-link clear-padding">
                            <i class="fa fa-pencil"></i></button></a>
                        <button type="button" class="btn-link clear-padding text-red btn-delete-actress" data-id="{{$actress->id}}">
                            <i class="fa fa-trash-o"></i></button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="box-footer clearfix">
        {{$actresses->render()}}
    </div>
</div>
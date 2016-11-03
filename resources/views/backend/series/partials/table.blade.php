<input type="hidden" id="inactionSeries" value="">
<div class="box box-info">
    <div class="box-body">
        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>#movie</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @if($series->total() == 0)
                <tr>
                    <td colspan="4">No such thing here</td>
                </tr>
            @endif
            @foreach($series as $seri)
                <tr>
                    <td>{{$seri->id}}</td>
                    <td><a href="{{url('series/'.$seri->id)}}" target="_blank">{{$seri->name}}</a></td>
                    <td>{{$seri->movie_count}}</td>
                    <td>
                        <button type="button" class="btn-link clear-padding btn-edit-seri" data-id="{{$seri->id}}">
                            <i class="fa fa-pencil"></i></button>
                        <button type="button" class="btn-link clear-padding text-red btn-delete-seri" data-id="{{$seri->id}}" data-toggle="modal">
                            <i class="fa fa-trash-o"></i></button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="box-footer clearfix">
        {{$series->render()}}
    </div>
</div>
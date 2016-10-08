<input type="hidden" id="inactionTag" value="">
<div class="box box-info">
    <div class="box-body">
        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @if($tags->total() == 0)
                <tr>
                    <td colspan="4">No such thing here</td>
                </tr>
            @endif
            @foreach($tags as $tag)
                <tr>
                    <td>{{$tag->id}}</td>
                    <td><a href="{{url('tags/'.$tag->id)}}" target="_blank">{{$tag->name}}</a></td>
                    <td>
                        <button type="button" class="btn-link clear-padding btn-edit-tag" data-id="{{$tag->id}}">
                            <i class="fa fa-pencil"></i></button>
                        <button type="button" class="btn-link clear-padding text-red btn-delete-tag" data-id="{{$tag->id}}" data-toggle="modal">
                            <i class="fa fa-trash-o"></i></button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="box-footer clearfix">
        {{$tags->render()}}
    </div>
</div>
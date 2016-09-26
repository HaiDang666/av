<input type="hidden" id="inactionStudio" value="">
<div class="box box-info">
    <div class="box-body">
        <table class="table table-striped table-bordered  table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>#Movies</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @if($studios->total() == 0)
                <tr>
                    <td colspan="4">No such thing here</td>
                </tr>
            @endif
            @foreach($studios as $studio)
                <tr>
                    <td>{{$studio->id}}</td>
                    <td>{{$studio->name}}</td>
                    <td>{{$studio->movie_count}}</td>
                    <td>
                        <button type="button" class="btn-link clear-padding btn-edit-studio" data-id="{{$studio->id}}">
                            <i class="fa fa-pencil"></i></button>
                        <button type="button" class="btn-link clear-padding text-red btn-delete-studio" data-id="{{$studio->id}}" data-toggle="modal">
                            <i class="fa fa-trash-o"></i></button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="box-footer clearfix">
        {{$studios->render()}}
    </div>
</div>
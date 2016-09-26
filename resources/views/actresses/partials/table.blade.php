<input type="hidden" id="inactionActress" value="">
<div class="box box-info">
    <div class="box-body">
        <table class="table table-striped table-bordered table-hover">
            <thead>
            <tr>
                <th style="width: 2%">ID</th>
                <th>Thumbnail</th>
                <th>Name</th>
                <th>#Movies</th>
                <th>Updated</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @if($actresses->total() == 0)
                <tr>
                    <td colspan="5">No such thing here</td>
                </tr>
            @endif
            @foreach($actresses as $actress)
                <tr>
                    <td>{{$actress->id}}</td>
                    <td><img width="130px" height="160px" src="https://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=120" /></td>
                    <td>{{$actress->name}}</td>
                    <td>{{$actress->movie_count}}</td>
                    <td>{{$actress->updated_at}}</td>
                    <td>
                        <button type="button" class="btn-link clear-padding btn-edit-actress" data-id="{{$actress->id}}">
                            <i class="fa fa-pencil"></i></button>
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
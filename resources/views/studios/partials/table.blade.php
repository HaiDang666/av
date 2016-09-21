<div class="box box-info">
    <div class="box-body">
        <table class="table-striped table-bordered table table-hover">
            <thead>
            <tr>
                <td>ID</td>
                <td>Name</td>
                <td>#Movies</td>
                <td>Action</td>
            </tr>
            </thead>
            <tbody>
            @foreach($studios as $studio)
                <tr>
                    <td>{{$studio->id}}</td>
                    <td>{{$studio->name}}</td>
                    <td>{{$studio->movie_count}}</td>
                    <td>edit/delete</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="box-footer clearfix">
        {{$studios->render()}}
    </div>
</div>
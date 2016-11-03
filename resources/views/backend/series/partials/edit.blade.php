<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">Edit Series</h3>
    </div>
    <input type="hidden" id="seriesID" value="{{$series->id}}">
    <form class="form-horizontal" id="frm-edit-series">
        {!! csrf_field() !!}
        <div class="box-body">
            <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">Name</label>

                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputName" name="name" placeholder="Enter series name" required pattern=".*\S.*" title="at least 1 character" value="{{$series->name}}">
                </div>
            </div>
        </div>
        <div class="box-footer">
            <button class="btn btn-info center btn-block">Update</button>
            <button type="button" class="btn btn-danger center btn-block" id="btn-cancel-edit">Cancel</button>
        </div>
    </form>
</div>

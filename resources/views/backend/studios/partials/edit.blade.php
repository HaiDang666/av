<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">Edit Studio</h3>
    </div>
    <input type="hidden" id="studioID" value="{{$studio->id}}">
    <form class="form-horizontal" id="frm-edit-studio">
        {!! csrf_field() !!}
        <div class="box-body">
            <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">Name</label>

                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputName" name="name" placeholder="Enter studio name" required pattern=".*\S.*" title="at least 1 character" value="{{$studio->name}}">
                </div>
            </div>
        </div>
        <div class="box-footer">
            <button class="btn btn-info center btn-block">Update</button>
            <button type="button" class="btn btn-danger center btn-block" id="btn-cancel-edit">Cancel</button>
        </div>
    </form>
</div>

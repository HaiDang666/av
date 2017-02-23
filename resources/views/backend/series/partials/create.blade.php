<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">Add Series</h3>
    </div>
    <form class="form-horizontal" id="frm-add-series">
        {!! csrf_field() !!}
        <div class="box-body">
            <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">Name</label>

                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputName" name="name" placeholder="Enter series name" required pattern=".*\S.*" title="at least 1 character">
                </div>
            </div>
        </div>
        <div class="box-footer">
            <button class="btn btn-info center btn-block">Add</button>
        </div>
    </form>
</div>

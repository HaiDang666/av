<div class="modal fade" id="md-add-actress" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="frm-add-actress">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Add Actress</h4>
                </div>
                <div class="modal-body">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Name</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputName" name="name" placeholder="Enter actress name" required pattern=".*\S.*" title="at least 1 character">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="thumbnail">Thumbnail</label>
                        <input type="file" id="thumbnail" name="thumbnail">
                    </div>

                    <div class="form-group">
                        <label for="image">Big Image</label>
                        <input type="file" id="image" name="image">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
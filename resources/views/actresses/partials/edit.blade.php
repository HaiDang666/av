<div class="modal fade" id="md-edit-actress" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="frm-edit-actress">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Edit Actress</h4>
                </div>
                <div class="modal-body">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <label for="inputNameEdit" class="col-sm-2 control-label">Name</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputNameEdit" name="name" placeholder="Enter actress name" required pattern=".*\S.*" title="at least 1 character">
                        </div>
                    </div>

                    <div>
                        old thumbnail
                    </div>

                    <div class="form-group">
                        <label for="thumbnailEdit">Thumbnail</label>
                        <input type="file" id="thumbnailEdit" name="thumbnail">
                    </div>

                    <div>
                        old imange
                    </div>

                    <div class="form-group">
                        <label for="image">Big Image</label>
                        <input type="file" id="imageEdit" name="image">
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
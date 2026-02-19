<div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
        <form class="form form-horizontal" method="POST" action="{{ route('admin.manage-color.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add</h4>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label class="label-control label">Name <span class="required">*</span></label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="col-sm-12">
                        <label class="label-control label">Code <span class="required">*</span></label>
                        <input type="color" class="form-control" name="code" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </form>
    </div>
</div>

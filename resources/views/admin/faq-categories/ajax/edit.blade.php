<div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
        <form class="form form-horizontal" id="updatefaqc" method="POST" action="{{ route('admin.manage-faq-category.update', $faq_category->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit</h4>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label class="label-control label">Name <span class="required">*</span></label>
                        <input type="text" class="form-control" name="name" value="{{ $faq_category->name }}" >
                        <div class="text-danger" id="name-err"></div>
                    </div>
                </div>
              
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary update-data-btn">Submit</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </form>
    </div>
</div>

<div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <form class="form form-horizontal">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add</h4>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="label-control label">Name <span class="required">*</span></label>
                        <input type="text" class="form-control" placeholder="Enter Name" name="name" id="name">
                        <div class="text-danger" id="name-err"></div>
                    </div>
                    @if($language)
                    <div class="col-sm-6">
                        <label class="label-control label">Name Ar<span class="required">*</span></label>
                        <input type="text" class="form-control" placeholder="Enter Name Arabic" name="name_ar" id="name_ar">
                        <div class="text-danger" id="name_ar-err"></div>
                    </div>
                    @endif
                    <div class="col-sm-6">
                        <label class="label-control label">Designation <span class="required">*</span></label>
                        <input type="text" class="form-control" placeholder="Enter Designation" name="designation" id="designation">
                        <div class="text-danger" id="designation-err"></div>
                    </div>
                    @if($language)
                    <div class="col-sm-6">
                        <label class="label-control label">Designation Ar <span class="required">*</span></label>
                        <input type="text" class="form-control" placeholder="Enter Designation Ar" name="designation_ar" id="designation_ar">
                        <div class="text-danger" id="designation_ar-err"></div>
                    </div>
                    @endif
                </div>

                <div class="form-group row">
                <div class="col-md-4" id="imgpr" style="display:none">
                        <img src="#" class="img-fluid" id="preview-image" style="height:100px;">
                    </div>
                    <div class="col-md-4">
                        <label class="label-control label">Image <span class="required">*</span></label>
                        <input type="file" class="form-control" name="image" id="image">
                        <div class="text-danger" id="image-err"></div>
                    </div>
                </div>
           
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="add-team-btn">Add</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        </div>
    </form>
</div>
<script>
    CKEDITOR.replace('content', {
        filebrowserUploadUrl: "{{ route('admin.image-upload', ['_token' => csrf_token()]) }}",
        filebrowserUploadMethod: 'form'
    });

    $('#image').change(function(){
           
           let reader = new FileReader();
           reader.onload = (e) => { 
             $('#preview-image').attr('src', e.target.result); 
           }
           reader.readAsDataURL(this.files[0]); 
           $("#imgpr").css('display','block');
         
          });

</script>

<style>
    .modal-body {
    height: 80vh;
    overflow-y: auto;
}
</style>

<div class="modal-dialog">
    <!-- Modal content-->
    <form class="form form-horizontal">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">EDIT</h4>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="label-control label">Promotion Name <span class="required">*</span></label>
                        <input type="text" class="form-control" placeholder="Enter Name" name="name" id="name" value="{{ $promotion->name }}">
                        <div class="text-danger" id="name-err"></div>
                    </div>
                    @if($language)
                    <div class="col-sm-6">
                        <label class="label-control label">Promotion Name Ar <span class="required">*</span></label>
                        <input type="text" class="form-control" placeholder="Enter Oil Grade Name Arabic" name="name_ar" id="name_ar" value="{{ $promotion->name_ar }}">
                        <div class="text-danger" id="name_ar-err"></div>
                    </div>
                    @endif
                        <div class="col-sm-6">
                        <label class="label-control label">Promotion Validity Till <span class="required">*</span></label>
                        <input type="date" class="form-control" placeholder="Enter Validity Date" name="validity" id="validity" onchange="TDate()" value="{{ $promotion->validity }}">
                        <div class="text-danger" id="validity-err"></div>
                    </div>
                    <div class="col-sm-6">
                        <label class="label-control label">Promotion URL <span class="required">*</span></label>
                        <input type="text" class="form-control" placeholder="Enter URL" name="url" id="url" value="{{ $promotion->url }}">
                        <div class="text-danger" id="url-err"></div>
                    </div>

                    <div class="col-sm-6">
                        <label class="label-control label">Promotion Image <span class="required">*</span><span class="text-danger">(Image Size 500*500)</span></label>
                        <input type="file" class="form-control"  name="image" id="image" >
                        <div class="text-danger" id="image-err"></div>
                    </div>

                   
                    <div class="col-sm-12">
                        <label class="label-control label">Promotion Detail <span class="required">*</span></label>
                         <textarea class="form-control" id="detail">{{$promotion->detail}}</textarea>
                        <div class="text-danger" id="detail-err"></div>
                    </div>
                     @if($language)
                    <div class="col-sm-12">
                        <label class="label-control label">Promotion Detail Ar <span class="required">*</span></label>
                         <textarea class="form-control" id="detail">{{$promotion->detail_ar}}</textarea>
                        <div class="text-danger" id="detail_ar-err"></div>
                    </div>
                    @endif

                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="update-promotion-btn" promotion_id="{{ $promotion->id }}">Submit</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </form>
</div>
<script>
    CKEDITOR.replace('detail', {
        filebrowserUploadUrl: "{{ route('admin.image-upload', ['_token' => csrf_token()]) }}",
        filebrowserUploadMethod: 'form'
    });
    
    function TDate() {
    var UserDate = document.getElementById("validity").value;
    var ToDate = new Date();

    if (new Date(UserDate).getTime() < ToDate.getTime()) {
          alert("The Date must be Bigger than today date");
          document.getElementById("validity").value=""
          return false;
     }
    return true;
}
</script>

<form class="form form-horizontal" method="POST" action="{{ route('admin.product-option-image', $product->id) }}" enctype="multipart/form-data">
        @csrf
<div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Upload</h4>
            </div>
            <div class="modal-body">

            <div class="gallery-btn-area text-center">
          <a style="cursor: pointer;" class="btn btn-info gallery-btn mr-5" id="prod_gallery1"><i class="fa fa-download"></i> Upload Images</a>
          <a style="cursor: pointer; background: #009432;" class="btn btn-info gallery-btn mr-5" data-bs-dismiss="modal"><i class="fa fa-check"></i> Done</a>
          <p style="font-size: 11px;">You can upload multiple images.</p>
         
          <input style="display: none;" type="file" accept="image/*" id="uploadgallery1" name="gallery[]" multiple />
          <input type="hidden" name="fleet_id" value="" id="pid">
        </div>
            <div class="gallery-wrap" id="gallery-wrap1">
         
          <div class="row">

          @foreach($product['product_option_images'] as $data)
          <div class="col-sm-4">
          <div class="gallery__img">
          <img src="{{asset('storage/'.$data->image)}}" class="img-fluid" alt="gallery image">
          <div class="gallery-close close1">
            <input type="hidden" value="{{$data->id}}">
            <i class="fa fa-window-close"></i></div></div></div>
              @endforeach
          </div>
        </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    
</div>
</form>
<script>
  $(document).on('click', '.close1', function() {
    var id = $(this).find('input[type=hidden]').val();
    $('#galval1' + id).remove();
    $(this).parent().parent().remove();
  });


  $(document).on('click', '#prod_gallery1', function() {
    $('#uploadgallery1').click();
    // $('#gallery-wrap1 .row').html('');
    // $('#form1').find('.removegal1').val(0);
  });


  $("#uploadgallery1").change(function() {
    var total_file = document.getElementById("uploadgallery1").files.length;
    for (var i = 0; i < total_file; i++) {
      $('#gallery-wrap1 .row').append('<div class="col-sm-4">' +
        '<div class="gallery__img">' +
        '<img src="' + URL.createObjectURL(event.target.files[i]) + '" class="img-fluid" alt="gallery image">' +
        '<div class="gallery-close close1">' +
        '<input type="hidden" value="' + i + '">' +
        '<i class="fa fa-window-close"></i>' +
        '</div>' +
        '</div>' +
        '</div>');
      $('#form1').append('<input type="hidden" name="galval[]" id="galval1' + i + '" class="removegal1" value="' + i + '">')
    }

  });

  $(document).on('click', '.gallery-close' ,function() {
  var pid = $(this).find('input[type=hidden]').val();
    $(this).parent().parent().remove();
          $.ajax({
                type: "GET",
                url:"{{route('admin.gallery.delete')}}",
                data:{id:pid}
              });
});




  



</script>
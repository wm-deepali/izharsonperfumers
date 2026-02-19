<div id="loader" class="loading-div loader" style="display:none;">
</div>
<footer class="footer footer-static footer-light navbar-border">
    <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2"><span class="float-md-left d-xs-block d-md-inline-block">Copyright &copy; 2022 <a href="{{url('/')}}">IZHARSON PERFUMERS</a>, All rights reserved. </span><span class="float-md-right d-xs-block d-md-inline-block hidden-md-down">Hand-crafted &amp; Made with <i class="ft-heart pink"></i></span></p>
</footer>

<!-- BEGIN VENDOR JS-->
<script src="{{ URL::asset('admin/vendors/js/vendors.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('admin/js/core/app-menu.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('admin/js/core/app.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('admin/js/scripts/customizer.min.js') }}" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous"></script>
<script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="{{ URL::asset('admin/js/jquery-ui.min.js') }}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.10.4/sweetalert2.min.js" integrity="sha512-EPNolNCOFmcnNzDqK7E4Wdwo9KBt/HCP/J8bmK6uSik6YsoLU1b8XGbg5hpw2BY+IilYjf1ce5t7rCuHB60mzA==" crossorigin="anonymous"></script>
<!--<script src="{{ URL::asset('admin/js/datatable.js') }}" type="text/javascript"></script>-->

<script src="{{ URL::asset('admin/js/newCustom.js') }}" type="text/javascript"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.0/dropzone.js"></script>
<!--<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>-->
<script src="https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ajaxStart(function() {
        $("#loader").modal('show');
    });
    $(document).ajaxComplete(function() {
        $("#loader").modal('hide');
    });
</script>
<script>
   $(document).ready(function() {
    $('#example').dataTable({
        "order": [[ 0, "desc" ]],
         searching: true
    });
    $('#for_all').dataTable({
        "order": [[ 0, "desc" ]],
         searching: true
    });
    $('#example1').dataTable({
         "order": [[ 0, "desc" ]],
         searching: true
    });
    $('#example2').dataTable({
         "order": [[ 0, "desc" ]],
         searching: true
    });
    $('#example3').dataTable({
         "order": [[ 0, "desc" ]],
         searching: true
    });
    $('#example4').dataTable({
         "order": [[ 0, "desc" ]],
         searching: true
    });
    $('#example5').dataTable({
         "order": [[ 0, "desc" ]],
         searching: true
    });
     $('#example6').dataTable({
         "order": [[ 0, "asc" ]],
         searching: true
    });
    
    var table = $('#example7').DataTable({
		searching: true,
		paging:true,
		select: false,
		info: false,
		lengthChange:false ,
		language: {
			paginate: {
			  previous: "Previous",
			  next: "Next"
			}
		  }

	})

} );
</script>
</body>

</html>

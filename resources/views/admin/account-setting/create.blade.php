<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Branch </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top:-25px">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <div class="modal-body">
         <form id="addressform">
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-4 col-12">
               <div class="wdinput form-group">
                   <label>Branch Name</label>
                    <input type="email" class="form-control" placeholder="Enter Branch Name" name="name">
                    <div class="text-danger validation-err" id="name-err">
                                                        </div>
               </div>
           </div>
           
                <div class="col-xl-4 col-lg-4 col-md-4 col-12">
               <div class="wdinput form-group">
                   <label>Country</label>
                   <select class="form-control" id="countrys" name="country">
                    <option value="">Select Country</option>
                    @foreach($countrys as $country)
                     <option value="{{$country->id}}">{{$country->name}}</option>
                    @endforeach
                </select>
                <div class="text-danger validation-err" id="country-err">
                                                        </div>
               </div>
           </div>
           
           <div class="col-xl-4 col-lg-4 col-md-4 col-12">
               <div class="wdinput form-group">
                   <label>State</label>
                    <select id="states" class="form-control" name="state">
                            
                    </select>
                    <div class="text-danger validation-err" id="state-err">
                                                        </div>
               </div>
           </div>
                
                 <div class="col-xl-4 col-lg-4 col-md-4 col-12">
               <div class="wdinput form-group">
                   <label>City</label>
                   <select id="cities" class="form-control" name="city">
                            
                    </select>
                    <div class="text-danger validation-err" id="city-err">
                                                        </div>
               </div>
           </div>
           
           <div class="col-xl-4 col-lg-6 col-md-6 col-12">
               <div class="wdinput form-group">
                   <label>Zip Code</label>
                    <input type="email" class="form-control" placeholder="Enter Zip Code" name="zip_code">
                    <div class="text-danger validation-err" id="zip_code-err">
                                                        </div>
               </div>
           </div>
                
            <div class="col-xl-4 col-lg-4 col-md-4 col-12">
               <div class="wdinput form-group">
                   <label>Email Id</label>
                    <input type="email" class="form-control" placeholder="Enter Email" name="email">
                    <div class="text-danger validation-err" id="email-err">
                                                        </div>
               </div>
           </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-12">
               <div class="wdinput form-group">
                   <label>Whatsapp Number</label>
                    <input type="text" class="form-control" placeholder="Enter Whatsapp Number" name="whatsapp_number">
                    <div class="text-danger validation-err" id="whatsapp_number-err">
                                                        </div>
               </div>
           </div>
           <div class="col-xl-4 col-lg-4 col-md-4 col-12">
               <div class="wdinput form-group">
                   <label>Contact Number</label>
                    <input type="text" class="form-control" placeholder="Enter Contact Number" name="contact_number">
                    <div class="text-danger validation-err" id="contact_number-err">
                                                        </div>
               </div>
           </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-12">
               <div class="wdinput form-group">
                   <label>Status</label>
                     <select class="form-control" name="status" id="status">
                            <option value="active">Active</option>
                            <option value="block">De-Active</option>
                        </select>
                   <div class="text-danger" id="status-err"></div>
               </div>
           </div>
           
           <div class="col-xl-12 col-lg-6 col-md-6 col-12">
               <div class="wdinput form-group">
                   <label>Google Map Location(Iframe)</label>
                    <textarea class="form-control" name="map_url"></textarea>
                    <div class="text-danger validation-err" id="map_url-err">
                                                        </div>
               </div>
           </div>
            

           <div class="col-xl-12 col-lg-12 col-md-6 col-12">
               <div class="wdinput form-group">
                    <label>Full Address</label>
                    <textarea class="form-control" name="address"></textarea>
                    <div class="text-danger validation-err" id="address-err">
                                                        </div>
               </div>
           </div>
        </div>
        
        
        <div class="modal-footer">
            <button type="button" class="btn adminbtn-blue add-address-btn">Submit</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  <script>
      $('#countrys').on('change', function () {
                var idCountry = this.value;
                $("#state").html('');
                $.ajax({
                    url: "{{url('admin/fetch-states')}}",
                    type: "POST",
                    data: {
                        country_id: idCountry,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#states').html('<option value="">-- Select State --</option>');
                        $.each(result.states, function (key, value) {
                            $("#states").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                        $('#cities').html('<option value="">-- Select City --</option>');
                    }
                });
            });
            $('#states').on('change', function () {
                var idState = this.value;
                $("#cities").html('');
                $.ajax({
                    url: "{{url('admin/fetch-cities')}}",
                    type: "POST",
                    data: {
                        state_id: idState,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (res) {
                        console.log(res)
                        $('#cities').html('<option value="">-- Select City --</option>');
                        $.each(res.cities, function (key, value) {
                            $("#cities").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                    }
                });
            });
  </script>
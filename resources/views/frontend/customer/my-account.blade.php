 @extends('frontend.includes.main')
@section('title','My Account ')
@section('content')

<section class="py-3 bg-light">
      <div class="container">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb custom-breadcumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('listing')}}">Shop</a></li>
            <li class="breadcrumb-item active" aria-current="page">Account Setting</li>
          </ol>
        </nav>
      </div>
    </section>

    <section>
      <div class="container">
        <div class="dashboard-flex-section d-flex my-3">
        @include('frontend.customer.dashboard_side_bar')
          <div class="dashboard-right-section border">
            <div class="d-flex border-bottom ">
            <h1 class="h5 font-weight-medium pb-2">Account Setting</h1>
            </div>    
                  <div class="dasboard-box mt-3">
                  <div id="error_message"></div>
                  <form id="my-account-form" enctype="multipart/form-data" method="post">
                        <div class="row">
                            <div class="col-6">
                                <div class="wdinput form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Name" name="name" id="name" value="{{ $customer->name }}">
                                    <div class="text-danger validation-err" id="name-err"></div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="wdinput form-group">
                                    <label>Email Id</label>
                                    <input type="email" class="form-control" placeholder="Enter Email Address" name="email" id="email" value="{{ $customer->email }}">
                                    <div class="text-danger validation-err" id="email-err"></div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="wdinput form-group">
                                    <label>Mobile Number</label>
                                    <input type="number" class="form-control" placeholder="Enter Mobile Number" name="mobile_number" id="mobile_number" value="{{ $customer->mobile_number }}">
                                    <div class="text-danger validation-err" id="mobile_number-err"></div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="wdinput form-group">
                                    <label>Referral Code</label>
                                    <input type="text" class="form-control" placeholder="Referral Code" name="referral_code" id="referral_code" value="{{ $customer->referral_code }}" disabled>
                                    <div class="text-danger validation-err" id="referral_code-err"></div>
                                </div>
                            </div>

                             <div class="col-6">
                                <div class="wdinput form-group">
                                    <label>Profile Image</label>
                                      
                                      <input type="file" class="form-control-file" name="image" id="image" placeholder="Choose Image">

                                       @if (isset($customer->image) && Storage::exists($customer->image))

                                          <img src="{{ URL::asset('storage/' . $customer->image) }}" alt="" width="100" height="100" class="rounded-circle mb-2" style="margin-top: 5px;">

                                     @endif

                                       <div class="text-danger validation-err" id="image-err"></div>
                                </div>
                            </div>

                         
                            <div class="col-md-6">
                                <button class="btn bg-dark text-white" type="button" id="update-my-account-btn">Update</button>
                            </div>
                        </div>
                    </form>
                
                  
          </div>

        </div>
        <button class="filter-btn btn" id="filterbtn"><i class="fa fa-bars"></i> </button>
        </div>
      </div>
    </section>

    <script>
    $(document).ready(function() {
        $(document).on('click', '#update-my-account-btn', function(event) {
            $(this).attr('disabled', true);
            $('.validation-err').html('');
            let name = $('#my-account-form #name').val();
            let email = $('#my-account-form #email').val();
            let mobile_number = $('#my-account-form #mobile_number').val();
            
            let formData = new FormData();
            formData.append('name', name);
            formData.append('email', email);
            formData.append('mobile_number', mobile_number);
            formData.append('image', (typeof $('#my-account-form #image')[0].files[0] == 'undefined') ? '' : $('#my-account-form #image')[0].files[0]);

            $.ajax({
                url: "{{ URL::to('my-account') }}",
                type: 'POST',
                processData: false,
                contentType: false,
                dataType: 'json',
                data: formData,
                context: this,
                success: function(result) {
                    if (result.success) {
                        swal("Success!", "Updated", "success");
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    } else {
                        $(this).attr('disabled', false);
                        if (result.code == 422) {
                            for (const key in result.errors) {
                                $(`#my-account-form #${key}-err`).html(result.errors[key][0]);
                            }
                        } else {
                            console.log(result);
                        }
                    }
                }
            });
        });
    })
</script>

@endsection
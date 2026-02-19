  @extends('frontend.includes.main')
@section('title','Change Password')
@section('content')
    <section class="py-3 bg-light">
      <div class="container">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb custom-breadcumb">
             <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('listing') }}">Shop</a></li>
            <li class="breadcrumb-item active" aria-current="page">Change Password</li>
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
            <h1 class="h5 font-weight-medium pb-2">Change Password</h1>
            </div>    
                  <div class="dasboard-box mt-3">
                  <div id="error_message"></div>
                  <form id="change-password-form">
                        <div class="row">
                            <div class="col-12">
                                <div class="wdinput form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" placeholder="Current Password" name="password" id="password">
                                    <div class="text-danger validation-err" id="password-err"></div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="wdinput form-group">
                                    <label for="new_password">New Password</label>
                                    <input type="password" class="form-control" placeholder="New Password" name="new_password" id="new_password">
                                    <div class="text-danger validation-err" id="new_password-err"></div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="wdinput form-group">
                                    <label for="new_password_confirmation">Confirm Password</label>
                                    <input type="password" class="form-control" placeholder="New Password Confirmation" name="new_password_confirmation" id="new_password_confirmation">
                                    <div class="text-danger validation-err" id="new_password_confirmation-err"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <button class="btn bg-dark text-white" type="button" id="update-password-btn">Update</button>
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
        $(document).on('click', '#update-password-btn', function(event) {
            $(this).attr('disabled', true);
            $('.validation-err').html('');
            let password = $('#change-password-form #password').val();
            let new_password = $('#change-password-form #new_password').val();
            let new_password_confirmation = $('#change-password-form #new_password_confirmation').val();
            let formData = new FormData();
            formData.append('password', password);
            formData.append('new_password', new_password);
            formData.append('new_password_confirmation', new_password_confirmation);
            $.ajax({
                url: "{{ URL::to('change-password') }}",
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
                                $(`#change-password-form #${key}-err`).html(result.errors[key][0]);
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
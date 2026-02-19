 @extends('frontend.includes.main')
@section('title','My Address List')
@section('content')


    <section class="py-3 bg-light">
      <div class="container">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb custom-breadcumb">
          <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('listing')}}">Shop</a></li>
            <li class="breadcrumb-item active" aria-current="page">My Address Book</li>
          </ol>
        </nav>
      </div>
    </section>

    <section>
      <div class="container">
        <div class="dashboard-flex-section d-flex my-3">
           @include('frontend.customer.dashboard_side_bar')
         <div class="dashboard-right-section border">
              <!--   <div class="d-flex border-bottom ">
                    <h1 class="h5 font-weight-medium pb-2">My Address Book</h1>
                    <button class="btn ml-auto" id="add-address"><i class="fa fa-plus"> </i> Address Book</button>
                </div> -->
                <div class="dasboard-box">
                    <div class="address-book-flex">
                        @if (isset($customer_addresses) && count($customer_addresses) > 0)
                            @foreach ($customer_addresses as $customer_address)
                                <div class="address-bbok-box position-relative">
                                    <div class="name-location d-flex">
                                        <h5>{{ $customer_address->name }}</h5>
                                        <h6 class="ml-auto">{{ $customer_address->address_type }}</h6>
                                    </div>
                                    <p>{{ $customer_address->address }}, {{ $customer_address->city }}, {{ $customer_address->state }} , {{ $customer_address->country }} - {{ $customer_address->pincode }}</p>
                                    <button class="edit-button btn address-book-edit edit-address" customer_address_id="{{ $customer_address->id }}"><i class="fa fa-edit"> </i> </button>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        <button class="filter-btn btn" id="filterbtn"><i class="fa fa-bars"></i> </button>
        </div>
      </div>
    </section>
<div class="modal fade" id="address-modal" tabindex="-1" role="dialog" aria-labelledby="addaddressbookpopup" aria-hidden="true">
</div>
    <script>
    $(document).ready(function() {
        $(document).on('click', '#add-address', function(event) {
            $.ajax({
                url: "{{ URL::to('customer-address') }}",
                type: "GET",
                dataType: "json",
                success: function(result) {
                    if (result.success) {
                        $("#address-modal").html(result.html);
                        $("#address-modal").modal('show');
                    } else {

                    }
                }
            });
        });

        $(document).on('click', '#add-address-btn', function(event) {
            $(this).attr('disabled', true);
            $('.validation-err').html('');
            let name = $('#address-form #name').val();
            let email = $('#address-form #email').val();
            let mobile_number = $('#address-form #mobile_number').val();
            let country = $('#address-form #country').val();
            let state = $('#address-form #state').val();
            let city = $('#address-form #city').val();
            let pincode = $('#address-form #pincode').val();
            let address = $('#address-form #address').val();
            let address_type = $('input[name=address_type]:checked').val();
            let formData = new FormData();
            formData.append('name', name);
            formData.append('email', email);
            formData.append('mobile_number', mobile_number);
            formData.append('country', country);
            formData.append('state', state);
            formData.append('city', city);
            formData.append('pincode', pincode);
            formData.append('address', address);
            formData.append('address_type', address_type);
            $.ajax({
                url: "{{ URL::to('customer-address') }}",
                type: 'POST',
                processData: false,
                contentType: false,
                dataType: 'json',
                data: formData,
                context: this,
                success: function(result) {
                    if (result.success) {
                        swal("Success!", "Added", "success");
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    } else {
                        $(this).attr('disabled', false);
                        if (result.code == 422) {
                            for (const key in result.errors) {
                                $(`#address-form #${key}-err`).html(result.errors[key][0]);
                            }
                        } else {
                            console.log(result);
                        }
                    }
                }
            });
        });

        $(document).on('click', '.edit-address', function(event) {
            let customer_address_id = $(this).attr('customer_address_id');
            $.ajax({
                url: `{{ URL::to('customer-address/${customer_address_id}') }}`,
                type: "GET",
                dataType: "json",
                success: function(result) {
                    if (result.success) {
                        $("#address-modal").html(result.html);
                        $("#address-modal").modal('show');
                    } else {

                    }
                }
            });
        });

        $(document).on('click', '#update-address-btn', function(event) {
            $(this).attr('disabled', true);
            $('.validation-err').html('');
            let name = $('#address-form #name').val();
            let email = $('#address-form #email').val();
            let mobile_number = $('#address-form #mobile_number').val();
            let country = $('#address-form #country').val();
            let state = $('#address-form #state').val();
            let city = $('#address-form #city').val();
            let pincode = $('#address-form #pincode').val();
            let address = $('#address-form #address').val();
            let address_type = $('input[name=address_type]:checked').val();
            let formData = new FormData();
            formData.append('name', name);
            formData.append('email', email);
            formData.append('mobile_number', mobile_number);
            formData.append('country', country);
            formData.append('state', state);
            formData.append('city', city);
            formData.append('pincode', pincode);
            formData.append('address', address);
            formData.append('address_type', address_type);
            let customer_address_id = $(this).attr('customer_address_id');
            $.ajax({
                url: `{{ URL::to('customer-address/${customer_address_id}') }}`,
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
                                $(`#address-form #${key}-err`).html(result.errors[key][0]);
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
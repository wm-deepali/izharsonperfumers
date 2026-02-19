<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addaddressbookpopup">Address</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div id="error_message"></div>
            <form id="address-form">
                <div class="row">
                    <div class="col-12">
                        <div class="wdinput form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" placeholder="Enter Name" name="name" id="name" value="{{ $customer_address->name }}">
                            <div class="text-danger validation-err" id="name-err"></div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="wdinput form-group">
                            <label>Email Id</label>
                            <input type="email" class="form-control" placeholder="Enter Email Address" name="email" id="email" value="{{ $customer_address->email }}">
                            <div class="text-danger validation-err" id="email-err"></div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="wdinput form-group">
                            <label>Mobile Number</label>
                            <input type="number" class="form-control" placeholder="Enter Mobile Number" name="mobile_number" id="mobile_number" value="{{ $customer_address->mobile_number }}">
                            <div class="text-danger validation-err" id="mobile_number-err"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="wdinput form-group">
                            <label>Country</label>
                            <input type="text" class="form-control" placeholder="Enter Country" name="country" id="country" value="{{ $customer_address->country }}">
                            <div class="text-danger validation-err" id="country-err"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="wdinput form-group">
                            <label>State </label>
                            <input type="text" class="form-control" placeholder="Enter State" name="state" id="state" value="{{ $customer_address->state }}">
                            <div class="text-danger validation-err" id="state-err"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="wdinput form-group">
                            <label>City </label>
                            <input type="text" class="form-control" placeholder="Enter City" name="city" id="city" value="{{ $customer_address->city }}">
                            <div class="text-danger validation-err" id="city-err"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="wdinput form-group">
                            <label>ZipCode / PinCode</label>
                            <input type="text" class="form-control" placeholder="Enter Zipcode / PinCode" name="pincode" id="pincode" value="{{ $customer_address->pincode }}">
                            <div class="text-danger validation-err" id="pincode-err"></div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="wdinput form-group">
                            <label>Full Address </label>
                            <textarea class="form-control" rows="4" placeholder="Enter Full Address" name="address" id="address">{{ $customer_address->address }}</textarea>
                            <div class="text-danger validation-err" id="address-err"></div>
                        </div>
                    </div>
                    <div class="col-md-6 d-flex align-items-center">
                        <div class="wdinput form-group">
                            <label class="custom-radio-btn ml-2 d-inline-block">Home
                                <input type="radio" class="address_type" name="address_type" value="home" @if ($customer_address->address_type == 'home') checked @endif>
                                <span class="checkmark"></span>
                            </label>
                            <label class="custom-radio-btn ml-2 d-inline-block ">Office
                                <input type="radio" class="address_type" name="address_type" value="office" @if ($customer_address->address_type == 'office') checked @endif>
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <button class="btn bg-dark text-white" type="button" id="update-address-btn" customer_address_id="{{ $customer_address->id }}">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

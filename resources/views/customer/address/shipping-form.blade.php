<div id="shippingFormBox" class="card p-3 mt-3 d-none">

    <h5 class="mb-3">Add / Edit Shipping Address</h5>

    <form id="shippingForm">
        @csrf

        <input type="hidden" name="id" id="shipping_id">

        <div class="row">

            <div class="col-md-6 mb-2">
                <input type="text" name="name" id="shipping_name" class="form-control" placeholder="Full Name" required>
            </div>

            <div class="col-md-6 mb-2">
                <input type="text" name="mobile_number" id="shipping_mobile" class="form-control"
                    placeholder="Mobile Number" required>
            </div>
            
             <div class="col-md-6 mb-2">
                <input type="email" name="email" id="billing_email" class="form-control" placeholder="Email" required>
            </div>


            <div class="col-md-12 mb-2">
                <textarea name="address" id="shipping_address" class="form-control" placeholder="Address"
                    required></textarea>
            </div>

            <div class="col-md-4 mb-2">

                <select id="shipping_country" name="country" class="form-control" required>

                    <option value="">Country</option>

                    @foreach($countries as $country)
                        <option value="{{ $country->id }}">
                            {{ $country->name }}
                        </option>
                    @endforeach

                </select>

            </div>

            <div class="col-md-4 mb-2">

                <select id="shipping_state" name="state" class="form-control" required>

                    <option value="">State</option>

                </select>

            </div>

            <div class="col-md-4 mb-2">

                <select id="shipping_city" name="city" class="form-control" required>

                    <option value="">City</option>

                </select>

            </div>

            <div class="col-md-4 mb-2">

                <input type="text" name="pincode" id="shipping_pincode" class="form-control" placeholder="Pincode"
                    required>

            </div>

        </div>

        <button type="submit" class="btn btn-dark btn-sm mt-2">
            Save Address
        </button>

        <button type="button" class="btn btn-secondary btn-sm mt-2" onclick="closeShippingForm()">
            Cancel
        </button>

    </form>

</div>
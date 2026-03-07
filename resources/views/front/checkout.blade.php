@extends('front.app')

@section('title', 'Page Vendor List')

@section('content')


  <!-- Inner Page Breadcrumb -->
  <section class="inner_page_breadcrumb">
    <div class="container">
      <div class="row">
        <div class="col-xl-6">
          <div class="breadcrumb_content">
            <ol class="breadcrumb">

              <li class="breadcrumb-item">
                <a href="{{ url('/') }}">Home</a>
              </li>

              <li class="breadcrumb-item">
                <a href="{{ url('/cart') }}">Cart</a>
              </li>

              <li class="breadcrumb-item active" aria-current="page">
                Checkout
              </li>

            </ol>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Shop Checkouts Content -->
  <section class="shop-checkouts pt30">
    <div class="container">
      <div class="row">
        <div class="col-sm-6 col-lg-4 m-auto">
          <div class="main-title text-center mb50">
            <h2 class="title">Checkout</h2>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-8 col-xl-9">
          <div class="checkout_form style2">

            <!-- ================= BILLING ADDRESS ================= -->

            <h4 class="title mb20">Billing Address</h4>

            <div class="mb-3">
              <button type="button" class="btn btn-outline-dark btn-sm" id="addBilling">
                + Add Billing Address
              </button>
            </div>

            @if($billingAddresses->count())
              @foreach($billingAddresses as $addr)
                <div class="border rounded p-3 mb-2 bg-white">

                  <label class="d-flex justify-content-between">

                    <div>
                      <input type="radio" name="billing_address_id" value="{{ $addr->id }}" class="me-2 billingSelect"
                        data-address='@json($addr->toArray())'>

                      <strong>{{ $addr->name }}</strong><br>
                      {{ $addr->address }}<br>
                      {{ $addr->cities->name ?? '' }}, {{ $addr->states->name ?? '' }} - {{ $addr->pincode }}<br>
                      📞 {{ $addr->mobile_number }}
                    </div>

                    <button type="button" class="btn btn-sm btn-outline-secondary editBillingBtn"
                      data-address='@json($addr->toArray())'>
                      Edit
                    </button>

                  </label>

                </div>
              @endforeach
            @else
              <p class="text-muted">No billing address found. Please add one.</p>
            @endif


            <!-- Billing Add/Edit Form -->
            <div id="billingFormBox" class="card p-3 mt-3 d-none">
              <h5 class="mb-3">Add / Edit Billing Address</h5>

              <form id="billingForm">
                @csrf
                <input type="hidden" name="id" id="billing_id">

                <div class="row">
                  <div class="col-md-6 mb-2">
                    <input type="text" name="name" id="billing_name" class="form-control" placeholder="Full Name"
                      required>
                  </div>

                  <div class="col-md-6 mb-2">
                    <input type="text" name="mobile_number" id="billing_mobile" class="form-control"
                      placeholder="Mobile Number" required>
                  </div>

                  <div class="col-md-6 mb-2">
                    <input type="email" name="email" id="billing_email" class="form-control" placeholder="Email">
                  </div>

                  <div class="col-md-6 mb-2">
                    <select name="address_type" id="billing_type" class="form-control">
                      <option value="home">Home</option>
                      <option value="office">Office</option>
                    </select>
                  </div>

                  <div class="col-md-12 mb-2">
                    <textarea name="address" id="billing_address" class="form-control" placeholder="Address"
                      required></textarea>
                  </div>

                  <div class="col-md-4 mb-2">
                    <select id="billing_country" name="country" class="form-control" required>
                      <option value="">Country</option>
                      @foreach($countries as $country)
                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="col-md-4 mb-2">
                    <select id="billing_state" name="state" class="form-control" required>
                      <option value="">State</option>
                    </select>
                  </div>

                  <div class="col-md-4 mb-2">
                    <select id="billing_city" name="city" class="form-control" required>
                      <option value="">City</option>
                    </select>
                  </div>

                  <div class="col-md-4 mb-2">
                    <input type="text" name="pincode" id="billing_pincode" class="form-control" placeholder="Pincode"
                      required>
                  </div>
                </div>

                <button type="submit" class="btn btn-dark btn-sm mt-2">Save Address</button>
                <button type="button" class="btn btn-secondary btn-sm mt-2" onclick="closeBillingForm()">Cancel</button>
              </form>
            </div>



            <!-- ================= SHIPPING ADDRESS ================= -->

            <h4 class="title mb20 mt-4">Shipping Address</h4>

            <div class="ui_kit_checkbox mb-3">
              <label class="custom_checkbox">
                Same as Billing Address
                <input type="checkbox" id="sameAsBilling">
                <span class="checkmark"></span>
              </label>
            </div>

            <div id="shippingSection">

              <div class="mb-3">
                <button type="button" class="btn btn-outline-dark btn-sm" id="addShipping">
                  + Add Shipping Address
                </button>
              </div>

              @if($shippingAddresses->count())
                @foreach($shippingAddresses as $addr)
                  <div class="border rounded p-3 mb-2 bg-white">

                    <label class="d-flex justify-content-between">

                      <div>
                        <input type="radio" name="shipping_address_id" value="{{ $addr->id }}" class="me-2 shippingSelect"
                          data-address='@json($addr->toArray())'>

                        <strong>{{ $addr->name }}</strong><br>
                        {{ $addr->address }}<br>
                        {{ $addr->cities->name ?? '' }}, {{ $addr->states->name ?? '' }} - {{ $addr->pincode }}<br>
                        📞 {{ $addr->mobile_number }}
                      </div>

                      <button type="button" class="btn btn-sm btn-outline-secondary editShippingBtn"
                        data-address='@json($addr->toArray())'>
                        Edit
                      </button>

                    </label>

                  </div>
                @endforeach
              @else
                <p class="text-muted">No shipping address found.</p>
              @endif

              <div id="shippingFormBox" class="card p-3 mt-3 d-none">
                <h5 class="mb-3">Add / Edit Shipping Address</h5>

                <form id="shippingForm">
                  @csrf
                  <input type="hidden" name="id" id="shipping_id">

                  <div class="row">
                    <div class="col-md-6 mb-2">
                      <input type="text" name="name" id="shipping_name" class="form-control" placeholder="Full Name"
                        required>
                    </div>

                    <div class="col-md-6 mb-2">
                      <input type="text" name="mobile_number" id="shipping_mobile" class="form-control"
                        placeholder="Mobile Number" required>
                    </div>

                    <div class="col-md-12 mb-2">
                      <textarea name="address" id="shipping_address" class="form-control" placeholder="Address"
                        required></textarea>
                    </div>

                    <div class="col-md-4 mb-2">
                      <select id="shipping_country" name="country" class="form-control" required>
                        <option value="">Country</option>
                        @foreach($countries as $country)
                          <option value="{{ $country->id }}">{{ $country->name }}</option>
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

                  <button type="submit" class="btn btn-dark btn-sm mt-2">Save Address</button>
                  <button type="button" class="btn btn-secondary btn-sm mt-2"
                    onclick="closeShippingForm()">Cancel</button>
                </form>
              </div>

            </div>

          </div>
        </div>
        <div class="col-lg-4 col-xl-3">

          {{-- Order Summary --}}
          <div class="order_sidebar_widget checkout_page mb30">
            <h4 class="title">Your Order</h4>
            <ul>
              @foreach($cartItems as $item)
                <li>
                  <p class="product_name_qnt">
                    {{ $item->products->name }} x {{ $item->quantity }}
                  </p>
                  <span class="price">
                    ₹{{ number_format($item->product_options->price * $item->quantity, 2) }}
                  </span>
                </li>
              @endforeach

              <li>
              </li>

              <li class="subtitle">
                <p>Product Subtotal
                  <span class="float-end">
                    ₹{{ number_format($cart->total_price, 2) }}
                  </span>
                </p>
              </li>

              @if($cart->pre_discount > 0)
                <li class="subtitle">
                  <p>Product Discount
                    <span class="float-end text-success">
                      -₹{{ number_format($cart->pre_discount, 2) }}
                    </span>
                  </p>
                </li>
              @endif

              @if($cart->discount_amount > 0)
                <li class="subtitle">
                  <p>Coupon Discount
                    <span class="float-end text-success">
                      -₹{{ number_format($cart->discount_amount, 2) }}
                    </span>
                  </p>
                </li>
              @endif

              <li class="subtitle">
                <p>Shipping
                  <span class="float-end">
                    ₹{{ $shippingData['shippingCost'][0]['TotalShipCost'] ?? 0 }}
                  </span>
                </p>
              </li>

              <li class="subtitle">
                <p>
                  {{ $shippingData['shippingCost'][0]['gst_type'] ?? 'Tax' }}
                  <span class="float-end">
                    ₹{{ $shippingData['shippingCost'][0]['total_gst_amount'] ?? 0 }}
                  </span>
                </p>
              </li>

              <li class="subtitle">
                <p><strong>Total</strong>
                  <span class="float-end">
                    ₹{{ number_format(
    $shippingData['shippingCost'][0]['totalCartAmount']
    ?? $cart->total_price_after_discount,
    2
  ) }}
                  </span>
                </p>
              </li>

            </ul>
          </div>

          <div class="order_sidebar_widget checkout_page mb30">
            <h4 class="title">Payment Method</h4>

            <div class="payment_method">

              {{-- CC Avenue Payment --}}
              <div class="ui_kit_radiobox pm_content bb1">
                <div class="radio mb10">
                  <input id="pay_ccavenue" name="payment_method" type="radio" value="online" checked>
                  <label class="pmtitle" for="pay_ccavenue">
                    <span class="radio-label"></span>
                    Pay Online (Card / UPI / Net Banking)
                  </label>
                </div>
                <div class="pm_details">
                  <p>Secure payment via CC Avenue.</p>
                </div>
              </div>

              {{-- Bank Transfer --}}
              <div class="ui_kit_radiobox pm_content">
                <div class="radio mb10">
                  <input id="pay_bank" name="payment_method" type="radio" value="offline">
                  <label class="pmtitle" for="pay_bank">
                    <span class="radio-label"></span>
                    Bank Transfer / UPI
                  </label>
                </div>
                <div class="pm_details">
                  <p>
                    Transfer via bank or UPI.
                    Order will be processed after payment confirmation.
                  </p>
                </div>
              </div>

            </div>

            <div id="bankDetailsBox" class="card p-3 mt-3 d-none">

              <h5>Bank Transfer Details</h5>

              <img src="{{ asset('storage/' . $bank->payment_image) }}" width="220" class="mb-2" alt="QR Code">

              <p><strong>A/C Name:</strong> {{ $bank->ac_name }}</p>
              <p><strong>A/C Number:</strong> {{ $bank->ac_number }}</p>
              <p><strong>Bank:</strong> {{ $bank->bank_name }}</p>
              <p><strong>IFSC:</strong> {{ $bank->ifsc_code }}</p>
              <p><strong>Branch:</strong> {{ $bank->bank_branch }}</p>

              <div class="mt-3">
                <label>Reference ID</label>
                <input type="text" id="reference_id" class="form-control">
              </div>

              <div class="mt-3">
                <label>Upload Payment Proof</label>
                <input type="file" id="payment_proof" class="form-control" style="height: inherit;">
              </div>

            </div>
          </div>

          <div class="ui_kit_checkbox checkout_pm">
            <label class="custom_checkbox">Your personal data will be used to process your order, support your experience
              throughout this website, and for other purposes described in our privacy policy.
              <input type="checkbox">
              <span class="checkmark"></span>
            </label>
          </div>

          {{-- Place Order Button --}}
          <div class="ui_kit_button payment_widget_btn">
            <button id="placeOrderBtn" type="button" class="btn btn-thm btn-block mb0">Place Order</button>
          </div>

        </div>
      </div>
    </div>
  </section>
  <script>

    document.addEventListener('DOMContentLoaded', () => {
      const firstBilling = document.querySelector('input[name="billing_address_id"]');
      if (firstBilling) firstBilling.checked = true;

      const firstShipping = document.querySelector('input[name="shipping_address_id"]');
      if (firstShipping) firstShipping.checked = true;
    });

    document.querySelectorAll('.shippingSelect').forEach(radio => {
      radio.addEventListener('change', function () {
        location.reload();
      });
    });

    document.getElementById('sameAsBilling').addEventListener('change', function () {
      if (this.checked) {
        const billing = document.querySelector('input[name="billing_address_id"]:checked');
        if (!billing) {
          Swal.fire({
            icon: 'warning',
            title: 'Billing Address Required',
            text: 'Please select billing address first.'
          });
          this.checked = false;
          return;
        }
        document.querySelector(`input[name="shipping_address_id"][value="${billing.value}"]`)?.click();
      }
    });

    // SHOW FORMS
    document.getElementById('addBilling').onclick = () =>
      document.getElementById('billingFormBox').classList.remove('d-none');

    document.getElementById('addShipping').onclick = () =>
      document.getElementById('shippingFormBox').classList.remove('d-none');

    function closeBillingForm() {
      document.getElementById('billingFormBox').classList.add('d-none');
    }
    function closeShippingForm() {
      document.getElementById('shippingFormBox').classList.add('d-none');
    }

    // EDIT BILLING
    document.querySelectorAll('.editBillingBtn').forEach(btn => {
      btn.onclick = () => {
        let a = JSON.parse(btn.dataset.address);

        billing_id.value = a.id;
        billing_name.value = a.name;
        billing_mobile.value = a.mobile_number;
        billing_address.value = a.address;
        billing_pincode.value = a.pincode;
        billing_country.value = a.country.id;

        loadStates(a.countries.id, a.states?.id);
        loadCities(a.states?.id, a.cities?.id);

        billingFormBox.classList.remove('d-none');
      };
    });

    // EDIT SHIPPING
    document.querySelectorAll('.editShippingBtn').forEach(btn => {
      btn.onclick = () => {
        let a = JSON.parse(btn.dataset.address);

        shipping_id.value = a.id;
        shipping_name.value = a.name;
        shipping_mobile.value = a.mobile_number;
        shipping_address.value = a.address;
        shipping_pincode.value = a.pincode;
        shipping_country.value = a.country.id;

        loadShipStates(a.countries.id, a.states?.id);
        loadShipCities(a.states?.id, a.cities?.id);

        shippingFormBox.classList.remove('d-none');
      };
    });

    // SAVE BILLING
    document.getElementById('billingForm').onsubmit = function (e) {
      e.preventDefault();

      fetch('/customer/billing-address/save', {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: new FormData(this)
      })
        .then(r => r.json())
        .then(data => {
          if (data.success) {
            location.reload();
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Save Failed',
              text: data.message || 'Failed to save billing address'
            });
          }
        })
        .catch(() => {
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Something went wrong. Please try again.'
          });
        });
    };

    // SAVE SHIPPING
    document.getElementById('shippingForm').onsubmit = function (e) {
      e.preventDefault();

      fetch('/customer/shipping-address/save', {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: new FormData(this)
      })
        .then(r => r.json())
        .then(data => {
          if (data.success) {
            location.reload();
          } else {
            Swal.fire({
              icon: 'error',
              title: 'Save Failed',
              text: data.message || 'Failed to save shipping address'
            });
          }
        })
        .catch(() => {
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Something went wrong. Please try again.'
          });
        });
    };

    // SHIPPING DROPDOWNS
    function loadShipStates(country, selected = null) {
      shipping_state.innerHTML = '<option>Loading...</option>';
      fetch('/states/' + country)
        .then(r => r.json())
        .then(d => {
          shipping_state.innerHTML = '<option value="">State</option>';
          d.forEach(s => shipping_state.innerHTML += `<option value="${s.id}">${s.name}</option>`);
          if (selected) shipping_state.value = selected;
        });
    }

    function loadShipCities(state, selected = null) {
      shipping_city.innerHTML = '<option>Loading...</option>';
      fetch('/cities/' + state)
        .then(r => r.json())
        .then(d => {
          shipping_city.innerHTML = '<option value="">City</option>';
          d.forEach(c => shipping_city.innerHTML += `<option value="${c.id}">${c.name}</option>`);
          if (selected) shipping_city.value = selected;
        });
    }

    function loadStates(country, selected = null) {
      billing_state.innerHTML = '<option>Loading...</option>';
      fetch('/states/' + country)
        .then(r => r.json())
        .then(d => {
          billing_state.innerHTML = '<option value="">State</option>';
          d.forEach(s => billing_state.innerHTML += `<option value="${s.id}">${s.name}</option>`);
          if (selected) billing_state.value = selected;
        });
    }

    function loadCities(state, selected = null) {
      billing_city.innerHTML = '<option>Loading...</option>';
      fetch('/cities/' + state)
        .then(r => r.json())
        .then(d => {
          billing_city.innerHTML = '<option value="">City</option>';
          d.forEach(c => billing_city.innerHTML += `<option value="${c.id}">${c.name}</option>`);
          if (selected) billing_city.value = selected;
        });
    }

    billing_country.addEventListener('change', () =>
      loadStates(billing_country.value)
    );

    billing_state.addEventListener('change', () =>
      loadCities(billing_state.value)
    );

    shipping_country.addEventListener('change', () => loadShipStates(shipping_country.value));
    shipping_state.addEventListener('change', () => loadShipCities(shipping_state.value));


    document.getElementById('placeOrderBtn').addEventListener('click', async () => {
      const paymentEl = document.querySelector('input[name="payment_method"]:checked');
      const billing = document.querySelector('input[name="billing_address_id"]:checked');
      const shipping = document.querySelector('input[name="shipping_address_id"]:checked');
      if (!paymentEl) {
        Swal.fire({
          icon: 'warning',
          title: 'Select Payment Method',
          text: 'Please choose a payment method to continue.'
        });
        return;
      }

      if (!billing || !shipping) {
        Swal.fire({
          icon: 'warning',
          title: 'Address Required',
          text: 'Please select billing and shipping address.'
        });
        return;
      }

      const payment = paymentEl.value;
      const shipping_type = "{{ $shippingData['shippingCost'][0]['id'] ?? 0 }}";
      const shippingData = JSON.parse(shipping.dataset.address);
      const isIndia = shippingData.countries?.name?.toLowerCase() === 'india' ? "true" : "false";

      const btn = document.getElementById('placeOrderBtn');
      btn.disabled = true;
      btn.innerText = "Processing...";

      const formData = new FormData();

      formData.append('billing_id', billing.value);
      formData.append('shipping_id', shipping.value);
      formData.append('payment_mode', payment);
      formData.append('shipping_type', shipping_type);
      formData.append('iscountryindia', isIndia);

      if (payment === 'offline') {

        const reference = document.getElementById('reference_id').value;

        if (!reference) {
          Swal.fire({
            icon: 'warning',
            title: 'Reference ID Required',
            text: 'Please enter a reference ID for offline payment.'
          });
          btn.disabled = false;
          btn.innerText = "Place Order";
          return;
        }

        formData.append('reference_id', reference);
        const proof = document.getElementById('payment_proof').files[0];
        if (proof) formData.append('payment_proof', proof);
      }


      try {
        const response = await fetch('/customer/place-order', {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
          },
          body: formData
        });

        const data = await response.json();

        if (!data.success) {
          Swal.fire({
            icon: 'error',
            title: 'Order Failed',
            text: data.message || 'Something went wrong'
          });
          btn.disabled = false;
          btn.innerText = "Place Order";
          return;
        }

        // ✅ ONLINE PAYMENT
        if (data.payment_url) {
          window.location.href = data.payment_url;
          return;
        }

        // ✅ BANK TRANSFER / SUCCESS
        if (data.redirect_url) {
          window.location.href = data.redirect_url;
          return;
        }

      } catch (err) {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Something went wrong. Please try again.'
        });
        btn.disabled = false;
        btn.innerText = "Place Order";
      }
    });

    function toggleBankBox() {
      const selected = document.querySelector('input[name="payment_method"]:checked');
      const bankBox = document.getElementById('bankDetailsBox');

      if (!selected || !bankBox) return;

      if (selected.value === 'offline') {
        bankBox.classList.remove('d-none');
      } else {
        bankBox.classList.add('d-none');
      }
    }

    document.querySelectorAll('input[name="payment_method"]').forEach(radio => {
      radio.addEventListener('change', toggleBankBox);
    });

    toggleBankBox();

  </script>
@endsection
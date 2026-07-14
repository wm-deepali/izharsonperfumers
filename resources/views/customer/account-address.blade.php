@extends('front.app')

@section('title', 'My Address')

<style>
    /* Header */
.address-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
}

.btn-add {
    background: #000;
    color: #fff;
    border: none;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 13px;
}

/* Card */
.address-card {
    background: #fff;
    border-radius: 12px;
    padding: 15px;
    margin-bottom: 15px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    transition: 0.3s;
}

.address-card:hover {
    transform: translateY(-3px);
}

/* Top section */
.address-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 8px;
}

.badge {
    background: #000;
    color: #fff;
    padding: 3px 8px;
    font-size: 12px;
    border-radius: 4px;
}

.badge.shipping {
    background: #ff6b00;
}

/* Edit button */
.edit-btn {
    color: #007bff;
    font-size: 13px;
    cursor: pointer;
}

/* Name */
.address-card h5 {
    margin: 5px 0;
    font-size: 15px;
    font-weight: 600;
}

/* Address text */
.address-text {
    font-size: 13px;
    color: #666;
    margin-bottom: 10px;
}

/* Contact */
.address-contact {
    display: flex;
    justify-content: space-between;
    font-size: 13px;
    color: #333;
}

</style>

@section('content')

    <section class="our-dashbord dashbord p-3">
        <div class="container">
            <div class="row">

                @include('customer.dashboard-nav')

                <div class="col-lg-9 col-xl-9">

                    @include('customer.dashboard-nav-dropdown')

                    <div class="account_user_deails pl40 pl0-lg">

                        <h2 class="title mb10">My Address</h2>
<hr class="mt-0">

                        <div class="row">

    {{-- BILLING ADDRESS --}}
    <div class="col-lg-6">

        <div class="address-header">
            <h4>Billing Address</h4>
            <button class="btn-add" id="addBilling">+ Add</button>
        </div>

        @foreach($billingAddresses as $addr)
            <div class="address-card">

                <div class="address-top">
                    <span class="badge">Billing</span>

                    <span class="editBillingBtn edit-btn"
                        data-address='@json($addr->toArray())'>
                        Edit
                    </span>
                </div>

                <h5>{{ $addr->name }}</h5>

                <p class="address-text">
                    {{ $addr->address }},
                    {{ $addr->cities->name ?? '' }},
                    {{ $addr->states->name ?? '' }} - {{ $addr->pincode }}
                </p>

                <div class="address-contact">
                    <span>{{ $addr->email }}</span>
                    <span>{{ $addr->mobile_number }}</span>
                </div>

            </div>
        @endforeach

    </div>


    {{-- SHIPPING ADDRESS --}}
    <div class="col-lg-6">

        <div class="address-header">
            <h4>Shipping Address</h4>
            <button class="btn-add" id="addShipping">+ Add</button>
        </div>

        @foreach($shippingAddresses as $addr)
            <div class="address-card">

                <div class="address-top">
                    <span class="badge shipping">Shipping</span>

                    <span class="editShippingBtn edit-btn"
                        data-address='@json($addr->toArray())'>
                        Edit
                    </span>
                </div>

                <h5>{{ $addr->name }}</h5>

                <p class="address-text">
                    {{ $addr->address }},
                    {{ $addr->cities->name ?? '' }},
                    {{ $addr->states->name ?? '' }} - {{ $addr->pincode }}
                </p>

                <div class="address-contact">
                    <span>{{ $addr->email }}</span>
                    <span>{{ $addr->mobile_number }}</span>
                </div>

            </div>
        @endforeach

    </div>

</div>



                        @include('customer.address.billing-form')
                        @include('customer.address.shipping-form')

                    </div>
                </div>

            </div>
        </div>
    </section>

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            /* =========================
               OPEN FORMS
            ========================== */

            document.getElementById('addBilling')?.addEventListener('click', () => {
                document.getElementById('billingForm').reset();
                document.getElementById('billing_id').value = '';
                document.getElementById('billingFormBox').classList.remove('d-none');
            });

            document.getElementById('addShipping')?.addEventListener('click', () => {
                document.getElementById('shippingForm').reset();
                document.getElementById('shipping_id').value = '';
                document.getElementById('shippingFormBox').classList.remove('d-none');
            });


            /* =========================
               CLOSE FORMS
            ========================== */

            window.closeBillingForm = function () {
                document.getElementById('billingFormBox').classList.add('d-none');
            }

            window.closeShippingForm = function () {
                document.getElementById('shippingFormBox').classList.add('d-none');
            }


            /* =========================
               EDIT BILLING ADDRESS
            ========================== */

            document.querySelectorAll('.editBillingBtn').forEach(btn => {

                btn.addEventListener('click', function () {

                    let a = JSON.parse(this.dataset.address);

                    billing_id.value = a.id;
                    billing_name.value = a.name;
                    billing_mobile.value = a.mobile_number;
                    billing_email.value = a.email ?? '';
                    billing_address.value = a.address;
                    billing_pincode.value = a.pincode;

                    if (a.countries) {
                        billing_country.value = a.countries.id;
                        loadStates(a.countries.id, a.states?.id);
                    }

                    if (a.states) {
                        loadCities(a.states.id, a.cities?.id);
                    }

                    billingFormBox.classList.remove('d-none');

                });

            });


            /* =========================
               EDIT SHIPPING ADDRESS
            ========================== */

            document.querySelectorAll('.editShippingBtn').forEach(btn => {

                btn.addEventListener('click', function () {

                    let a = JSON.parse(this.dataset.address);

                    shipping_id.value = a.id;
                    shipping_name.value = a.name;
                    shipping_mobile.value = a.mobile_number;
                    shipping_address.value = a.address;
                    shipping_pincode.value = a.pincode;

                    if (a.countries) {
                        shipping_country.value = a.countries.id;
                        loadShipStates(a.countries.id, a.states?.id);
                    }

                    if (a.states) {
                        loadShipCities(a.states.id, a.cities?.id);
                    }

                    shippingFormBox.classList.remove('d-none');

                });

            });


            /* =========================
               SAVE BILLING ADDRESS
            ========================== */

            document.getElementById('billingForm')?.addEventListener('submit', function (e) {

                e.preventDefault();

                fetch('/customer/billing-address/save', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: new FormData(this)
                })
                    .then(res => res.json())
                    .then(data => {

                        if (data.success) {
                            location.reload();
                        } else {
                            Swal.fire('Error', data.message ?? 'Save failed', 'error');
                        }

                    });

            });


            /* =========================
               SAVE SHIPPING ADDRESS
            ========================== */

            document.getElementById('shippingForm')?.addEventListener('submit', function (e) {

                e.preventDefault();

                fetch('/customer/shipping-address/save', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: new FormData(this)
                })
                    .then(res => res.json())
                    .then(data => {

                        if (data.success) {
                            location.reload();
                        } else {
                            Swal.fire('Error', data.message ?? 'Save failed', 'error');
                        }

                    });

            });


            /* =========================
               COUNTRY → STATE
            ========================== */

            window.loadStates = function (country, selected = null) {

                billing_state.innerHTML = '<option>Loading...</option>';

                fetch('/states/' + country)
                    .then(r => r.json())
                    .then(data => {

                        billing_state.innerHTML = '<option value="">State</option>';

                        data.forEach(s => {
                            billing_state.innerHTML += `<option value="${s.id}">${s.name}</option>`;
                        });

                        if (selected) billing_state.value = selected;

                    });

            }


            window.loadCities = function (state, selected = null) {

                billing_city.innerHTML = '<option>Loading...</option>';

                fetch('/cities/' + state)
                    .then(r => r.json())
                    .then(data => {

                        billing_city.innerHTML = '<option value="">City</option>';

                        data.forEach(c => {
                            billing_city.innerHTML += `<option value="${c.id}">${c.name}</option>`;
                        });

                        if (selected) billing_city.value = selected;

                    });

            }


            window.loadShipStates = function (country, selected = null) {

                shipping_state.innerHTML = '<option>Loading...</option>';

                fetch('/states/' + country)
                    .then(r => r.json())
                    .then(data => {

                        shipping_state.innerHTML = '<option value="">State</option>';

                        data.forEach(s => {
                            shipping_state.innerHTML += `<option value="${s.id}">${s.name}</option>`;
                        });

                        if (selected) shipping_state.value = selected;

                    });

            }


            window.loadShipCities = function (state, selected = null) {

                shipping_city.innerHTML = '<option>Loading...</option>';

                fetch('/cities/' + state)
                    .then(r => r.json())
                    .then(data => {

                        shipping_city.innerHTML = '<option value="">City</option>';

                        data.forEach(c => {
                            shipping_city.innerHTML += `<option value="${c.id}">${c.name}</option>`;
                        });

                        if (selected) shipping_city.value = selected;

                    });

            }


            billing_country?.addEventListener('change', () => {
                loadStates(billing_country.value);
            });

            billing_state?.addEventListener('change', () => {
                loadCities(billing_state.value);
            });

            shipping_country?.addEventListener('change', () => {
                loadShipStates(shipping_country.value);
            });

            shipping_state?.addEventListener('change', () => {
                loadShipCities(shipping_state.value);
            });


        });

    </script>

@endsection
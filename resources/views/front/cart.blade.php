@extends('front.app')

@section('title', 'Cart')


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
              <li class="breadcrumb-item active" aria-current="page">
                Cart
              </li>
            </ol>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Shop Checkouts Content -->
  <section class="shop-cart pt30">
    <div class="container">
      <div class="row">
        <div class="col-sm-6 col-lg-4 m-auto">
          <div class="main-title text-center mb50">
            <h2 class="title">Shopping Cart</h2>
          </div>
        </div>
      </div>
      <div class="row mt15">
        <div class="col-lg-8 col-xl-9">
          <div class="shopping_cart_table table-responsive">
            <table class="table table-borderless">
              <thead>
                <tr>
                  <th scope="col">PRODUCT</th>
                  <th scope="col">PRICE</th>
                  <th scope="col">DISCOUNT</th>
                  <th scope="col">QUANTITY</th>
                  <th scope="col">TOTAL</th>
                  <th scope="col">REMOVE</th>
                </tr>
              </thead>
              <tbody class="table_body">

                @forelse($cartItems as $item)
                  <tr>
                    <th scope="row">
                      <ul class="cart_list d-block d-xl-flex">
                        <li class="ps-1 ps-sm-4 pe-1 pe-sm-4">
                          <a href="{{ url('product-details/' . $item->products->slug)  }}">
                            <img src="{{ asset('storage/' . ($item->product_options->image ?? $item->products->image)) }}"
                              style="width:100px; height:100px">
                          </a>
                        </li>

                        <li class="ms-2 ms-md-3">
                          <a class="cart_title" href="{{ url('product-details/' . $item->products->slug)  }}">
                            <span class="fz16">
                              {{ $item->products->name }}
                            </span>
                            <br>

                            <span class="fz14">
                              <span class="fw500">Weight:</span>
                              {{ $item->product_options->packaging->quantity ?? '' }}
                              {{ $item->product_options->packaging->quantity_in ?? '' }}
                            </span>
                          </a>
                        </li>
                      </ul>
                    </th>

                    <td>
                      <span class="text-muted text-decoration-line-through">
                        ₹{{ number_format($item->product_options->mrp, 2) }}
                      </span>
                      <br>
                      <span class="fw-bold text-danger">
                        ₹{{ number_format($item->product_options->price, 2) }}
                      </span>
                    </td>


                    <td>
                      @if(($item->product_options->discount_amount ?? 0) > 0)
                        <span class="text-success fw-bold">
                          -₹{{ number_format($item->product_options->discount_amount, 2) }}
                        </span>
                      @else
                        <span class="text-muted">—</span>
                      @endif
                    </td>
                    <td>
                      <div class="cart_btn">
                        <div class="quantity-block">
                          <button class="quantity-arrow-minus inner_page" data-id="{{ $item->id }}"> <span
                              class="fa fa-minus"></span></button>

                          <input class="quantity-num inner_page qty-input" type="number" value="{{ $item->quantity }}"
                            data-id="{{ $item->id }}">

                          <button class="quantity-arrow-plus inner_page" data-id="{{ $item->id }}"> <span
                              class="fas fa-plus"></span></button>
                        </div>
                      </div>
                    </td>

                    <td class="item-total">
                      ₹{{ number_format($item->product_options->price * $item->quantity, 2) }}
                    </td>

                    <td>
                      <span class="flaticon-close remove-item" data-id="{{ $item->id }}" style="cursor:pointer"></span>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="5" class="text-center py-5">
                      Your cart is empty
                    </td>
                  </tr>
                @endforelse

              </tbody>

            </table>
            <div class="checkout_form mt30">
              <div class="checkout_coupon posr d-block d-xl-flex">
                <form id="couponForm" class="form_one posr mb10-lg">
                  <input id="coupon_code" name="coupon_code" class="form-control coupon_input" type="search"
                    placeholder="Coupon code">

                  <a href="#" id="applyCouponBtn" class="btn apply_count_btn">
                    Apply Coupon
                  </a>
                </form>
                @if($cart->coupon)
                  <div class="coupon-applied-box p-2 rounded bg-light border ms-3">
                    <div class="d-flex justify-content-between align-items-center">
                      <div>
                        <strong class="text-success">
                          ✔ Coupon Applied: {{ $cart->coupon->coupon_code }}
                        </strong>

                        @if($cart->discount_amount > 0)
                          <div class="small text-muted">
                            You saved ₹{{ number_format($cart->discount_amount, 2) }}
                          </div>
                        @endif
                      </div>

                      <span id="removeCoupon" class="text-danger fw-bold" style="cursor:pointer">
                        Remove
                      </span>
                    </div>
                  </div>
                @endif
                <form class="form_two">
                  <a href="{{ route('shop.category') }}" class="btn btn_shopping btn-white me-3">
                    Continue Shopping
                  </a>
                  <button type="button" class="btn btn_cart btn3 btn-thm">Update Cart</button>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-xl-3">
          <div class="order_sidebar_widget style2">
            <h4 class="title">Cart Totals</h4>
            <ul>
              <li class="subtitle">
                <p>Product Subtotal <span class="float-end">₹{{ number_format($cart->total_price, 2) }}</span></p>
              </li>


              <li class="subtitle">
                <p>Estimated Shipping
                  @if(($shippingData['shippingCost'][0]['shipping_type'] ?? '') == 'free')
                    <small class="text-success">(FREE)</small>
                  @endif
                  <span class="float-end">
                    ₹{{ $shippingData['shippingCost'][0]['TotalShipCost'] ?? 0 }}
                  </span>
                </p>
              </li>
             
              {{-- Product Discounts --}}
              @if($cart->pre_discount > 0)
                <li class="subtitle">
                  <p>Pre-Discount
                    <span class="float-end text-success">
                      -₹{{ number_format($cart->pre_discount, 2) }}
                    </span>
                  </p>
                </li>
              @endif

              {{-- Coupon Discount --}}
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
                <p>
                  {{ $shippingData['shippingCost'][0]['gst_type'] ?? 'Tax' }}
                  <span class="float-end">
                    ₹{{ $shippingData['shippingCost'][0]['total_gst_amount'] ?? 0 }}
                  </span>
                </p>
              </li>
              <li class="subtitle">
                <hr>
              </li>
              <li class="subtitle totals">
                <p>Total <span class="float-end">
                    ₹{{ number_format(
    $shippingData['shippingCost'][0]['totalCartAmount']
    ?? $cart->total_price_after_discount,
    2
  ) }}
                  </span></p>
              </li>
            </ul>
            <div class="ui_kit_button payment_widget_btn">
              <button type="button" class="btn btn-thm btn-block">
                @if(Auth::guard('customer')->check())
                  <a href="{{ route('checkout') }}">Proceed to checkout</a>
                @else
                  <a href="{{ route('customer.login') }}">Login to Checkout</a>
                @endif
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script>

    document.addEventListener("click", function (e) {

      // ➕ increase qty
      if (e.target.closest(".quantity-arrow-plus")) {
        let id = e.target.closest("button").dataset.id;
        updateQty(id, 1);
      }

      // ➖ decrease qty
      if (e.target.closest(".quantity-arrow-minus")) {
        let id = e.target.closest("button").dataset.id;
        updateQty(id, -1);
      }

      // ❌ remove item
      if (e.target.closest(".remove-item")) {
        let id = e.target.closest(".remove-item").dataset.id;
        removeItem(id);
      }
    });

    document.addEventListener("change", function (e) {

      if (e.target.classList.contains("qty-input")) {

        let id = e.target.dataset.id;
        let value = parseInt(e.target.value);

        if (value < 1) {
          e.target.value = 1;
          value = 1;
        }

        fetch("/cart/set-quantity/" + id, {
          method: "POST",
          headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
            "Content-Type": "application/json"
          },
          body: JSON.stringify({ quantity: value })
        })
          .then(() => location.reload());

      }

    });

    function updateQty(id, change) {

      const row = document.querySelector(`tr [data-id="${id}"]`).closest("tr");
      const qtyInput = row.querySelector(".qty-input");
      const totalCell = row.querySelector(".item-total");

      // show loading effect
      row.style.opacity = "0.5";

      fetch("/cart/update/" + id, {
        method: "POST",
        headers: {
          "X-CSRF-TOKEN": "{{ csrf_token() }}",
          "Content-Type": "application/json"
        },
        body: JSON.stringify({ change: change })
      })
        .then(res => res.json())
        .then(() => {
          location.reload();
        })
        .catch(() => {
          Swal.fire({
            icon: 'error',
            title: 'Update failed',
            text: 'Unable to update quantity'
          });
          row.style.opacity = "1";
        });

    }

    function removeItem(id) {

      Swal.fire({
        title: 'Remove this item?',
        text: "This product will be removed from cart",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, remove it'
      }).then((result) => {

        if (result.isConfirmed) {
          const row = document.querySelector(`tr [data-id="${id}"]`).closest("tr");

          row.style.transition = "0.3s";
          row.style.opacity = "0";
          row.style.transform = "translateX(50px)";

          setTimeout(() => {
            fetch("/cart/remove/" + id, {
              method: "POST",
              headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
              }
            }).then(() => {
              Swal.fire({
                icon: 'success',
                title: 'Removed!',
                text: 'Item removed from cart',
                timer: 1200,
                showConfirmButton: false
              }).then(() => location.reload());
            });
          }, 300);

        }

      });
    }

    // click on anchor triggers form submit
    document.getElementById('applyCouponBtn')?.addEventListener('click', function (e) {
      e.preventDefault();
      document.getElementById('couponForm').dispatchEvent(new Event('submit'));
    });

    document.getElementById('couponForm')?.addEventListener('submit', function (e) {
      e.preventDefault();

      let code = document.getElementById('coupon_code').value.trim();

      if (!code) {
        Swal.fire({
          icon: 'warning',
          title: 'Oops...',
          text: 'Please enter coupon code'
        });
        return;
      }
      @if(!Auth::guard('customer')->check())
        Swal.fire({
          icon: 'info',
          title: 'Login Required',
          text: 'Please login to apply coupon'
        }).then(() => {
          window.location.href = "{{ route('customer.login') }}";
        });
        return;
      @endif

      fetch("{{ route('customer.cart.applyCoupon') }}", {
        method: "POST",
        headers: {
          "X-CSRF-TOKEN": "{{ csrf_token() }}",
          "Content-Type": "application/json"
        },
        body: JSON.stringify({ coupon_code: code })
      })
        .then(res => res.json())
        .then(data => {

          Swal.fire({
            icon: data.success ? 'success' : 'error',
            title: data.success ? 'Coupon Applied' : 'Coupon Failed',
            text: data.message,
            confirmButtonColor: '#3085d6'
          }).then(() => {
            if (data.success) location.reload();
          });

        });

    });


    document.getElementById('removeCoupon')?.addEventListener('click', function () {

      Swal.fire({
        title: 'Remove coupon?',
        text: "Discount will be removed",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, remove it'
      }).then((result) => {

        if (result.isConfirmed) {
          fetch("{{ route('customer.cart.removeCoupon') }}", {
            method: "POST",
            headers: {
              "X-CSRF-TOKEN": "{{ csrf_token() }}"
            }
          })
            .then(res => res.json())
            .then(() => location.reload());
        }

      });
    });

  </script>

@endsection
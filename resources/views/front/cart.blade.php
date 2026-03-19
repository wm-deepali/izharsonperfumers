@extends('front.app')

@section('title', 'Cart')

<style>
    .cart-card {
    background: #fff;
    border-radius: 12px;
    padding: 12px;
    margin-bottom: 15px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
}

.cart-card-top {
    display: flex;
    gap: 10px;
    position: relative;
}

.cart-card-top img {
    width: 70px;
    height: 70px;
    border-radius: 8px;
    object-fit: cover;
}

.cart-info h4 {
    font-size: 14px;
    margin: 0;
}

.cart-info p {
    font-size: 12px;
    color: #777;
    margin: 3px 0;
}

.price .new {
    font-weight: bold;
    color: #000;
}

.price .old {
    text-decoration: line-through;
    color: #999;
    font-size: 12px;
    margin-left: 5px;
}

.remove {
    position: absolute;
    right: 0;
    top: 0;
    cursor: pointer;
    font-size: 14px;
}

.cart-card-middle {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 10px;
}

.qty-box {
    display: flex;
    align-items: center;
    gap: 5px;
}

.qty-box button {
    width: 28px;
    height: 28px;
    border: none;
    background: #eee;
    border-radius: 50%;
}

.qty-box input {
    width: 40px;
    text-align: center;
    border: none;
}

.total {
    font-weight: bold;
    color: #000;
}

</style>

@section('content')

  <!-- Inner Page Breadcrumb -->
  <section class="inner_page_breadcrumb" style="background:#f9f9f9;">
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
  <section class="shop-cart pt-2">
    <div class="container">
      <div class="row">
        <div class="col-sm-6 col-lg-4 m-auto">
          <div class="main-title text-center ">
            <h2 class="title">Shopping Cart</h2>
          </div>
        </div>
      </div>
      <div class="row mt15">
        <div class="col-lg-8 col-xl-9">
          <div class="shopping_cart_table table-responsive">
              <div class="d-none d-md-block">
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
</div>

            
            <div class="cart-mobile d-block d-md-none p-2" >

    @forelse($cartItems as $item)
        <div class="cart-card">

            <!-- TOP -->
            <div class="cart-card-top">
                <img src="{{ asset('storage/' . ($item->product_options->image ?? $item->products->image)) }}">

                <div class="cart-info">
                    <h4>{{ $item->products->name }}</h4>
                    <p>
                        {{ $item->product_options->packaging->quantity ?? '' }}
                        {{ $item->product_options->packaging->quantity_in ?? '' }}
                    </p>

                    <div class="price">
                        <span class="new">₹{{ number_format($item->product_options->price, 2) }}</span>
                        <span class="old">₹{{ number_format($item->product_options->mrp, 2) }}</span>
                    </div>
                </div>

                <span class="remove remove-item" data-id="{{ $item->id }}">✕</span>
            </div>

            <!-- MIDDLE -->
            <div class="cart-card-middle">
                <div class="qty-box">
                    <button class="mini-minus" data-id="{{ $item->id }}">-</button>
                    <input type="number" value="{{ $item->quantity }}" class="qty-input" data-id="{{ $item->id }}">
                    <button class="mini-plus" data-id="{{ $item->id }}">+</button>
                </div>

                <div class="total">
                    ₹{{ number_format($item->product_options->price * $item->quantity, 2) }}
                </div>
            </div>

        </div>
    @empty
        <p class="text-center py-5">Your cart is empty</p>
    @endforelse

</div>

            <div class="checkout_form mt30">
              <div class="checkout_coupon posr d-block d-xl-flex">
                <form id="couponForm" class="form_one posr mb10-lg">
                  <input id="coupon_code" name="coupon_code" class="form-control coupon_input" type="search"
                    placeholder="Enter Coupon code">

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
                <form class="form_two d-flex flex-column flex-md-row gap-2">
                  <a href="{{ route('shop.category') }}" class="btn btn_shopping btn-white " style="height:52px; display:flex;align-items:center;    border: 1px solid;
    text-align: center;">
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
            
                <hr>

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
                    <span class="float-end" style="color:green;">
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
              
             @if(($shippingData['shippingCost'][0]['total_gst_amount'] ?? 0) > 0)
<li class="subtitle">
    <p>
        {{ $shippingData['shippingCost'][0]['gst_type'] ?? 'Tax' }}
        <span class="float-end">
            ₹{{ $shippingData['shippingCost'][0]['total_gst_amount'] ?? 0 }}
        </span>
    </p>
</li>
@endif
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
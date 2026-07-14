@extends('front.app')

@section('title', 'Order Details')

@section('content')

    <section class="our-dashbord dashbord p-3">

        <div class="container">
            <div class="row">

                @include('customer.dashboard-nav')

                <div class="col-lg-9 col-xl-9">

                    @include('customer.dashboard-nav-dropdown')

                    <div class="account_user_deails pl40 pl0-lg">


                        {{-- ORDER HEADER --}}
                        <div class="mb-3">
                            <a href="{{ route('customer.orders') }}" class="back-btn" style="font-weight:600;">
                                ← Back to Orders
                            </a>
                        </div>
                        <div class="order-date order-id">

                            <p class="hide-in-mobile">
                                Ordered on {{ $order->created_at->format('d M Y H:i') }}
                            </p>

                            <p>Order# {{ $order->order_number }}</p>

                            <p>
                                Order Status:
                                <span style="color:#1CA301">
                                    {{ $order->order_status }}
                                </span>
                            </p>

                            @if(!in_array($order->order_status, ['Cancelled', 'Delivered']))
                                <button data-bs-toggle="modal" data-bs-target="#cancelModal">
                                    Cancel order
                                </button>
                            @endif

                        </div>



                        {{-- SHIPPING / PAYMENT / SUMMARY --}}

                        <div class="shipping-address">


                            {{-- SHIPPING ADDRESS --}}

                            <div class="right-border address-pd">

                                <h6>Shipping Address</h6>

                                <ul>

                                    <li>{{ $order->name }}</li>

                                    <li style="color:#555">
                                        {{ $order->address }},
                                        <span>{{ $order->cities->name ?? '' }}</span>
                                    </li>

                                    <li style="color:#555">
                                        {{ $order->states->name ?? '' }},
                                        <span>{{ $order->countries->name ?? '' }}</span>,
                                        <span>{{ $order->pincode }}</span>
                                    </li>

                                    <li style="color:#555">
                                        {{ $order->mobile_number }},
                                        <span>{{ $order->email }}</span>
                                    </li>

                                </ul>

                            </div>



                            {{-- PAYMENT --}}

                            <div class="right-border address-pd">

                                <h6>Payment</h6>

                                <div class="order-date">

                                    <ul>
                                        <li>Payment Status</li>
                                        <li>Invoice Number</li>
                                    </ul>

                                    <ul>

                                        <li class="payment-pera" style="color:#1CA301">
                                            {{ $order->payment_status }}
                                        </li>

                                        <li class="payment-pera">
                                            {{ $order->invoice_number }}
                                        </li>

                                    </ul>

                                </div>


                                @if($order->invoice_url)

                                    <a href="{{ asset('storage/' . $order->invoice_url) }}" target="_blank">

                                        <h5 class="download-invoice">
                                            <i class="fas fa-download"></i>
                                            Download Invoice
                                        </h5>
                                    </a>

                                @endif

                            </div>



                            {{-- ORDER SUMMARY --}}

                            <div class="address-pd">

                                <h6>Order Summary</h6>

                                <div class="order-date order-details-mt-1">

                                    <div>

                                        <p>Item(s) Subtotal:</p>
                                        <p>Shipping:</p>
                                        <p>Promotion Applied</p>
                                        <p>Total:</p>
                                        <p class="grant-total">Grand Total:</p>

                                    </div>

                                    <div>

                                        <p>₹ {{ $order->order_amount }}</p>
                                        <p>₹ {{ $order->shipping_type_price }}</p>
                                        <p>₹ {{ $order->discount_amount }}</p>
                                        <p>₹ {{ $order->order_amount_with_shipping }}</p>
                                        <p class="grant-total">₹ {{ $order->order_amount }}</p>

                                    </div>

                                </div>

                            </div>

                        </div>



                        {{-- PRODUCTS --}}

                        @foreach($order->order_details as $item)

                            <div class="shipping-address hide-in-mobile" style="margin-top:20px">

                                <div class="address-pd">

                                    <h6>{{ $item->product->name }}</h6>

                                    <ul>

                                        <li>
                                            <b>Size:</b>
                                            <span style="color:#555">{{ $item->size }}</span>
                                        </li>

                                        <li>
                                            <b>Quantity:</b>
                                            {{ $item->quantity }} x ₹ {{ $item->price }}
                                        </li>

                                    </ul>

                                </div>


                                <div class="address-pd product-image">

                                    <img src="{{ asset('storage/' . ($item->product->image_thumb ?? $item->product->image)) }}"
                                        width="110">

                                </div>



                                {{-- REVIEW --}}

                                <div class="address-pd">

                                    @if($item->order_product_review)

                                        <h6>Your Review</h6>

                                        <div>

                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $item->order_product_review->rating)
                                                    <span class="filled-star">★</span>
                                                @else
                                                    <span class="empty-star">☆</span>
                                                @endif
                                            @endfor

                                        </div>

                                        <input type="text" class="form-control" value="{{ $item->order_product_review->review }}"
                                            disabled>


                                    @else

                                        <h6>Submit Your Review</h6>

                                        <form action="{{ route('customer.review.submit') }}" method="POST">

                                            @csrf

                                            <input type="hidden" name="order_id" value="{{ $order->id }}">
                                            <input type="hidden" name="order_detail_id" value="{{ $item->id }}">
                                            <input type="hidden" name="rating" id="rating-{{ $item->id }}" value="5">


                                            <div class="star-rating mb-2">

                                                <input type="radio" value="5" id="star5-{{ $item->id }}" checked>
                                                <label for="star5-{{ $item->id }}">★</label>

                                                <input type="radio" value="4" id="star4-{{ $item->id }}">
                                                <label for="star4-{{ $item->id }}">★</label>

                                                <input type="radio" value="3" id="star3-{{ $item->id }}">
                                                <label for="star3-{{ $item->id }}">★</label>

                                                <input type="radio" value="2" id="star2-{{ $item->id }}">
                                                <label for="star2-{{ $item->id }}">★</label>

                                                <input type="radio" value="1" id="star1-{{ $item->id }}">
                                                <label for="star1-{{ $item->id }}">★</label>

                                            </div>


                                            <input type="text" name="review" class="form-control mb-2"
                                                placeholder="Write your review">

                                            <button class="review-submit">
                                                Submit
                                            </button>

                                        </form>

                                    @endif

                                </div>

                            </div>

                        @endforeach


                    </div>

                </div>

            </div>
        </div>

    </section>



    {{-- CANCEL ORDER MODAL --}}

    <div class="modal fade" id="cancelModal">

        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Cancel Order</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('customer.order.cancel') }}" method="POST" enctype="multipart/form-data">

                    @csrf

                    <input type="hidden" name="order_id" value="{{ $order->id }}">

                    <div class="modal-body">

                        <select name="reason_id" class="form-control mb-2">

                            <option>Select Reason</option>

                            @foreach($cancelReasons as $reason)
                                <option value="{{ $reason->id }}">{{ $reason->title }}</option>
                            @endforeach

                        </select>

                        <textarea name="reason" class="form-control mb-2" placeholder="Enter Full Detail"></textarea>

                        <input type="file" name="image[]" multiple>

                        <p class="mt-2">
                            Note: All payment refunds will be done on the same source account
                        </p>

                    </div>

                    <div class="modal-footer">

                        <button class="btn btn-primary">
                            Submit
                        </button>

                    </div>

                </form>

            </div>
        </div>

    </div>



    <script>

        document.querySelectorAll('.star-rating input').forEach(star => {

            star.addEventListener('change', function () {

                let id = this.id.split('-')[1];
                let rating = this.value;

                document.getElementById('rating-' + id).value = rating;

            });

        });

    </script>


@endsection
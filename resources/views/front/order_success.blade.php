@extends('front.app')

@section('content')

<section class="shop-checkouts pt60 pb60 text-center">
    <div class="container">

```
    <div class="card p-5 shadow-sm">

        <h1 style="color:green;">✅ Payment Successful</h1>

        <h4 class="mt-3">
            Thank you for your order!
        </h4>

        <p class="mt-2">
            Your order number is:
        </p>

        <h3><strong>#{{ $order->order_number }}</strong></h3>

        <p class="mt-3">
            We will process your order shortly.
        </p>

        <hr>

        <h5>Total Paid</h5>
        <h3>₹{{ number_format($order->order_amount_with_shipping, 2) }}</h3>

        <div class="mt-4">
            <a href="{{ url('/') }}" class="btn btn-dark">
                Continue Shopping
            </a>
        </div>

    </div>

</div>
```

</section>

@endsection

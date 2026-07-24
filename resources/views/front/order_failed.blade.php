@extends('front.app')

@section('title', 'Payment Failed')

@section('content')
<section class="py-5">
    <div class="container text-center py-5">
        <i class="fas fa-times-circle text-danger" style="font-size:80px;"></i>
        <h2 class="mt-4">Payment Failed</h2>
        <p class="text-muted">
            @if(session('error'))
                {{ session('error') }}
            @else
                Something went wrong while processing your payment. Please try again.
            @endif
        </p>
        <a href="{{ route('shop.category') }}" class="btn btn-thm mt-3">Continue Shopping</a>
    </div>
</section>
@endsection
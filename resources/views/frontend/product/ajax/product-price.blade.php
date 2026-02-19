<h5>
    <i class="rupees-icon mb-0">₹</i> {{ $default_product_option->price }}
</h5>
@if ($default_product_option->price < $default_product_option->mrp)
    <del class="text-muted ml-2 font-weight-normal mb-0">
        <i class="rupees-icon">₹</i> {{ $default_product_option->mrp }} </del>
    <h6 class="text-danger ml-3 font-weight-bold mb-0">{{ $default_product_option->discount_percentage }}% OFF</h6>
@endif

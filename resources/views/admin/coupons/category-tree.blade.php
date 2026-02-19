<option value='{{ $child_Children->id }}'
    @if (isset($coupon) && in_array($child_Children->id, explode(',', $coupon->categories))) selected @endif>
    @if (isset($iteration))
        @for ($i = 0; $i <= $iteration; $i++) - @endfor
        @php $iteration++; @endphp
    @else
        @php $iteration = 1; @endphp -
    @endif
    {{ $child_Children->name }}
</option>

{{-- Show products for this subcategory --}}
@if (isset($child_Children->productssn) && count($child_Children->productssn) > 0)
    @foreach ($child_Children->productssn as $product)
        <option value="product-{{ $product->id }}"
            @if (isset($coupon) && in_array($product->id, explode(',', $coupon->products))) selected @endif>
            @for ($i = 0; $i <= $iteration; $i++) &nbsp;&nbsp;&nbsp; @endfor
            • {{ $product->name }}
        </option>
    @endforeach
@endif

{{-- Recursively show child categories --}}
@if (isset($child_Children->direct_childs) && count($child_Children->direct_childs) > 0)
    @foreach ($child_Children->direct_childs as $child)
        @include('admin.coupons.category-tree', [
            'child_Children' => $child,
            'iteration' => $iteration,
            'coupon' => $coupon ?? null
        ])
    @endforeach
@endif

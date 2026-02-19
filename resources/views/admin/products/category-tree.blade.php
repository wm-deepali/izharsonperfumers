<option value='{{ $child_Children->id }}' @if (isset($product_categories) && in_array($child_Children->id, $product_categories)) selected @endif>
    @if (isset($iteration))
        @for ($i = 0; $i <= $iteration; $i++)
            -
        @endfor
        @php
            $iteration++;
        @endphp
    @else
        @php
            $iteration = 1;
        @endphp
        -
    @endif
    {{ $child_Children->name }}
</option>
@if (isset($child_Children->direct_childs) && count($child_Children->direct_childs) > 0)
    @foreach ($child_Children->direct_childs as $child)
        @include('admin.products.category-tree', ['child_Children' => $child, 'iteration' => $iteration, 'product_categories' => $product_categories ?? null])
    @endforeach
@endif

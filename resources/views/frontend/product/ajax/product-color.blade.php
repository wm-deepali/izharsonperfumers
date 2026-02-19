@if (isset($colors) && count($colors) > 0)
    @foreach ($colors as $color)
        <button @if ($color->id == $default_product_option->color_id) class="btn select-color highlight_color"
        @else
        class="btn select-color" @endif style="background-color:{{ $color->code }}" color_id="{{ $color->id }}">
        </button>
    @endforeach
@endif

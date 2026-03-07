<div class="item ovh">
    <div class="shop_item bdrtrb1 px-2 px-sm-3 wow fadeIn" data-wow-duration="1.9s">

        {{-- IMAGE --}}
        <div class="thumb pb30">
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">

            <div class="thumb_info">
                <ul class="mb0">
                    <li>
                        <a href="#" class="add-to-wishlist-btn" data-product="{{ $product->id }}">
                            <span class="flaticon-heart"
                                style="{{ collect($wishlistIds)->contains($product->id) ? 'color:red;' : '' }}">
                            </span>
                        </a>
                    </li>
                    <li><a href="{{ url('product-details/' . $product->slug) }}"><span class="flaticon-show"></span></a>
                    </li>
                    <li><a href="page-shop-list-v6.html"><span class="flaticon-graph"></span></a></li>
                </ul>
            </div>

            <div class="shop_item_cart_btn d-grid">
                <a href="#" class="btn btn-thm add-to-cart-btn" data-product="{{ $product->id }}"
                    data-option="{{ optional($product->product_options->first())->id }}">
                    Add to cart
                </a>
            </div>
        </div>

        {{-- DETAILS --}}
        <div class="details">

            {{-- BRAND / CATEGORY --}}
            <div class="sub_title">
                {{ $product->subcategories->name ?? ($product->categories->name ?? '')}}
            </div>

            {{-- NAME --}}
            <div class="title">
                <a href="{{ url('product-details/' . $product->slug) }}">
                    {{ Str::limit($product->name, 40) }}
                </a>
            </div>

            {{-- RATING --}}
            <div class="review d-flex db-500">
                <ul class="mb0 me-2">
                    @for($i = 1; $i <= 5; $i++)
                        <li class="list-inline-item">
                            <a href="#">
                                <i class="fas fa-star {{ $i <= $product->avg_rating ? '' : 'text-muted' }}"></i>
                            </a>
                        </li>
                    @endfor
                </ul>

                <div class="review_count">
                    <a href="#">{{ $product->review_count }} reviews</a>
                </div>
            </div>
            {{-- PRICE --}}
            <div class="si_footer">
                <div class="price">
                    ₹{{ $product->product_options[0]->price ?? $product->min_price }}

                    @if(!empty($product->product_options[0]->mrp))
                        <small>
                            <del>₹{{ $product->product_options[0]->mrp }}</del>
                        </small>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>
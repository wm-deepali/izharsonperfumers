<style>
    .productcard-card {
        background: #fff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 25px rgba(0, 0, 0, .08);
        transition: .35s;
        border: 1px solid #f1f1f1;
    }

    .productcard-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 18px 40px rgba(0, 0, 0, .15);
    }

    /* IMAGE */

    .productcard-image {
        position: relative;
        background: #f9fafc;
        padding: 15px;
        text-align: center;
    }

    .productcard-image {
        width: 100%;
        height: 320px !important;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #fff;
    }

    .productcard-image img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }



    /* ICONS */

    .productcard-icons {
        position: absolute;
        top: 10px;
        right: 10px;
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .productcard-icon {
        background: #fff;
        width: 34px;
        height: 34px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        box-shadow: 0 4px 10px rgba(0, 0, 0, .15);
    }

    /* BODY */

    .productcard-body {
        padding: 0px 16px 16px 16px;
    }

    .productcard-category {
        font-size: 12px;
        color: #888;
        margin-bottom: 4px;
        background: #f1f1f145;
        border-radius: 4px;
        padding: 0px 10px;
    }

    .productcard-title {
        font-size: 15px;
        font-weight: 600;
        margin-bottom: 6px;
        margin-top: 10px;
    }

    .productcard-title a {
        color: #222;
        text-decoration: none;
    }

    /* RATING */

    .productcard-rating {
        font-size: 13px;
        margin-bottom: 6px;
    }

    .productcard-rating i {
        color: #ddd;
    }

    .productcard-rating i.active {
        color: #f6b100;
    }

    /* PRICE */

    .productcard-price {
        font-size: 17px;
        font-weight: 700;
        color: #222;
        margin-bottom: 10px;
    }

    .productcard-oldprice {
        font-size: 13px;
        color: #999;
        margin-left: 6px;
        text-decoration: line-through;
    }

    /* BUTTONS */

    .productcard-buttons {
        display: flex;
        gap: 8px;
    }

    .productcard-btn {
        flex: 1;
        padding: 8px;
        font-size: 13px;
        border-radius: 8px;
        text-align: center;
        text-decoration: none;
        font-weight: 600;
    }

    .productcard-cart {
        background: #eef2ff;
        color: #4f46e5;
    }

    .productcard-buy {
        background: linear-gradient(135deg, #6366f1, #4f46e5);
        color: #fff;
    }

    @media(max-width:540px) {
        .productcard-image {
            width: 100%;
            height: auto !important;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
        }

        .productcard-image {
            position: relative;
            background: #f9fafc;
            padding: 7px;
            text-align: center;
        }

        .productcard-title {
            margin-bottom: 5px;
            font-size: 15px;
            margin-bottom: 4px;
            margin-bottom: 6px;
            margin-top: 7px;
        }

        .productcard-btn {
            flex: 1;
            padding: 2px;
            font-size: 13px;
            border-radius: 8px;
            text-align: center;
            text-decoration: none;
            font-weight: 600;
        }

        .productcard-rating {
            display: none;
        }

        .productcard-body {
            padding: 0px 7px 7px 7px;
        }

        .productcard-category {
            font-size: 12px;
            color: #888;
            margin-bottom: 4px;
            margin-top: 4px;
            background: #f1f1f145;
            border-radius: 4px;
            padding: 0px 10px;
        }
    }
</style>

@php
    $productcardPrice = $product->product_options[0]->price ?? $product->min_price;
    $productcardMrp = $product->product_options[0]->mrp ?? null;
    $productcardHasDiscount = !empty($productcardMrp) && $productcardMrp > $productcardPrice;
@endphp


<div class="item">
    <div class="productcard-card">

        <!-- IMAGE -->
        <div class="productcard-image">

            <a href="{{ url('product-details/' . $product->slug) }}">
                <img src="{{ asset('storage/' . ($product->image_thumb ?? $product->image)) }}"
                    alt="{{ $product->name }}">
            </a>

            <!-- ACTION ICONS -->
            <div class="productcard-icons">

                <a href="#" class="productcard-icon add-to-wishlist-btn" data-product="{{ $product->id }}">
                    <i class="flaticon-heart"
                        style="{{ collect($wishlistIds)->contains($product->id) ? 'color:red;' : '' }}"></i>
                </a>

                <a href="{{ url('product-details/' . $product->slug) }}" class="productcard-icon">
                    <i class="flaticon-show"></i>
                </a>

            </div>

        </div>


        <!-- DETAILS -->
        <div class="productcard-body">

            <!-- CATEGORY -->
            <div class="productcard-category">
                {{ $product->subcategories->name ?? ($product->categories->name ?? '')}}
            </div>

            <!-- TITLE -->
            <h3 class="productcard-title">
                <a href="{{ url('product-details/' . $product->slug) }}">
                    {{ Str::limit($product->name, 40) }}
                </a>
            </h3>


            <!-- RATING -->
            <div class="productcard-rating">

                @for($i = 1; $i <= 5; $i++)
                    <i class="fas fa-star {{ $i <= $product->avg_rating ? 'active' : '' }}"></i>
                @endfor

                <span>({{ $product->review_count }})</span>

            </div>


            <!-- PRICE -->
            <div class="productcard-price">

                ₹{{ $productcardPrice }}

                @if($productcardHasDiscount)
                    <span class="productcard-oldprice">
                        ₹{{ $productcardMrp }}
                    </span>
                @endif

            </div>


            <!-- BUTTONS -->
            <div class="productcard-buttons">

                <a href="#" class="productcard-btn productcard-cart add-to-cart-btn" data-product="{{ $product->id }}"
                    data-option="{{ optional($product->product_options->first())->id }}">
                    Add to Cart
                </a>

                <a href="{{ url('product-details/' . $product->slug) }}" class="productcard-btn productcard-buy">
                    Buy Now
                </a>

            </div>

        </div>

    </div>
</div>
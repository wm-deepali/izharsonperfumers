@extends('front.app')

@section('title', 'Wishlist')

@section('content')
    <!-- Our Dashbord -->
    <section class="our-dashbord dashbord pb80">
        <div class="container">
            <div class="row">
                @include('customer.dashboard-nav')
                <div class="col-lg-9 col-xl-10">
                  @include('customer.dashboard-nav-dropdown')
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="account_user_deails pl40 pl0-lg">
                                <h2 class="title mb30">Wishlist</h2>
                                <div class="row">
                                   @forelse($wishlistItems as $wishlistItem)
                                        <div class="col-sm-6 col-lg-6 col-xl-3 p0">
                                            <div class="shop_item bdr1 wishlist_style">
                                                <div class="close_list">
    <a href="#" class="remove-wishlist-btn" data-product="{{ $wishlistItem->product->id }}">
        <span class="flaticon-close"></span>
    </a>
</div>
                                                <div class="thumb pb30">
                                                    <img src="{{ asset('storage/' . $wishlistItem->product->image) }}"
                                                        alt="{{ $wishlistItem->product->name }}">
                                                </div>
                                                <div class="details">
                                                    <div class="sub_title">
                                                        {{ $wishlistItem->product->subcategories->name ?? ($wishlistItem->product->categories->name ?? '')}}
                                                    </div>
                                                    <div class="title">
                                                        <a href="{{ url('product-details/' . $wishlistItem->product->slug) }}">
                                                            {{ Str::limit($wishlistItem->product->name, 40) }}
                                                        </a>
                                                    </div>
                                                    {{-- RATING --}}
                                                    <div class="review d-flex">
                                                        <ul class="mb0 me-2">
                                                            @for($i = 1; $i <= 5; $i++)
                                                                <li class="list-inline-item">
                                                                    <a href="#">
                                                                        <i
                                                                            class="fas fa-star {{ $i <= $wishlistItem->product->avg_rating ? '' : 'text-muted' }}"></i>
                                                                    </a>
                                                                </li>
                                                            @endfor
                                                        </ul>

                                                        <div class="review_count">
                                                            <a href="#">{{ $wishlistItem->product->review_count }} reviews</a>
                                                        </div>
                                                    </div>
                                                     {{-- PRICE --}}
                      <div class="si_footer">
                        <div class="price">
                          ₹{{ $wishlistItem->product->product_options[0]->price ?? $wishlistItem->product->min_price }}

                          @if(!empty($wishlistItem->product->product_options[0]->mrp))
                            <small>
                              <del>₹{{ $wishlistItem->product->product_options[0]->mrp }}</del>
                            </small>
                          @endif
                        </div>
                      </div> 
                    </div>
                                            </div>
                                        </div>
                                   @empty
<div class="col-12 text-center">
    <h4>Your wishlist is empty ❤️</h4>
</div>
@endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('click', function(e){

    const btn = e.target.closest('.remove-wishlist-btn');
    if(!btn) return;

    e.preventDefault();

    const productId = btn.dataset.product;
    const card = btn.closest('.col-xl-3');

    Swal.fire({
        title: "Remove from wishlist?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes remove"
    }).then((result)=>{

        if(!result.isConfirmed) return;

        fetch("{{ route('customer.wishlist.remove') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                product_id: productId
            })
        })
        .then(res => res.json())
        .then(data => {

            if(data.success){

                card.remove();

                Swal.fire({
                    icon:"success",
                    title:"Removed",
                    timer:1200,
                    showConfirmButton:false
                });

            }

        });

    });

});

    </script>
@endsection
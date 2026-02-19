@extends('frontend.includes.main')

@section('title','Product details')

@section('content')

<div class="product-details mt-5">
    <div class="container">
        <div class="d-flex">
            <div class="product-left-details d-flex" id="product-slider-div">
                <!--product side thumbnail  slider-->
                <div id="sync2" class="navigation-thumbs owl-carousel mt-2 d-none">
                    @if (isset($images) && count($images) > 0)
                        @foreach ($images as $product_option_image)
                            <div class="item">
                                <div class="product-img-slider-thumnail">
                                    <img src="{{ URL::asset('storage/' . $product_option_image->image) }}">
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="align-center">No Image found!</div>
                    @endif
                </div>
                <!-- end side thumbnail image -->
                <!-- product slider images  -->
                <div id="productsliderdetail" class="slider owl-carousel">
                    @if (isset($images) && count($images) > 0)
                        @foreach ($images as $product_option_image)
                            <div class="item">
                                <!-- for wishlist -->
                                <div class="wishlist-icon">
                                    <button class="btn  update-wishlist-btn" product_id="{{$product->id}}">
                                    @if (wishlist_status($product->id))
                                        <i class="fa fa-heart"  id="wishlisticon"></i>
                                    @else
                                        <i class="fa fa-heart-o"  id="wishlisticon"></i>
                                    @endif
                                    </button>
                                </div>
                                <!-- end wishlist -->
                                <div class="product-img-slider">
                                    <img src="{{ URL::asset('storage/' . $product_option_image->image) }}">
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="align-center">No Image found!</div>
                    @endif
                </div>
                <!-- end product slider images  -->
            </div>
            <div class="product-right-details ">
                <h1 class="font-weight-bold"> {{$product->name}}</h1>
                <div class="review-count-sec mb-2">
                    @php
                    $rating_point = $product->rating;
                    @endphp
                    @for($i=1; $i<=5; $i++)
                        @if($rating_point >= $i)
                            <i class="fa fa-star" style="color:#ff6600;" ></i>
                        @else
                            <i class="fa fa-star" style="color:#ccc;" ></i>
                        @endif
                    @endfor
                        <span>Reviews <span>(5) </span>
                    </span>
                </div>
                <h6 class="mb-3">{{$product->short_description}} </h6>
                <div class="fabric-section mb-3">
                    <h6 class="font-weight-bold">Fabric : <span class="text-danger">{{$product->fabric}}</span></h6>
                </div>
                <div class="product-details-price d-flex" id="product-price-div">
                    <h5>
                        <i class="rupees-icon mb-0">₹</i> {{$default_product_option->price}}
                    </h5>
                    @if ($default_product_option->price < $default_product_option->mrp)
                        <del class="text-muted ml-2 font-weight-normal mb-0">
                        <i class="rupees-icon">₹</i> {{$default_product_option->mrp}} </del>
                        <h6 class="text-danger ml-3 font-weight-bold mb-0">{{$default_product_option->discount_percentage}}% OFF</h6>
                    @endif
                </div>
                <small class="d-block">Inclusive of all taxes</small>
                @if (isset($attributes) && count($attributes) > 0)
                    @foreach ($attributes as $attribute)
                        <div class="details-size mt-4">
                            <h5 class="font-weight-bold">{{ $attribute->name }}</h5>
                            <div class="select-size-sec parent_attribute" parent_attribute_id="{{ $attribute->id }}">
                                @if (isset($attribute->direct_childs) && count($attribute->direct_childs) > 0)
                                @foreach ($attribute->direct_childs as $direct_child)
                                <button 
                                @if ($direct_child->id == $default_product_option->attribute_1_id || $direct_child->id == $default_product_option->attribute_2_id) class="btn select-size highlight_stay"
                                @else
                                class="btn select-size" @endif child_attribute_id="{{ $direct_child->id }}">{{ $direct_child->name }}
                                </button>
                                @endforeach
                                @endif
                            </div>
                        </div>
                    @endforeach
                @endif
                <div class="details-color mt-4">
                    <h5 class="font-weight-bold">Color</h5>
                    <div class="select-color-sec" id="product-color-div">
                        @if (isset($colors) && count($colors) > 0)
                            @foreach ($colors as $color)
                                <button @if ($color->id == $default_product_option->color_id) class="btn select-color highlight_color"
                                @else
                                class="btn select-color" @endif style="background-color:{{ $color->code }}" color_id="{{ $color->id }}"></button>
                            @endforeach
                        @endif
                    </div>
                </div>
                <!--  -->
                <div class="details-color mt-4">
                    <h5 class="font-weight-bold">Quantity</h5>
                    <div class="select-quantity">
                        <form class="position-relative">
                            <div class="value-button" id="decrease" onclick="decreaseQuantity()" value="Decrease Value">-</div>
                            <input type="number" name="quantity" id="quantity" value="1"  class="form-control text-center" max="{{ $default_product_option->stock }}" readonly>
                            <div class="value-button" id="increase" onclick="increaseQuantity()" value="Increase Value">+</div>
                        </form>
                    </div>
                </div>
                <div class="product-details-btn mt-5 d-flex">
                    <button class="btn mr-3 w-100 buynow-btn" id="buy-now-btn" product_id="{{ $product->id }}">Buy Now</button>
                    <input type="hidden" name="prod_slug" value="{{$product->slug}}" id="prod_slug">
                    @if (Auth::guard('customer')->check())
                        <input type="hidden" name="loggedIn" value="1" id="loggedIn">
                    @else
                        <input type="hidden" name="loggedIn" value="0" id="loggedIn">
                    @endif
                    <button class="btn w-100 add-to-cart-btn" id="add-to-cart-btn" product_id="{{ $product->id }}">Add to Cart</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="product-details-content mt-5">
    <div class="container">
        <ul id="tabs" class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a id="tab-A" href="#pane-A" class="nav-link active" data-toggle="tab" role="tab">Product Description</a>
            </li>
            <li class="nav-item">
                <a id="tab-B" href="#pane-B" class="nav-link" data-toggle="tab" role="tab">Additional Information</a>
            </li>
            <li class="nav-item">
                <a id="tab-C" href="#pane-C" class="nav-link" data-toggle="tab" role="tab">Shipping & Returns</a>
            </li>
            <li class="nav-item">
                <a id="tab-D" href="#pane-D" class="nav-link" data-toggle="tab" role="tab">Reviews</a>
            </li>
        </ul>
        <div id="content" class="tab-content" role="tablist">
            <div id="pane-A" class="card tab-pane fade show active" role="tabpanel" aria-labelledby="tab-A">
                <div class="card-header" role="tab" id="heading-A">
                    <h5 class="mb-0">
                        <!-- Note: `data-parent` removed from here -->
                        <a data-toggle="collapse" href="#collapse-A" aria-expanded="true" aria-controls="collapse-A"> Product Description </a>
                    </h5>
                </div>
                <!-- Note: New place of `data-parent` -->
                <div id="collapse-A" class="collapse show" data-parent="#content" role="tabpanel" aria-labelledby="heading-A">
                    <div class="card-body">
                        {!! $product->description !!}
                    </div>
                </div>
            </div>
            <div id="pane-B" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-B">
                <div class="card-header" role="tab" id="heading-B">
                    <h5 class="mb-0">
                        <a class="collapsed" data-toggle="collapse" href="#collapse-B" aria-expanded="false" aria-controls="collapse-B"> Additional Information </a>
                    </h5>
                </div>
                <div id="collapse-B" class="collapse" data-parent="#content" role="tabpanel" aria-labelledby="heading-B">
                    <div class="card-body">
                        {!! $product->additional_information !!}
                    </div>
                </div>
            </div>
            <div id="pane-C" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-C">
                <div class="card-header" role="tab" id="heading-C">
                    <h5 class="mb-0">
                        <a class="collapsed" data-toggle="collapse" href="#collapse-C" aria-expanded="false" aria-controls="collapse-C"> Shipping & Returns </a>
                    </h5>
                </div>
                <div id="collapse-C" class="collapse" role="tabpanel" data-parent="#content" aria-labelledby="heading-C">
                    <div class="card-body">
                        {!! $product->shipping_information !!}
                    </div>
                </div>
            </div>
            <div id="pane-D" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-D">
                <div class="card-header" role="tab" id="heading-D">
                    <h5 class="mb-0">
                        <a class="collapsed" data-toggle="collapse" href="#collapse-D" aria-expanded="false" aria-controls="collapse-D"> Reviews </a>
                    </h5>
                </div>
                <div id="collapse-D" class="collapse" role="tabpanel" data-parent="#content" aria-labelledby="heading-D">
                    <div class="card-body">
                        <div class="reviews-section">
                            <div class="review-box-section">
                                <h5 class="mb-0">Rony</h5>
                                <ul class="rating-stars">
                                    <li style="width:100%" class="stars-active">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </li>
                                    <li>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </li>
                                </ul>
                                <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                </p>
                            </div>
                            <div class="review-box-section">
                                <h5 class="mb-0">Jai</h5>
                                <ul class="rating-stars">
                                    <li style="width:100%" class="stars-active">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </li>
                                    <li>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </li>
                                </ul>
                                <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="pd-top pd-bottom-slide bg-light mt-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="col-head">
                    <h2>Recent Products</h2>
                    <p>Browse the collection of our products and top interresting products. definitely find what you are looking for.</p>
                    <div class="clearfix"></div>
                </div>
                <div id="hot-deal" class="owl-carousel owl-theme">
                    @if(!empty($recentProducts) && (count($recentProducts)> 0))
                        @foreach($recentProducts as $recent)
                            <div class="item">
                                <div class="product-col">
                                    <!-- for wishlist -->
                                    <div class="wishlist-icon">
                                        <button class="btn  update-wishlist-btn" product_id="{{$recent->id}}">
                                        @if (wishlist_status($recent->id))
                                            <i class="fa fa-heart"  id="wishlisticon"></i>
                                        @else
                                            <i class="fa fa-heart-o"  id="wishlisticon"></i>
                                        @endif
                                        </button>
                                    </div>
                                    <!-- end wishlist -->
                                    <a href="{{url('/product-details/'.$recent->slug)}}" >
                                        <div class="pro-img">
                                            @if (isset($recent->image) && Storage::exists($recent->image))
                                                <img src="{{ URL::asset('storage/' . $recent->image) }}" />
                                            @endif
                                        </div>
                                        <div class="pro-tex">
                                            <h3>{{$recent-> name }}</h3>
                                    </a>
                                    @php
                                    $rating_point = $recent->rating;
                                    @endphp
                                    <ul class="rating-stars">  
                                    @for($i=1; $i<=5; $i++)
                                        @if($rating_point >= $i)
                                            <i class="fa fa-star" style="color:#ff6600;" ></i>
                                        @else
                                            <i class="fa fa-star" style="color:#ccc;" ></i>
                                        @endif
                                    @endfor
                                    </ul>
                                    <a href="{{url('/product-details/'.$recent->slug)}}" class="cart-btn">SHOP NOW</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="align-center">No data found!</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<section class="pd-top pd-bottom-slide mt-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="col-head">
                    <h2>Related Products</h2>
                    <p>Browse the collection of our products and top interresting products. definitely find what you are looking for.</p>
                    <div class="clearfix"></div>
                </div>
                <div id="hot-deal" class="owl-carousel owl-theme">
                    @if(!empty($relatedProduct) && count($relatedProduct) > 0 )
                        @foreach($relatedProduct as $related)
                            <div class="item">
                                <div class="product-col">
                                    <!-- for wishlist -->
                                    <div class="wishlist-icon">
                                        <button class="btn  update-wishlist-btn" product_id="{{$related->product_id}}">
                                        @if (wishlist_status($related->product_id))
                                            <i class="fa fa-heart"  id="wishlisticon"></i>
                                        @else
                                            <i class="fa fa-heart-o"  id="wishlisticon"></i>
                                        @endif
                                        </button>
                                    </div>
                                    <!-- end wishlist -->
                                    <a href="{{url('/product-details/'.(productSlug($related->product_id)))}}">
                                        <div class="pro-img">
                                            @if (!empty(productImages($related->product_id)) && Storage::exists(productImages($related->product_id)))
                                                <img src="{{ URL::asset('storage/'.productImages($related->product_id)) }}" />                   
                                            @endif
                                        </div>
                                    </a>
                                    <div class="pro-tex">
                                        <a href="{{url('/product-details/'.(productSlug($related->product_id)))}}" >
                                            <h3>{{productName($related->product_id)}}</h3>
                                        </a>
                                        @php
                                        $rating_point = productRating($related->product_id);
                                        @endphp
                                        <ul class="rating-stars">  
                                            @for($i=1; $i<=5; $i++)
                                            @if($rating_point >= $i)
                                            <i class="fa fa-star" style="color:#ff6600;" ></i>
                                            @else
                                            <i class="fa fa-star" style="color:#ccc;" ></i>
                                            @endif
                                            @endfor
                                        </ul>
                                        <a href="{{url('/product-details/'.(productSlug($related->product_id)))}}" class="cart-btn">SHOP NOW </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="align-center">No data found!</div>
                    @endif 
                </div>
            </div>
        </div>
    </div>
</section>

<!-- script for product  -->
<script type="text/javascript">
    $('#productsliderdetail').owlCarousel({
        loop: true,
        items: 1,
        dots:false,
        thumbs: true,
        thumbImage: true,
        thumbContainerClass: 'owl-thumbs',
        thumbItemClass: 'owl-thumb-item',
        responsive:{
            0:{
                items:1,
                thumbImage: false,
                thumbs: false,
            },
            600:{
                items:1,
                thumbImage: false,
                thumbs: false,
            },
            1000:{
                items:1
            }
        }
    });
</script>

<script  type="text/javascript">
    var sync1 = $(".slider");
    var sync2 = $(".navigation-thumbs");
    var thumbnailItemClass = '.owl-item';

    var slides = sync1.owlCarousel({
        video:true,
        startPosition: 12,
        items:1,
        loop:true,
        margin:10,
        autoplay:true,
        autoplayTimeout:6000,
        autoplayHoverPause:false,
        nav: false,
        dots: true
    }).on('changed.owl.carousel', syncPosition);

    function syncPosition(el) {
        $owl_slider = $(this).data('owl.carousel');
        var loop = $owl_slider.options.loop;

        if(loop){
            var count = el.item.count-1;
            var current = Math.round(el.item.index - (el.item.count/2) - .5);
            if(current < 0) {
                current = count;
            }

            if(current > count) {
                current = 0;
            }

        }else{
            var current = el.item.index;
        }

        var owl_thumbnail = sync2.data('owl.carousel');
        var itemClass = "." + owl_thumbnail.options.itemClass;

        var thumbnailCurrentItem = sync2.find(itemClass).removeClass("synced").eq(current);

        thumbnailCurrentItem.addClass('synced');

        if (!thumbnailCurrentItem.hasClass('active')) {
            var duration = 300;
            sync2.trigger('to.owl.carousel',[current, duration, true]);
        }
    }

    var thumbs = sync2.owlCarousel({
        startPosition: 12,
        items:4,
        loop:false,
        margin:10,
        autoplay:false,
        nav: false,
        dots: false,
        onInitialized: function (e) {
            var thumbnailCurrentItem =  $(e.target).find(thumbnailItemClass).eq(this._current);
            thumbnailCurrentItem.addClass('synced');
        },
    })

    .on('click', thumbnailItemClass, function(e) {
        e.preventDefault();
        var duration = 300;
        var itemIndex =  $(e.target).parents(thumbnailItemClass).index();
        sync1.trigger('to.owl.carousel',[itemIndex, duration, true]);
    }).on("changed.owl.carousel", function (el) {
        var number = el.item.index;
        $owl_slider = sync1.data('owl.carousel');
        $owl_slider.to(number, 100, true);
    });

    function increaseQuantity() {
        let quantity = parseInt($('#quantity').val());
        let max_quantity = parseInt($('#quantity').attr('max'));
        if(quantity < max_quantity) {
            quantity = quantity + 1
            $('#quantity').val(quantity);
        }
    }

    function decreaseQuantity() {
        let quantity = parseInt($('#quantity').val());
        if (quantity > 1) {
            quantity = parseInt(quantity) - 1
            $('#quantity').val(quantity);
        }
    }

    function fetchProductOptionByAttribute() {
        let product_id = $('#add-to-cart-btn').attr('product_id');
        let child_attribute_ids = $('.select-size.highlight_stay').map(function() {
            return $(this).attr('child_attribute_id');
        }).toArray();

        let formData = new FormData();
        formData.append('product_id', product_id)
        formData.append('child_attribute_ids', child_attribute_ids);
        formData.append("_token", "{{ csrf_token() }}");

        $.ajax({
            url: "{{ URL::to('fetch-product-option-by-attribute') }}",
            type: 'POST',
            processData: false,
            contentType: false,
            dataType: 'json',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            context: this,
            success: function(result) {
                if (result.success) {
                    $('#product-slider-div').html(result.image_html);
                    $('#product-price-div').html(result.price_html);
                    $('#product-color-div').html(result.color_html);
                    $('#quantity').val(1);
                    $('#quantity').attr('max', result.stock);

                } else {
                    console.log(result);
                }
            }
        });
    }

    function fetchProductOptionByColor() {
        let product_id = $('#add-to-cart-btn').attr('product_id');
        let color_id = $('.select-color.highlight_color').attr('color_id');
        let child_attribute_ids = $('.select-size.highlight_stay').map(function() {
            return $(this).attr('child_attribute_id');
        }).toArray();

        let formData = new FormData();
        formData.append('product_id', product_id);
        formData.append('color_id', color_id);
        formData.append('child_attribute_ids', child_attribute_ids);
        formData.append("_token", "{{ csrf_token() }}");

        $.ajax({
            url: "{{ URL::to('fetch-product-option-by-color') }}",
            type: 'POST',
            processData: false,
            contentType: false,
            dataType: 'json',
            data: formData,
            headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
            context: this,
            success: function(result) {
                if (result.success) {
                    $('#product-slider-div').html(result.image_html);
                    $('#product-price-div').html(result.price_html);
                    $('#quantity').val(1);
                    $('#quantity').attr('max', result.stock);

                } else {
                    console.log(result);
                }
            }
        });
    }

    $(document).ready(function() {
        $(document).on('click', '.select-size', function(event) {
            $(this).closest('.parent_attribute').find(".select-size").removeClass("highlight_stay");
            $(this).addClass("highlight_stay");
            fetchProductOptionByAttribute();
        });

        $(document).on('click', '.select-color', function(event) {
            $(".select-color").removeClass("highlight_color");
            $(this).addClass("highlight_color");
            fetchProductOptionByColor();
        });

        $(document).on('click', '#add-to-cart-btn', function(event) {
            let product_id = $(this).attr('product_id');
            let color_id = $('.select-color.highlight_color').attr('color_id');
            let attribute_detail = $('.select-size.highlight_stay').map(function() {
                return {
                    parent_attribute_id: $(this).closest('.parent_attribute').attr('parent_attribute_id'),
                    child_attribute_id: $(this).attr('child_attribute_id'),
                }

            }).toArray();
            let quantity = $('#quantity').val();
            let formData = new FormData();
            formData.append('product_id', product_id);
            formData.append('color_id', color_id);
            formData.append('attribute_detail', JSON.stringify(attribute_detail));
            formData.append('quantity', quantity);
            formData.append("_token", "{{ csrf_token() }}");

            $.ajax({
                url: "{{ URL::to('add-to-cart') }}",
                type: 'POST',
                processData: false,
                contentType: false,
                dataType: 'json',
                data: formData,
                context: this,
                success: function(result) {
                    if (result.success) {
                        swal("Success!", "Added to cart", "success");
                        setTimeout(function() {
                            window.location = `{{ URL::to('/cart-details') }}`;
                        }, 1000);

                    } else {
                        console.log(result);
                    }
                }
            });
        });

        $(document).on('click', '.buynow-btn', function(event) {
            var $this = $(this);
            $this.text('Please wait...');
            let userOnline = $('#loggedIn').val();

            if( userOnline == 0){
                var href = "{{URL::to('/user-signin/'.$product->slug)}}";
                window.location.replace(href);
                
            } else {
                // var href = "{{URL::to('checkout')}}";
                let product_id = $(this).attr('product_id');
                let color_id = $('.select-color.highlight_color').attr('color_id');
                let attribute_detail = $('.select-size.highlight_stay').map(function() {
                    return {
                        parent_attribute_id: $(this).closest('.parent_attribute').attr('parent_attribute_id'),
                        child_attribute_id: $(this).attr('child_attribute_id'),
                    }

                }).toArray();
                let quantity = $('#quantity').val();
                let formData = new FormData();
                formData.append('product_id', product_id);
                formData.append('color_id', color_id);
                formData.append('attribute_detail', JSON.stringify(attribute_detail));
                formData.append('quantity', quantity);
                formData.append("_token", "{{ csrf_token() }}");

                $.ajax({
                    url: "{{ URL::to('buy-now-process') }}",
                    type: 'POST',
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    data: formData,
                    context: this,
                    success: function(result) {
                        $this.text('Buy Now');
                        if (result.success) {
                            window.location = `{{ URL::to('/checkout') }}`;

                        } else {
                            var msgText = result.msgText;
                            // console.log(result);
                            swal("Warning!", msgText, "error");
                            setTimeout(function() {
                                window.location = `{{ URL::to('/cart-details') }}`;
                            }, 1000);
                        }
                    }
                });
            }
        });
    })
</script>

@endsection
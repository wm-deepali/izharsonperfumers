 @extends('frontend.includes.main')
@section('title','My Wishlist')
@section('content')
 <section class="py-3 bg-light">
      <div class="container">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb custom-breadcumb">
          <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('listing')}}">Shop</a></li>
            <li class="breadcrumb-item active" aria-current="page">My Wishlist</li>
          </ol>
        </nav>
      </div>
    </section>

    <section>
      <div class="container">
        <div class="dashboard-flex-section d-flex my-3">
         @include('frontend.customer.dashboard_side_bar')
          <div class="dashboard-right-section border">
            <h1 class="h5 font-weight-medium border-bottom pb-2">My Wishlist</h1>
                  
                  <div class="dasboard-box">
                 
             <table class="table add-to-cart-table">
  <thead>
    <th>&nbsp;</th>
    <th>Price</th>
    <th>Status</th>
    <th>Action</th>
    
  </thead>
  <tbody>
 
                     @if (isset($wishlists) && count($wishlists) > 0)
                                @foreach ($wishlists as $wishlist)
                           <tr>
                                 <td>
                                    @if (isset($wishlist->product->image) && Storage::exists($wishlist->product->image))
                                                <img src="{{ URL::asset('storage/' . $wishlist->product->image) }}" class="add-to-cart-img">
                                            @endif        
                                            <p class="add-to-cart-heading">{{ $wishlist->product->name }}</p>
                                        </td>
                                        <td data-label="Price:" class="align-items-center"> <i class="rupees-icon mb-0">₹</i> {{ $wishlist->product->min_price }}</td>
                                        @if ($wishlist->product->stock > 0)
                                            <td data-label="Status:" class="align-items-center text-success font-weight-bold"> InStock</td>
                                        @else
                                            <td data-label="Status:" class="align-items-center text-danger font-weight-bold"> Out Of Stock</td>
                                        @endif
                                        <td class="align-items-center"> <a href="{{ route('productsdetails', $wishlist->product->slug) }}"><i class="fa fa-eye"> </i> </a>
                                     <button class="btn  update-wishlist-btn" product_id="{{$wishlist->product->id}}"> <i class="fa fa-trash"> </i> </button> </td> </tr>
                                      
                                @endforeach
                                 @else
                                   <tr>
                                 <td>
                                <div class="text-center">No wishlist item!</div>
                              </td>
                            </tr>
                               
                            @endif
   
  </tbody>
</table>
          </div>

        </div>
        <button class="filter-btn btn" id="filterbtn"><i class="fa fa-bars"></i> </button>
        </div>
      </div>
    </section>

    @endsection
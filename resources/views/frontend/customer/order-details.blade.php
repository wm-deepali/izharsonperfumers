 @extends('frontend.includes.main')
@section('title','Orders Details')
@section('content')
    <section class="py-3 bg-light">
      <div class="container">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb custom-breadcumb">
              <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('listing')}}">Shop</a></li>
            <li class="breadcrumb-item active" aria-current="page">Orders Details</li>
          </ol>
        </nav>
      </div>
    </section>

    <section>
      <div class="container">
        <div class="dashboard-flex-section d-flex my-3">
         @include('frontend.customer.dashboard_side_bar')
          <div class="dashboard-right-section border">
            <h1 class="h5 font-weight-medium border-bottom pb-2">My Orders</h1>
                  
                  <div class="dasboard-box">
                 
             <table class="table add-to-cart-table">
  <thead>
    <th>Name</th>
    <th>Quantity</th>
    <th>Size</th>
    <th>color</th>
    <th>Price</th>
    <th>Date</th>
   
  </thead>
  <tbody>
     @if(isset($orderDetails) && count($orderDetails)> 0 )
    @foreach($orderDetails as $orderDetail)
   
   <tr>
      <td>
         
       @if (!empty(productImages($orderDetail->product_id)) && Storage::exists(productImages($orderDetail->product_id)))                                
        <img src="{{ URL::asset('storage/'.productImages($orderDetail->product_id)) }}"   class="add-to-cart-img">                   
                    @endif

        <p class="add-to-cart-heading">{{$orderDetail->product_name}} </p>
      </td>
        <td data-label="Quantity:" class="align-items-center"> {{$orderDetail->quantity}}</td>
        <td data-label="Size:" class="align-items-center">  {{$orderDetail->attribute_1_name}}</td>
        <td data-label="Color:" class="align-items-center"> {{$orderDetail->color_name}}</td>
      <td data-label="Price:" class="align-items-center"> <i class="rupees-icon mb-0">₹</i> {{$orderDetail->total_price}}</td>
      <td data-label="Date:" class="align-items-center">{{\Carbon\Carbon::parse($orderDetail->created_at)->format('d M  Y')}}</td>
     
      
    </tr>
    @endforeach
    @else
    <tr>No order found!</tr>
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
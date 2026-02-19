 @extends('frontend.includes.main')
@section('title','My Orders')
@section('content')
    <section class="py-3 bg-light">
      <div class="container">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb custom-breadcumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('listing')}}">Shop</a></li>
            <li class="breadcrumb-item active" aria-current="page">My Orders</li>
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
   
   <th>Order number</th>
    <th>Price</th>                          
    <th>Date</th>
    <th>Order Status</th>
    <th>Payment Status</th>
    <th>Invoice </th>
    <th>Action</th>
    
  </thead>
  <tbody>
    @if(isset($orders) && count($orders)> 0 )
    @foreach($orders as $order)
   
   <tr>
      <td><img src="" class="add-to-cart-img"> <p class="add-to-cart-heading">{{$order->order_number}} </p></td>
      <td data-label="Price:" class="align-items-center"> <i class="rupees-icon mb-0">₹</i> {{ $order->order_amount_with_shipping }}</td>
      <td data-label="Date:" class="align-items-center"> {{\Carbon\Carbon::parse($order->created_at)->format('d M  Y')}}</td>
       <td data-label="Status:" class="align-items-center text-success font-weight-bold"> {{$order->order_status}}</td> 
       <td data-label="Status:" class="align-items-center text-success font-weight-bold"> {{$order->payment_status}}</td> 
      <td  class="align-items-center"> <a href="{{ route('invoice', $order->order_number) }}" title="Download Invoice"><i  class="fa fa-file-pdf-o"> </i> </a> </td> 
       <td class="align-items-center"> <a href="{{ route('orderDetails', $order->id) }}" title="View Details"><i class="fa fa-eye"> </i> </a></td>

      
    </tr>
  
    @endforeach 
    @else
    No order found 
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
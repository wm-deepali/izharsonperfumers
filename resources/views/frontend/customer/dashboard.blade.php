@extends('frontend.includes.main')
@section('title','Dashboard')
@section('content')
    <section class="py-3 bg-light">
      <div class="container">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb custom-breadcumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('listing')}}">Shop</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashoboard</li>
          </ol>
        </nav>
      </div>
    </section>

    <section>
      <div class="container">
        <div class="dashboard-flex-section d-flex my-3">
         @include('frontend.customer.dashboard_side_bar')
          <div class="dashboard-right-section border">
            <h1 class="h5 font-weight-medium border-bottom pb-2">Dashboard</h1>
                  
            <div class="dasboard-box">
              <h5 class="font-weight-normal">Recent Order List</h5>
             <table class="table add-to-cart-table">
			  <thead>
			    <th>Date & Time</th>
			    <th>Order Id</th>
			    <th>Build Amount</th>
			    <th>Payment Status </th>
			    <th>Status </th>

			  </thead>
			  <tbody>
			  	@if (isset($recent_orders) && count($recent_orders) > 0)
                       @foreach ($recent_orders as $recent_order)
			    <tr>
			     <td class="date-time">{{ $recent_order->created_at->format('d M Y') }} <span>{{ $recent_order->created_at->format('H:i A') }}</span></td>
			      <td data-label="Price:" class="align-items-center"> <a href="#"> {{ $recent_order->order_number }} </a> </td>
			       <td data-label="Total:" class="align-items-center"> <i class="rupees-icon mb-0">₹</i> {{ $recent_order->order_amount_with_shipping }}</td>
			     
                  <td class="align-items-center text-success"> {{ $recent_order->payment_status }}</td>
                                       
			        <td class="align-items-center"> {{ $recent_order->order_status }}</td>
			  
			    </tr>
			    @endforeach
			    @else
			    <tr>No recent order!</tr>
			    @endif

			 
			  </tbody>
			</table>
          </div>

              <div class="dasboard-box">
                 <h5 class="font-weight-normal">Purchased Order List</h5>
             <table class="table add-to-cart-table">
				  <thead>
				    		<th>Date & Time</th>
                            <th>Order Id</th>
                            <th>Build Amount</th>
                            <th>Payment Status </th>
                            <th>Order Status</th>
				    
				  </thead>
				  <tbody>
				    @if (isset($orders) && count($orders) > 0)
                                @foreach ($orders as $order)
                                    <tr>
                                        <td class="date-time">{{ $order->created_at->format('d M Y') }} <span>{{ $order->created_at->format('H:i A') }}</span></td>
                                        <td data-label="Price:" class="align-items-center"> <a href="#"> {{ $order->order_number }} </a> </td>
                                        <td data-label="Total:" class="align-items-center"> <i class="rupees-icon mb-0">₹</i> {{ $order->order_amount_with_shipping }}</td>
                                        <td class="align-items-center text-success"> {{ $order->payment_status }}</td>
                                        <td class="align-items-center"> {{ $order->order_status }}</td>
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
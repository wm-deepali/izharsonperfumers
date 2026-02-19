@extends('frontend.includes.main')
@section('title','My Enquiries')
@section('content')

 <section class="py-3 bg-light">
      <div class="container">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb custom-breadcumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('listing')}}">Shop</a></li>
            <li class="breadcrumb-item active" aria-current="page">My Enquiries</li>
          </ol>
        </nav>
      </div>
    </section>

    <section>
      <div class="container">
        <div class="dashboard-flex-section d-flex my-3">
            @include('frontend.customer.dashboard_side_bar')
          <div class="dashboard-right-section border">
            <h1 class="h5 font-weight-medium border-bottom pb-2">My Enquiries</h1>
                  
                  <div class="dasboard-box">
                 
             <table class="table add-to-cart-table">
  <thead>
   
    <th>Date / Time</th>
    <th>Order No</th>
    <th>Estimated delivery Date</th>
    <th>Order Status</th>
    
  </thead>
  <tbody>
  	@if(isset($orders) && count($orders) > 0)
  	@foreach ($orders as $enquiry)
   <tr>
      <td data-label="Date/ Time:" class="align-items-center">{{\Carbon\Carbon::parse($enquiry->created_at)->format('d M  Y')}} / {{\Carbon\Carbon::parse($enquiry->created_at)->format('h:i A')}}</td>
      <td data-label="order No:" class="align-items-center"> <a href="#"> {{$enquiry->order_number}}</a></td>
       <td data-label="Delivery:" class="align-items-center">{{\Carbon\Carbon::parse($enquiry->estimated_delivery_date)->format('d M  Y')}}</td> 
        <td data-label="Status:" class="align-items-center"> {{$enquiry->order_status}}</td> 
      
    </tr>
    @endforeach
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
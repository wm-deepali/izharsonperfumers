
@extends('frontend.includes.main')
@section('title','My Activities')
@section('content')

 <section class="py-3 bg-light">
      <div class="container">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb custom-breadcumb">
           <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('listing')}}">Shop</a></li>
            <li class="breadcrumb-item active" aria-current="page">My Activities</li>
          </ol>
        </nav>
      </div>
    </section>

    <section>
      <div class="container">
        <div class="dashboard-flex-section d-flex my-3">
          @include('frontend.customer.dashboard_side_bar')
          <div class="dashboard-right-section border">
            <h1 class="h5 font-weight-medium border-bottom pb-2">My Activities</h1>
                  
                  <div class="dasboard-box">
                
             <table class="table add-to-cart-table">
  <thead>
    <th>Name</th>
    <th>Price</th>
    <th>Date</th>
    <th>Status</th>
<!--     <th>Action</th>
 -->    
  </thead>
  <tbody>
    @if( isset($activityDetail)  && count( $activityDetail) > 0)
    @foreach($activityDetail as $activity)
   <tr>
      <td>
          
           @if (isset($activity->product->image) && Storage::exists($activity->product->image))
                                                <img src="{{ URL::asset('storage/' . $activity->product->image) }}" class="add-to-cart-img">
                                            @endif   
                                            
       
        <p class="add-to-cart-heading">{{$activity->product_name}} </p>
    </td>

      <td data-label="Price:" class="align-items-center"> <i class="rupees-icon mb-0">₹</i> {{$activity->total_price}}</td>
      <td data-label="Date:" class="align-items-center">{{\Carbon\Carbon::parse($activity->created_at)->format('d M  Y')}}</td>
       <td data-label="Status:" class="align-items-center text-success font-weight-bold"> {{$activity->order_status}}</td> 
   <!--    <td  class="align-items-center"> <button class="btn text-danger"><i class="fa fa-trash"></i>  </button> </td>  -->
      
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


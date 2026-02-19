@extends('frontend.includes.main')
@section('title','Order Confirmation')
@section('content')
<div class="container" style="margin-top:5%;     margin-left: 20%;">
	<div class="row">
        <div class="jumbotron" style="box-shadow: 2px 2px 4px #000000;">
          
              <i class="fa fa-success"></i>
            <h2 class="text-center">YOUR ORDER HAS BEEN RECEIVED</h2>
          <h3 class="text-center">Thank you <strong>{{$customer->name}}</strong> for your payment, it’s processing.</h3>
          
          <p class="text-center">Your order # is: {{$orders->order_number}}</p>
          <p class="text-center">You will receive an order confirmation email with details of your order and a link to track your process.</p>
            <center><div class="btn-group" style="margin-top:50px;">
                <a href="{{route('my-orders')}}" class="btn btn-lg btn-warning">CONTINUE</a>
            </div></center>
        </div>
	</div>
</div>
@endsection
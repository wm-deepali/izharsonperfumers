  @extends('frontend.includes.main')
@section('title','Track Order')
@section('content')

    <section class="py-3 bg-light">
      <div class="container">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb custom-breadcumb">
             <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('listing') }}">Shop</a></li>
            <li class="breadcrumb-item active" aria-current="page">Track Order</li>
          </ol>
        </nav>
      </div>
    </section>

    <section>
      <div class="container">
        <div class="dashboard-flex-section d-flex my-3">
           @include('frontend.customer.dashboard_side_bar')
          <div class="dashboard-right-section border">
            <h1 class="h5 font-weight-medium border-bottom pb-2">Track Order</h1>
                  
                  <div class="dasboard-box">
                    
                    <div class="accordion_container">
                   @if (isset($orders) && count($orders) > 0)
                     @foreach ($orders as $order)
                       <div class="border mb-3">                    
                          <div class="accordion_head">
                               <h5>Order Id : <strgon>{{ $order->order_number }} </strgon></h5>
                           
                            <h6 class="orderdate">{{ $order->created_at }} <span class="orderstatus">{{ ucfirst(str_replace('_', ' ',$order->order_status)) }}</span></h6>
                             <span class="plusminus">+</span></div>
                          <div class="accordion_body" style="display: none;">
                           <div class="order-status-sec d-flex">
                             <div class="order-status-box border">
                               <h5>Estimated Delivery Time:</h5>
                            <h6>{{ $order->estimated_delivery_date }}</h6>
                             </div>

                             <div class="order-status-box border">
                               <h5>Shipping By</h5>
                               <h6>{{ $order->shipping_name }} | <span>{{ $order->shipping_mobile_number }}</span></h6>
                             </div>

                             <div class="order-status-box border">
                               <h5>Status</h5>
                            
                                 <h6>{{ ucfirst(str_replace('_', ' ',$order->order_status)) }}</h6>
                             </div>

                             <div class="order-status-box border">
                               <h5>Tracking #:</h5>
                                <h6>{{ $order->tracking_number }}</h6>
                             </div>
                           </div>
                           <div class="orderbar-sec">
                             <div @if ($order->order_status == 'processing') class="orderbar-line" @endif @if ($order->order_status == 'confirmed') class="orderbar-line" @endif @if ($order->order_status == 'ready_for_pickup') class="orderbar-line process-1" @endif @if ($order->order_status == 'picked_up') class="orderbar-line process-2" @endif @if ($order->order_status == 'on_the_way') class="orderbar-line process-3" @endif @if ($order->order_status == 'delivered') class="orderbar-line process-4" @endif @if ($order->order_status == 'cancelled') class="orderbar-line cancel-order" @endif >
                               <div class="order-1 order-step">
                                 <div class="order-circle step-1"></div>
                                 <div class="order-status-name">
                                   <h6>Order Confirmed</h6>
                                 </div>
                               </div>
                               <div class="order-2 order-step ">
                                 <div class="order-circle step-2"></div>
                                 <div class="order-status-name">
                                   <h6>Picked by Courier</h6>
                                 </div>
                               </div>
                               <div class="order-3 order-step">
                                 <div class="order-circle step-3"></div>
                                 <div class="order-status-name">
                                   <h6>On the way</h6>
                                 </div>
                               </div>
                               <div class="order-4 order-step ">
                                 <div class="order-circle right step-4"></div>
                                 <div class="order-status-name right">
                                   <h6>Ready for pickup</h6>
                                 </div>
                               </div>
                             </div>
                           </div>
                          </div>
                        </div>
                        @endforeach
                        @endif

       

  
  
</div>

                  </div>

        </div>
        
        <button class="filter-btn btn" id="filterbtn"><i class="fa fa-bars"></i> </button>
        </div>
      </div>
    </section>
    <script type="text/javascript">
    $(document).ready(function() {
        //toggle the component with class accordion_body
        $(".accordion_head").click(function() {
            if ($('.accordion_body').is(':visible')) {
                $(".accordion_body").slideUp(300);
                $(".plusminus").text('+');
            }
            if ($(this).next(".accordion_body").is(':visible')) {
                $(this).next(".accordion_body").slideUp(300);
                $(this).children(".plusminus").text('+');
            } else {
                $(this).next(".accordion_body").slideDown(300);
                $(this).children(".plusminus").text('-');
            }
        });
    });
</script>

    @endsection
<div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">View Customer Request</h4>
        <button type="button" class="close" data-dismiss="modal" style="margin-top:-25px;">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body customer">
       <section class="msger">
  <header class="msger-header">
    <div class="msger-header-title">
     <img src="{{ URL::asset('storage/' . $order->customer->image) }}" style="width:60px" />
     <input type="hidden" name="order_id" id="order_id" />
    </div>
    <div class="msger-header-options">
        <span><strong>Customer Name-</strong> {{$order->name}}</span><br/>
        <span><strong>Order Id-</strong> #{{$order->order_number}}</span><br/>
        <span><strong>Order Date & Time-</strong> {{date('d-m-Y H:i A', strtotime($order->created_at))}}</span><br/>
        <span><strong>Request Id-</strong> @if($order->returnorder) {{$order->returnorder->request_id}} @else {{$order->cancelorder->request_id}} @endif </span><br/>
        <span><strong>Date & Time-</strong> @if($order->returnorder) {{date('d-m-Y H:i A', strtotime($order->returnorder->created_at))}} @else {{date('d-m-Y H:i A', strtotime($order->cancelorder->created_at))}}  @endif</span>
    </div>
  </header>
  <main class="msger-chat">
      @if($order->returnorder)
         <div class="card">
             <div class="card-body">
                   <div class="product_img">
                       @foreach($order->returnorder->images as $key=>$data)
                      <img src="{{ URL::asset('storage/' . $data->image) }}" class="m-1" style="width:50px" />
                      @endforeach
                  </div>
           </div>
     </div>
     @endif
    <div class="msg left-msg">
      <div class="msg-bubble">
        <div class="msg-info">
            @if($order->returnorder)
          <div class="msg-info-name">{{$order->returnorder->reasons->category}}</div>
          @else
          <div class="msg-info-name">{{$order->cancelorder->reasons->category}}</div>
          @endif
        </div>

        <div class="msg-text">
             @if($order->returnorder)
            {{$order->returnorder->reasons->title}} <br />
          {{$order->returnorder->return_reason}}
          @else
           {{$order->cancelorder->reasons->title}} <br />
          {{$order->cancelorder->cancellation_reason}}
          @endif
        </div>
      </div>
    </div>
 @if($order->cancelorder)
@if($order->cancelorder->cancellation_reason_admin)
    <div class="msg right-msg">
      <div class="msg-bubble">
        <div class="msg-info">
          <div class="msg-info-name">Admin</div>
        </div>
    
        <div class="msg-text">
          {{$order->cancelorder->cancellation_reason_admin}}
        </div>
      </div>
    </div>
    @endif
    @elseif($order->returnorder->return_reason_admin)
     <div class="msg right-msg">
      <div class="msg-bubble">
        <div class="msg-info">
          <div class="msg-info-name">Admin</div>
        </div>
    
        <div class="msg-text">
          {{$order->returnorder->return_reason_admin}}
        </div>
      </div>
    </div>
    @else
    
    
    @endif
  </main>
  @if($order->cancelorder)
  @if(!$order->cancelorder->cancellation_reason_admin)
   <button type="button" class="btn btn-primary acceptbtn">  @if($order->cancelorder) Accept Cancellation @else Accept Returning Order @endif</button>
  @endif
  @else
  @if(!$order->returnorder->return_reason_admin)
   <button type="button" class="btn btn-primary acceptbtn">  @if($order->cancelorder) Accept Cancellation @else Accept Returning Order @endif</button>
  @endif
   @endif    
        <div style="display:none" id="msger">
           <form class="msger-inputarea" method="POST" action="{{route('admin.ordercustomerrequestmessage')}}">
             @csrf
             <input type="hidden" name="order_id" value="{{$order->id}}" />
        <textarea type="text" class="msger-input" placeholder="Enter your message..." name="message"></textarea>
        <button type="submit" class="msger-send-btn">Submit</button>
      </form> 
        </div>
  
</section>
      </div>

    </div>
  </div>
  <script>
      $(".acceptbtn").click(function(){
         $("#msger").css('display','block');
         $(this).css('display','none');
      })
  </script>
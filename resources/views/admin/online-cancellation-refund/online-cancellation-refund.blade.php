@include('admin.header')
<!--/home/xyzeagledemo/public_html/opalmarketings/resources/views/admin/online-cancellation-refund/online-cancellation-refund.blade.php-->
<style>
    :root {
  --body-bg: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
  --msger-bg: #fff;
  --border: 2px solid #ddd;
  --left-msg-bg: #ececec;
  --right-msg-bg: #579ffb;
}
.msger {
  display: flex;
  flex-flow: column wrap;
  justify-content: space-between;
  width: 100%;
  border: var(--border);
  border-radius: 5px;
  background: var(--msger-bg);
  box-shadow: 0 15px 15px -5px rgba(0, 0, 0, 0.2);
}

.msger-header {
  display: flex;
  justify-content: space-between;
  padding: 10px;
  align-items:center;
  border-bottom: var(--border);
  background: #eee;
  color: #666;
}

.msger-chat {
  flex: 1;
  overflow-y: auto;
  padding: 10px;
}
.msg {
  display: flex;
  align-items: flex-end;
  margin-bottom: 10px;
}
.msg:last-of-type {
  margin: 0;
}
.msg-img {
  width: 50px;
  height: 50px;
  margin-right: 10px;
  background: #ddd;
  background-repeat: no-repeat;
  background-position: center;
  background-size: cover;
  border-radius: 50%;
}
.msg-bubble {
  max-width: 450px;
  padding: 15px;
  border-radius: 15px;
  background: var(--left-msg-bg);
}
.msg-info {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 10px;
}
.msg-info-name {
  margin-right: 10px;
  font-weight: bold;
}

.left-msg .msg-bubble {
  border-bottom-left-radius: 0;
}

.right-msg {
  flex-direction: row-reverse;
}
.right-msg .msg-bubble {
  background: var(--right-msg-bg);
  color: #fff;
  border-bottom-right-radius: 0;
}
.right-msg .msg-img {
  margin: 0 0 0 10px;
}

.msger-inputarea {
  display: flex;
  padding: 10px;
  border-top: var(--border);
  background: #eee;
}
.msger-inputarea * {
  padding: 10px;
  border: none;
  border-radius: 3px;
  font-size: 1em;
}
.msger-input {
  flex: 1;
  background: #ddd;
}
.msger-send-btn {
  margin-left: 10px;
  background: rgb(0, 196, 65);
  color: #fff;
  font-weight: bold;
  cursor: pointer;
  transition: background 0.23s;
}
.msger-send-btn:hover {
  background: rgb(0, 180, 50);
}

.msger-chat {
  background-color: #fcfcfe;
}
.card
{
    border:1px solid gray;
}

</style>

<div class="app-content content container-fluid">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-xs-12 mb-2">
                <h3 class="content-header-title mb-0">Order Cancellation</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-xs-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            {{-- <li class="breadcrumb-item">Catalog</li> --}}
                            <li class="breadcrumb-item active">Order Cancellation</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <section>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="card-body collapse in">
                                <div class="card-block card-dashboard">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered" id="example">
                                            <thead>
                                                <tr>
                                                    <th>Date &amp; Time</th>
                                                    <th>Order ID</th>
                                                    <th>Customer Name</th>
                                                    <th>Mobile Number</th>
                                                    <th>Billed Amount</th>
                                                    <th>Payment Status</th>
                                                    <th>Customer Request</th>
                                                    <th>Order Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($orders as $order)
                                                @if($order->order_status=="Cancelled by customer" || $order->order_status=="Return Requested")
                                                <tr>
                                                    <td>{{ $order->created_at }}</td>
                                                    <td>#{{ $order->order_number}}</td>
                                                    <td>{{ $order->name}}</td>
                                                    <td>{{ $order->mobile_number}}</td>
                                                    <td>{{ $order->order_amount_with_shipping}}</td>
                                                    <td>{{ $order->payment_status}}</td>
                                                    <td>@if($order->returnorder) Return Order @else Order Cancellation @endif</td>
                                                    <td>{{ $order->order_status}}</td>
                                                    <td class="text-truncate">
                                                        <ul class="actions">
                                                         <li><a href="#" class="viewcustomer" title="View Customer Request" data-toggle="modal" order_id="{{$order->id}}"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                                         <li><a href="{{route('admin.manage-order.show',$order->id)}}" title="View Order Detail"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                                         <li><a href="{{route('admin.viewcustomer',$order->customer_id)}}" title="View Customer Detail"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                                         <li><a href="#" title="Download Invoice"><i class="fa fa-download" aria-hidden="true"></i></a></li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                                @endif
                                                @endforeach
                                               
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
<!-- Process Refunds Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Process Refunds</h4>
        <button type="button" class="close" data-dismiss="modal" style="margin-top:-25px;">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       <form>
           <div class="form-group row">
               <div class="col-lg-4">
                   <label>Enter Transaction ID</label>
                   <input type="text" class="form-control" />
               </div>
                <div class="col-lg-4">
                   <label>Amount Refunded</label>
                   <input type="text" class="form-control" />
               </div>
               <div class="col-lg-4">
                   <label> Date & Time</label>
                   <input type="datetime-local" class="form-control" />
               </div>
              
           </div>
            <div class="row">
                <div class="col-lg-12">
                 <div class="form-actions">
                <button type="button" class="btn btn-primary pull-right"> Submit</button>
                </div>
            </div>
            </div>
       </form>
      </div>

    </div>
  </div>
</div>

<div id="customer-modal" class="modal fade" role="dialog">
  
</div>
<!--  //  Process Refunds Modal -->

@include('admin.footer')




<script>
$('body').on('click', '.viewcustomer', function() {
    var id = $(this).attr('order_id');
    $(".customer #order_id").val(id);
            $.ajax({
                url: `{{ URL::to('admin/order-customer-request/${id}') }}`,
                type: "GET",
                dataType: "json",
                success: function(result) {
                    if (result.success) {
                        console.log(result.html)
                        $("#customer-modal").html(result.html);
                        $("#customer-modal").modal('show');
                    } else {

                    }
                }
            });
    
})

    
</script>

<!--  //   View Customer Request Modal -->

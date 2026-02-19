@include('admin.header')
<!-- @section('title','Dasboard')
 -->
<div class="app-content content container-fluid">
    <div class="content-wrapper">
        <div class="content-body">
            <div class="row">
                <div class="col-xl-3 col-lg-6 col-xs-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="media">
                                <div class="p-2 text-xs-center bg-primary bg-darken-2 media-left media-middle"> <i class="fa fa-users font-large-2 white"></i> </div>
                                <div class="p-2 bg-gradient-x-primary white media-body">
                                    <h5>Number of Customers</h5>
                                    <h5 class="text-bold-400"></i> {{$customer}}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-xs-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="media">
                                <div class="p-2 text-xs-center bg-danger bg-darken-2 media-left media-middle"> <i class="fa fa-line-chart font-large-2 white"></i> </div>
                                <div class="p-2 bg-gradient-x-danger white media-body">
                                    <h5>Order Delivered</h5>
                                    <h5 class="text-bold-400"> {{$ordertotal}}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-xs-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="media">
                                <div class="p-2 text-xs-center bg-warning bg-darken-2 media-left media-middle"> <i class="icon-basket-loaded font-large-2 white"></i> </div>
                                <div class="p-2 bg-gradient-x-warning white media-body">
                                    <h5>Pending Orders</h5>
                                    <h5 class="text-bold-400">{{$ordertotalpending}}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-xs-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="media">
                                <div class="p-2 text-xs-center bg-success bg-darken-2 media-left media-middle"> <i class="fa fa-users font-large-2 white"></i> </div>
                                <div class="p-2 bg-gradient-x-success white media-body">
                                    <h5>Total Sales</h5>
                                    <h5 class="text-bold-400"><i class="fa fa-inr"></i>&nbsp;{{$ordertotalamount}}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6 col-lg-12">
                    <div class="card card-dash">
                        <div class="card-header">
                            <h4 class="card-title">Recent Orders</h4>
                        </div>
                        <div class="card-content">
                            <div class="table-responsive">
                                <table id="example" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Date & Time</th>
                                            <th>Order ID</th>
                                            <th> Customer Name </th>
                                            <th>Email ID</th>
                                             <th>Mobile Number</th>
                                             <th>Billed Amount</th>
                                             <th>Payment Status</th>
                                             <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($ordertoday as $data)
                                            <tr>
                                                <td>{{$data->created_at}}</td>
                                                <td>#{{$data->order_number}}</td>
                                                <td>{{$data->name}}</td>
                                                <td>{{$data->email}}</td>
                                                <td>{{$data->mobile_number}}</td>
                                                <td>${{$data->order_amount_with_shipping}}</td>
                                                <td>{{$data->payment_status}}</td>
                                                <td class="text-truncate">
                                                <ul class="actions">
                                                    <li><a href="{{url('admin/manage-order/'.$data->id)}}" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                            </td>
                                            </tr>
                                            @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="col-lg-6 col-md-6 col-6">
                    <div class="card card-dash">
                        <div class="card-header border-0-bottom">
                            <h4 class="card-title">Top Selling Product</h4>
                        </div>
                        <div class="card-content">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card-body collapse in">
                                        <div class="card-block card-dashboard">
                                            <div class="table-responsive">
                                                <table class="table table-striped" id="example6">
                                                    <thead>
                                                        <tr>
                                                            <th>Date & Time</th>
                                                            <th>Product Name</th>
                                                            <th>Total Sales</th>
                                                            <th>Taxes </th>
                                                            <th>Total Shipping Cost </th>
                                                            <th>Billed Amount </th>
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($producttopsale as $key=>$data)
                                                         <tr>
                                                         <td>{{$data->created_at}}</td>
                                                        <td>{{$data->product_name}}</td>
                                                        <td>{{$data->total_sales}}</td>
                                                        <td>{{$data->total_gst_amount}}</td>
                                                        <td>{{$data->shipping_type_price}}</td>
                                                         <td>{{$data->order_amount_with_shipping}}</td>
                                                       
                                                       
                                                        
                                                    </tr>  
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             <div class="row">
                <div class="card-deck mb-2">
                  <div class="card card-dash">
                <div class="col-xl-12 col-lg-12">
                  
                        <div class="card-header">
                            <h4 class="card-title">Recent Customers</h4>
                        </div>
                        <div class="card-content">
                            <div class="table-responsive">
                                <table id="example2" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Date & Time</th>
                                            <th> Customer Name </th>
                                            <th>Email ID</th>
                                             <th>Mobile Number</th>
                                             <th>Country </th>
                                             <th>State </th>
                                             <th>City </th>
                                             <th>Zip Code</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($customertoday as $data)
                                        <tr>
                                            <td>{{$data->created_at}}</td>
                                            <td>{{$data->name}}</td>
                                            <td>{{$data->email}}</td>
                                            <td>{{$data->mobile_number}}</td>
                                            <td>@if(isset($data->countries)){{$data->countries->name}} @endif</td>
                                            <td>@if(isset($data->states)){{$data->states->name}} @endif</td>
                                            <td>@if(isset($data->citys)){{$data->citys->name}} @endif</td>
                                            <td>{{$data->pincode}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-dash">
                <div class="col-xl-12 col-lg-12">
                    
                        <div class="card-header">
                            <h4 class="card-title">Recent Reviews</h4>
                        </div>
                       <div class="card-head">
                          <ul class="nav nav-tabs" role="tablist">
                    	<li class="nav-item">
                    		<a class="nav-link active" data-toggle="tab" href="#onlineStore " role="tab">Orders</a>
                    	</li>
                    	<li class="nav-item">
                    		<a class="nav-link" data-toggle="tab" href="#serviceBooking" role="tab">Services</a>
                    	</li>
                    </ul>
                   
                </div>
                <div class="tab-content">
                	<div class="tab-pane active" id="onlineStore" role="tabpanel">
                
                		<section>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="card-body collapse in">
                                        <div class="card-block card-dashboard">
                                            <div class="table-responsive">
                                                <table class="table table-striped" id="example3">
                                                    <thead>
                                                        <tr>
                                                            <th>Date &amp; Time</th>
                                                            <th>Order ID</th>
                                                            <th>Customer Name</th>
                                                            <th>Ratings </th>
                                                            <th>Feedback Detail</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($orderreview as $data)
                                                         <tr>
                                                                <td>{{$data->created_at}}</td>
                                                                <td>#{{$data->order->order_number}}</td>
                                                               <td>#{{$data->order->name}}</td>
                                                                <td>
                                                                    <div class="review-star">
                                                                            @for($x=0;$x<$data->rating;$x++)
                                                                            <i class="fa fa-star"></i>
                                                                           @endfor
                                                                        </div>
                                                                </td> 
                                                                <td>{{$data->review}}</td>
                                                                <td class="text-truncate">
                                                                <ul class="actions">
                                                                <li><a href="{{url('admin/manage-order/'.$data->order_id)}}" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                                                </ul>
                                                            </td>
                                                        </tr>
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
            </div>
            </div>
            
            
            <div class="row">
                <div class="col-lg-6 col-md-6 col-6">
                    <div class="card card-dash">
                        <div class="card-header border-0-bottom">
                            <h4 class="card-title">Visitors Overview</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row my-1">
                                    <div class="col-lg-4 col-12">
                                        <div class="text-center">
                                            <h3>23,454</h3>
                                            <p class="text-muted">Page Views <span class="success"><i class="feather icon-arrow-up"></i> 8.16%</span></p>
                                            <div id="sp-tristate-bar-total-revenue"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-12">
                                        <div class="text-center">
                                            <h3>6,630</h3>
                                            <p class="text-muted">Unique Visitor <span class="danger"><i class="feather icon-arrow-down"></i> 2.30%</span></p>
                                            <div id="sp-stacked-bar-total-sales"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-12">
                                        <div class="text-center">
                                            <h3>86,578</h3>
                                            <p class="text-muted">Total Visits <span class="warning"><i class="feather icon-arrow-up"></i> 4.27%</span></p>
                                            <div id="sp-bar-total-cost"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="">
                                            <canvas id="line-chart" width="800" height="450"></canvas>
                                        </div>
                                        <ul class="list-inline text-center mt-1">
                                            <li class="mr-1">
                                                <h6><i class="fa fa-circle success"></i> <span>Page Views</span></h6>
                                            </li>
                                            <li class="mr-1">
                                                <h6><i class="fa fa-circle warning"></i> <span>Total Visits</span></h6>
                                            </li>
                                            <li class="mr-1">
                                                <h6><i class="fa fa-circle danger"></i> <span>Unique Visitor</span></h6>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               <div class="col-lg-6 col-md-6 col-6">
                    <div class="card card-dash">
                        <div class="card-header border-0-bottom">
                            <h4 class="card-title">Sales By Category</h4>
                        </div>
                        <div class="card-content">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card-body collapse in">
                                        <div class="card-block card-dashboard">
                                            <div class="table-responsive">
                                                <table class="table table-striped" id="example5">
                                                    <thead>
                                                        <tr>
                                                            <th>Date & Time</th>
                                                            <th>Category Name</th>
                                                            <th>Total Sales</th>
                                                            <th>Taxes </th>
                                                            <th>Total Shipping Cost </th>
                                                            <th>Billed Amount </th>
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($categorysale as $key=>$data)
                                                         <tr>
                                                       <td>{{$data->created_at}}</td>
                                                        <td>{{$data->category_name}}</td>
                                                        <td>{{$data->total_sales}}</td>
                                                        <td>{{$data->total_gst_amount}}</td>
                                                        <td>{{$data->shipping_type_price}}</td>
                                                         <td>{{$data->order_amount_with_shipping}}</td>
                                                       
                                                       
                                                        
                                                    </tr>  
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.footer')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ajaxStart(function() {
        $("#loader").modal('show');
    });
    $(document).ajaxComplete(function() {
        $("#loader").modal('hide');
    });
    setTimeout(function() {
        $.ajax({
            url: "{{ URL::to('get-chart-data') }}",
            type: "GET",
            dataType: "json",
            success: function(result) {
                console.log(result);
                new Chart(document.getElementById("sales-chart"), {
                    type: 'pie',
                    data: {
                        labels: result.categoryname,
                        datasets: [{
                            label: "Sales By Category (this Week)",
                            backgroundColor: ["#00b5b8", "#ff7588", "#16d39a"],
                            data: result.categorycount
                        }]
                    },
                    options: {
                        title: {
                            display: true,
                            text: 'Sales By Category (this Week)'
                        }
                    }
                });
            }
        });
    }, 400);
    new Chart(document.getElementById("line-chart"), {
        type: 'line',
        data: {
            labels: [1500, 1600, 1700, 1750, 1800, 1850, 1900, 1950, 1999, 2050],
            datasets: [{
                data: [86, 114, 106, 106, 107, 111, 133, 221, 783, 2478],
                label: "Page Views",
                borderColor: "#16d39a",
                fill: false
            }, {
                data: [282, 350, 411, 502, 635, 809, 947, 1402, 3700, 5267],
                label: "Total Visits",
                borderColor: "#ffa87d",
                fill: false
            }, {
                data: [168, 170, 178, 190, 203, 276, 408, 547, 675, 734],
                label: "Unique Visitors",
                borderColor: "#ff7588",
                fill: false
            }]
        },
        options: {
            title: {
                display: true,
                text: 'Website Performance Statistics'
            }
        }
    });
</script>

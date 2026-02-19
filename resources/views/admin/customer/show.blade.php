@include('admin.header')
<div class="app-content content container-fluid">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-xs-12 mb-2">
                <h3 class="content-header-title mb-0">CATALOG</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-xs-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item">All Customers</li>
                            <li class="breadcrumb-item active">Manage Customers</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        
      
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">MANAGE - CUSTOMERS</h4>
                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                             <!--<li><a href="javascript:void(0)" class="add-brand"><i class="fa fa-plus"></i> Add </a></li> -->
                            <li><a href="javascript:history.go(-1)"><i class="fa fa-backward"></i> Go Back</a></li>
                        </ul>
                    </div>
                </div>
                <section>
                    <div class="container">
                      <div class="profile-header proposal">
                        <div class="profile-img">
                          <img src="{{ URL::asset('storage/' . $customer->image) }}" width="150" alt="Profile Image">
                        </div>
                        <div class="profile-nav-info">
                            
                            <div class="row">
                                <div class="col-sm-5">
                                    <ul class="list-style">
                                        <h4><strong>{{$customer->name}}</strong></h4>
                                        <li>
                                            <i class="fa fa-phone"></i> {{$customer->mobile_code}} - {{$customer->mobile_number}}
                                        </li>
                                        <li><i class="fa fa-envelope"></i> {{$customer->email}}</li>
                                        <li><strong>Gender</strong>: {{$customer->gender}}</li>
                                        <li><strong>DOB</strong>: {{$customer->dob}}</li>
                                    </ul>
                                </div>
                                
                                <div class="col-sm-7 bl"> 
                                    <div class="rg-usr">
                                        <div class="d-flex justify-content-between">
                                    
                                    </div>
                                         <ul class="list-style">
                                             
                                        <li><strong>Full Address</strong> : <span class="user-add">{{$customer->shipping_address}}</span></li>
                                        <li>
                                            <ul class="list-style-o">
                                                <li>
                                                    <strong>Country</strong> : <span class="ref-n">@if(isset($customer->country)) {{$customer->countries->name}} @endif</span>
                                                </li>
                                                <li>
                                                    <strong>State</strong> : <span class="ref-n">@if(isset($customer->state)) {{$customer->states->name}} @endif</span>
                                                </li>
                                            </ul>
                                         </li>
                                        <li>
                                            <ul class="list-style-o">
                                                <li>
                                                    <strong>City</strong> : @if(isset($customer->city)) {{$customer->citys->name}} @endif
                                                </li>
                                                <li>
                                                     <strong>Zip Code</strong> : <span class="ref-n">{{$customer->pin_code}}</span>
                                                </li>
                                            </ul>
                                          
                                        </li>
                                        
                                        <li>
                                            <strong>Registration Date & Time</strong> : <span class="reg-d">{{date('d/m/y H:i A',strtotime($customer->registration_date))}}</span>
                                        </li>
                                        <!--<li>-->
                                        <!--    <strong>Referred By</strong> : <span class="ref-n">Mohan Singh (9000000000)</span>-->
                                        <!--</li>-->
                                        
                                    </ul>
                                    <p><a href="" data-toggle="modal" data-target="#edit_profile"><i class="fa fa-pencil-square-o"></i></a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>
                     <div class="proposal mb-3"> 
                        <div id="tabs">
                          <ul>
                            <li><a href="#tabs-1">Summary</a></li>
                            <li><a href="#tabs-2">Addresses</a></li>
                            <li><a href="#tabs-3">Change Password</a></li>
                            <li><a href="#tabs-4">Order History</a></li>
                            <li style="display:none"><a href="#tabs-5">Service Bookings</a></li>
                            <li style="display:none"><a href="#tabs-6">Loyalty & Rewards</a></li>
                          </ul>
                              <div id="tabs-1">
                                <section class="cover card-orders-detail">
                                    
                                    
                                         <div class="row">
                                             <div class="col-md-12">
                                                       <h5><strong> Order Summary</strong></h5>
                                                       <table class="table table-bordered">
                                                           <thead>
                                                               <tr>
                                                                   <th>No. of Orders</th>
                                                                   <th>Delivered Orders</th>
                                                                   <th>Pending Orders</th>
                                                                   <th>Cancelled Orders</th>
                                                                   <th>Billed Amount</th>
                                                               </tr>
                                                           </thead>
                                                           
                                                           <tbody>
                                                               <tr>
                                                                   <td>{{$data['orders']}}</td>
                                                                   <td>{{$data['delivered_orders']}}</td>
                                                                   <td>{{$data['pending_orders']}}</td>
                                                                   <td>{{$data['cancelled_orders']}}</td>
                                                                   <td>{{$data['amount']}}</td>
                                                               </tr>
                                                           </tbody>
                                                       </table>
                                                       
                                                       
                                             </div>
                                         </div>
                                </section>
                            </div><!-- end tab -->
                            
                            <div id="tabs-2">
                                <section>
                                     @if(isset($customer->shipping) && count($customer->shipping) > 0)
                                        @foreach ($customer->shipping as $key=>$shiiping)
                                      
                                  <div class="prop-content row"> 
                                  <div class="col-md-6">
                                       <div class="card-orders-detail">
                                           <h3>Billing Address</h3>
                                         <div class="card d-flex justify-content-between">
                                             
                                             <div class="address_details">
                                             <h5><strong>{{$customer->billing[$key]->name}}</strong></h5>
                                             <p>{{$customer->billing[$key]->address}}</p>
                                             <p><strong>Country:</strong> {{$customer->billing[$key]->countries->name}}</p> 
                                             <p><strong>City:</strong>{{$customer->billing[$key]->citys->name}} </p>
                                             <p><strong>Contact No:</strong>{{$customer->billing[$key]->mobile_number}} </p>
                                             <p><strong>Email Id:</strong>{{$customer->billing[$key]->email}} </p>
                                             <p><strong>State:</strong>{{$customer->billing[$key]->states->name}} </p>
                                             <p><strong>Zip Code:</strong>{{$customer->billing[$key]->pincode}} </p>
                                           </div>
                                           <p class="text-right"><a href="" 
                                           data-id="{{$customer->billing[$key]->id}}"
                                           data-toggle="modal" data-target="#billing_address" class="billingmodal"><i class="fa fa-pencil-square-o"></i></a></p>
                                         </div>
                                     </div>
                                  </div>
                                  
                                  <div class="col-md-6">
                                       <div class="card-orders-detail">
                                           <h3>Pickup & Delivery Address</h3>
                                         <div class="card d-flex justify-content-between">
                                             <div class="address_details">
                                             <h5><strong>{{$shiiping->name}}</strong></h5>
                                             <p>{{$shiiping->address}}</p>
                                             <p><strong>Country:</strong> {{$shiiping->countries->name}}</p>
                                             <p><strong>City:</strong>{{$shiiping->citys->name}} </p>
                                             <p><strong>Contact No:</strong>{{$shiiping->name}} </p>
                                             <p><strong>Email Id:</strong>{{$shiiping->email}} </p>
                                             <p><strong>State:</strong>{{$shiiping->states->name}} </p>
                                             <p><strong>Zip Code:</strong> {{$shiiping->pincode}}</p>
                                           </div>
                                            <p class="text-right"><a href=""
                                             data-id="{{$shiiping->id}}" 
                                            data-toggle="modal" data-target="#shipping_address" class="shippingmodal"><i class="fa fa-pencil-square-o"></i></a></p>
                                         </div>
                                     </div>
                                  </div>
                             </div>
                             @endforeach
                             @endif
                                </section>
                            </div>
                            
                            <div id="tabs-3">
                    <section>
                
                <h3>Change Password</h3>
                <form method="post" id="submitpassword" action="{{route('admin.manageCustomer.changepassword',$customer->id)}}">
                    @csrf
                    <div class="form-group row passwordchange">
                <!--<div class="col-sm-4">-->
                <!--    <div class="form-group">-->
                <!--    <label class="label-control">Old Password</label>-->
                <!--    <input type="password" class="form-control" name="old_password" />-->
                <!--</div>-->
                <!--</div>-->
                <div class="col-sm-4">
                    <label class="label-control">New Password</label>
                    <input type="password" class="form-control" name="new_password"  />
                    <div class="text-danger" id="new_password-err"></div>
                </div>
                 <div class="col-sm-4">
                    <label class="label-control">Confirm Password</label>
                    <input type="password" class="form-control" name="new_password_confirmation" />
                     <div class="text-danger" id="new_password_confirmation-err"></div>
                </div>
                
            </div>
             <button class="btn adminbtn-blue" type="submit">Change Password</button>
                </form>
              
              
               
              
            </section>
        </div>
        
        <div id="tabs-4">
        <section>
                
                <h3>Order History</h3>
                
              <div class="prop-content">  
               <div class="card-body collapse in">
                                <div class="card-block card-dashboard">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered" id="example">
                                            <thead>
                                                <tr>
                                                    <th>Date &amp; Time</th>
                                                    <th>Customer Name</th>
                                                    <th>Mobile Number & Email ID</th>
                                                    <th>Order ID</th>
                                                    <!--<th>Shipping Details</th>-->
                                                    <th>Order Value</th>
                                                    <th>Payment Status</th>
                                                    <th>Order Status</th>
                                                    <!--<th>Transection Number</th>-->
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(isset($customer->orders) && count($customer->orders) > 0)
                                                    @foreach ($customer->orders as $order)
                                                        <tr>
                                                            <td>{{date('d/m/y H:i A',strtotime($order->created_at))}}</td>
                                                            <td>{{ $order->name }}</td>
                                                            <td>{{ $order->mobile_number }}/{{ $order->email }}</td>
                                                            <td>{{ $order->order_number}}</td>
                                                            <!--<td>-->
                                                            <!--    {{ $order->address }}, {{ $order->city }}, {{ $order->state }} , {{ $order->country }} - {{ $order->pincode }}-->
                                                            <!--</td>-->

                                                            <td>{{ $order->order_amount_with_shipping }}</td>
                                                            <td>{{ $order->payment_status }}</td>
                                                            
                                                            <!-- <td>{{ $order->order_status }}</td> -->
                                                            <td>
                                                                <select class="form-control order_status" data-id="{{$order->id}}" style="width: 150px !important;">
                                                                    <option value="processing" {{ ($order->order_status == "processing") ? "selected" : "" }}>Processing</option>
                                                                    <option value="dispatch" {{ ($order->order_status == "dispatch") ? "selected" : "" }}>Dispatch</option>
                                                                    <option value="pickup" {{ ($order->order_status == "pickup") ? "selected" : "" }}>Pickup</option>
                                                                    <option value="delivery_time" {{ ($order->order_status == "delivery_time") ? "selected" : "" }}>Delivery Time</option>
                                                                </select>
                                                            </td>
                                                            
                                                            <!--<td>{{ $order->transaction_number }}</td>-->

                                                            <td class="text-truncate">
                                                                <ul class="actions">
                                                                    <li><a href="{{route('admin.manage-order.show',$order->id)}}" class="view-orders" brand_id="{{ $order->id }}" title="View order details  "><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                                                    <li><a href="{{route('admin.manage-order.show',$order->id)}}" class="view-orders" brand_id="{{ $order->id }}" title="Download Invoice"><i class="fa fa-download" aria-hidden="true"></i></a></li>
                                                                    <li><a href="javascript:void(0)" class="view-orders rating" id="ratingshow" onclick="showrating({{ $order->id }})" brand_id="{{ $order->id }}" data-toggle="modal" data-target="#ratingmodal" title="View rating  "><i class="fa fa-edit" aria-hidden="true"></i></a></li>
                                                                    <li><a href="javascript:void(0)" class="view-orders" brand_id="{{ $order->id }}" data-toggle="modal" data-target="#complaintmodal" title="View Complaint  "><i class="fa fa-edit" aria-hidden="true"></i></a></li>
                                                                    <!--<li><a href="javascript:void(0)" class="eit-faq" faq_id="{{ $order->id }}" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>-->
                                                                    <!--<li><a href="javascript:void(0)" onclick="deleteConirmation({{ $order->id }})" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>-->
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
              
      </div>
            </section>
        </div>
        
        <div id="tabs-5">
        <section>
              <div class="prop-content">  
               <div class="col-xs-12">
                    <h3>Service Booking Details</h3>
                            <div class="card-body collapse in">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered" id="example1">
                                            <thead>
                                                <tr>
                                                    <!--<th>Srno</th>-->
                                                    <th>Date &amp; Time</th>
                                                    <th>Customer Name</th>
                                                    <th>Mobile Number & Email ID</th>
                                                    <th>Booking ID</th>
                                                    <th>Total Cost</th>
                                                    <th>Payment Status</th>
                                                     <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                               
                                                @if (isset($dataservicesall) && count($dataservicesall) > 0)
                                                    @foreach ($dataservicesall as $itm)
                                                        <tr>
                                                           
                                                            <td>{{date('d/m/y H:i A',strtotime($itm['created_at']))}}</td>
                                                            <td>{{ $itm['name'] }}</td>
                                                            <td>{{ $itm['email'] }} /{{ $itm['mobile_number'] }}</td>
                                                            <td>{{ '#'.$itm['order_number'] }}</td>
                                                            <td>{{ $itm['order_amount_with_gst'] }}</td>
                                                            <td>{{ $itm['payment_status'] }}</td>
                                                         <td class="text-truncate">
                                                                <ul class="actions">
                                                                <li><a href="{{url('admin/manage-service-bookings/'.$itm['id'])}}" class="view-orders" brand_id="{{ $itm['id'] }}" title="View service details  "><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                                                    <!--<li><a href="{{ route('admin.manage-category.show', $itm['id']) }}" title="Children"><i class="fa fa-plus" aria-hidden="true"></i></a></li>-->
                                                                    <!--<li><a href="javascript:void(0)" class="edit-category" category_id="{{ $itm['id'] }}" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>-->
                                                                    <!--<li><a href="javascript:void(0)" onclick="deleteConfirmation({{ $itm['id'] }})" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>-->
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                </div>
                            </div>
                        </div>
                  </div>
            </section>
        </div>
        
        
        <div id="tabs-6">
         <section>
              <div class="prop-content">  
               <div class="col-xs-12">
                    <h3>Loyalty & Rewards</h3>
                     <ul id="accounttab" class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a id="tab-A" href="#pane-A" class="nav-link active" data-toggle="tab" role="tab">Earned Rewards</a>
                            </li>
                            <li class="nav-item">
                                <a id="tab-B" href="#pane-B" class="nav-link" data-toggle="tab" role="tab">Redeem Rewards</a>
                            </li>
                        </ul>

    <div id="content" class="tab-content" role="tablist">
        <!-- Header Data Start  -->
        <div id="pane-A" class="card tab-pane fade show active in" role="tabpanel" aria-labelledby="tab-A">
            <div class="card" role="tab" id="heading-A">
                <div class="card-body collapse in">
                                    <div class="table-responsive mt-2">
                                        <table class="table table-striped table-bordered" id="for_all">
                                            <thead>
                                                <tr>
                                                    <th>Date & Time</th>
                                                    <th>Points Earned By</th>
                                                    <th>Points </th>
                                                    <th>Remaining Balance</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                            </tbody>
                                        </table>
                                    </div>
                  </div>

            </div>

          
        </div>
        <!-- End header Data save  -->

<!-- Start Footer Data  -->
        <div id="pane-B" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-B">
            <div class="card" role="tab" id="heading-A">
                    <div class="card-body collapse in">
                        <div class="table-responsive mt-2">
                            <table class="table table-striped table-bordered" id="for_all">
                                <thead>
                                    <tr>
                                        <th>Date & Time</th>
                                        <th>Order / Service ID</th>
                                        <th>Order Value </th>
                                        <th>Points Redeemed</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                  </div>
            </div>
        </div>
        <!-- End Footer Data Save -->

    </div>
                    
                    </div>
                    </div>
                    </section>
      </div>
        
  </div>
  </div><!--end proposal -->
                     
                    </div>
                
                    
                    <!--<div class="row">-->
                    <!--    <div class="col-xs-12">-->
                    <!--        <div class="card-body collapse in">-->
                    <!--            <div class="card-block card-dashboard">-->
                    <!--                <div class="table-responsive">-->
                    <!--                    <ul class="nav nav-tabs" id="myTab" role="tablist">-->
                    <!--                      <li class="nav-item">-->
                    <!--                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editprofile">-->
                    <!--                              Hello-->
                    <!--                            </button>-->
                            
                    <!--                      </li>-->
                    <!--                      <li class="nav-item">-->
                    <!--                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#changepassword">-->
                    <!--                              Change Password-->
                    <!--                            </button>-->
                                           
                    <!--                      </li>-->
                    <!--                      <li class="nav-item">-->
                    <!--                           <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#review">-->
                    <!--                             Reviews & Ratings-->
                    <!--                            </button>-->
                                            
                    <!--                      </li>-->
                    <!--                      <li class="nav-item">-->
                    <!--                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#complaints">-->
                    <!--                            Complaints-->
                    <!--                            </button>-->
                                            
                    <!--                      </li>-->
                    <!--                      <li class="nav-item">-->
                    <!--                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#sendemail">-->
                    <!--                           Send Email-->
                    <!--                            </button>-->
                                            
                    <!--                      </li>-->
                    <!--                    </ul>-->
                                        
                    <!--                </div>-->
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->
                </section>
            </div>
        </div>
    </div>
</div>

<!--  edit profile modal  -->

<div class="modal fade" id="edit_profile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top:-20px">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <div class="modal-body">
           <form method="POST" id="profileform" action="{{route('admin.updatecustomerprofile')}}" enctype="multipart/form-data">
               @csrf
                <div class="row">
                    <div class="col-sm-6 form-group">
                        <label class="label-control label">Name <span class="required">*</span></label>
                        <input type="text" class="form-control" name="name" value="{{$customer->name}}"/>
                        <div class="text-danger" id="name-err"></div>
                        <input type="hidden" name="id" value="{{$customer->id}}" />
                    </div>
                    <div class="col-sm-6 form-group">
                        <label class="label-control label">Email Id<span class="required">*</span></label>
                        <input type="text" class="form-control" name="email" value="{{$customer->email}}" />
                        <div class="text-danger" id="email-err"></div>
                    </div>

                    <div class="col-md-6 form-group">
                        <label class="label-control label">Mobile No. <span class="required">*</span></label>
                        <input type="text" class="form-control" name="mobile_number" value="{{$customer->mobile_number}}"/>
                        <div class="text-danger" id="mobile_number-err"></div>
                    </div>
                     <div class="col-sm-6 form-group">
                        <label class="label-control label">Country<span class="required">*</span></label>
                         <select  id="country-dropdown" class="form-control" name="country">
                            <option value="">-- Select Country --</option>
                            @foreach ($countries as $data)
                            <option @if($customer->country==$data->id) selected @endif value="{{$data->id}}">
                                {{$data->name}}
                            </option>
                            @endforeach
                        </select>
                        <div class="text-danger" id="country-err"></div>
                    </div>
                    <div class="col-sm-6 form-group">
                        <label class="label-control label">State<span class="required">*</span></label>
                        <select id="state-dropdown" class="form-control" name="state">
                            <option value="{{$customer->state}}"> @if(isset($customer->state)) {{$customer->states->name}} @endif </option>
                        </select>
                        <div class="text-danger" id="state-err"></div>
                    </div>
                     <div class="col-sm-6 form-group">
                        <label class="label-control label">City<span class="required">*</span></label>
                        <select id="city-dropdown" class="form-control" name="city">
                            <option value="{{$customer->city}}"> @if(isset($customer->city)) {{$customer->citys->name}} @endif </option>
                        </select>
                        <div class="text-danger" id="city-err"></div>
                    </div>
                    <div class="col-sm-6 form-group">
                        <label class="label-control label">Gender <span class="required">*</span></label>
                        <select class="form-control" name="gender">
                            <option @if($customer->gender=="male") selected @endif  value="male">Male</option>
                            <option @if($customer->gender=="female") selected @endif value="female">Fe-Male</option>
                        </select>
                        <div class="text-danger" id="gender-err"></div>
                    </div>
                    <div class="col-sm-6 form-group">
                        <label class="label-control label">DOB <span class="required">*</span></label>
                        <input type="date" class="form-control" name="dob" value="{{$customer->dob}}"/>
                        <div class="text-danger" id="dob-err"></div>
                    </div>
                    
                    <!--<div class="col-sm-6 form-group">-->
                    <!--    <label class="label-control label">Referred By <span class="required">*</span></label>-->
                    <!--    <input type="text" class="form-control"/>-->
                    <!--</div>-->
                    <div class="col-sm-6 form-group">
                        <label class="label-control label">Registration Date<span class="required">*</span></label>
                        <input type="datetime-local" class="form-control" name="registration_date" value="{{$customer->registration_date}}"/>
                        <div class="text-danger" id="registration_date-err"></div>
                    </div>
                     <img src="{{ URL::asset('storage/' . $customer->image) }}" width="150" alt="Profile Image">
                    <div class="col-sm-12 form-group">
                        <label class="label-control label">Image<span class="required">*</span>
                        <span class="text-danger">(Image Size 500*500)</span></label>
                        <input type="file" class="form-control" name="image"/>
                        <div class="text-danger" id="image-err"></div>
                    </div>
                    </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary add-profile-btn">Update</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
                </form>
      </div>
    </div>
  </div>
</div>

<!-- Billing Address Modal -->
<div class="modal fade" id="billing_address" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Billing Address</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top:-20px">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <div class="modal-body billing">
          <form method="POST" id="billingform" action="{{route('admin.updatecustomerbilling')}}">
               @csrf
                <div class="row">
                     <input type="hidden" name="id" id="id" />
                      <input type="hidden" name="customer_id" value="{{$customer->id}}" />
                    <div class="col-sm-6 form-group">
                        <label class="label-control label">Country <span class="required">*</span></label>
                         <select  id="country-dropdown" class="form-control" name="country">
                            <option value="">-- Select Country --</option>
                            @foreach ($countries as $data)
                            <option @if($customer->country==$data->id) selected @endif value="{{$data->id}}">
                                {{$data->name}}
                            </option>
                            @endforeach
                        </select>
                         <div class="text-danger" id="country-err"></div>
                    </div>
                    
                     <div class="col-sm-6 form-group">
                        <label class="label-control label">State <span class="required">*</span></label>
                        <select id="state-dropdown" class="form-control" name="state">
                        </select>
                        <div class="text-danger" id="state-err"></div>
                    </div>
                    <div class="col-sm-6 form-group">
                        <label class="label-control label">City<span class="required">*</span></label>
                        <select id="city-dropdown" class="form-control" name="city">
                        </select>
                        <div class="text-danger" id="city-err"></div>
                    </div>

                    <div class="col-md-6 form-group">
                        <label class="label-control label">Contact No. <span class="required">*</span></label>
                        <input type="text" class="form-control" name="mobile_number" id="mobile_number"/>
                         <div class="text-danger" id="mobile_number-err"></div>
                    </div>
                    <div class="col-sm-6 form-group">
                        <label class="label-control label">Email Id <span class="required">*</span></label>
                        <input type="text" class="form-control" name="email" id="email"/>
                         <div class="text-danger" id="email-err"></div>
                    </div>
                   
                    <div class="col-sm-6 form-group">
                        <label class="label-control label">Zip Code <span class="required">*</span></label>
                        <input type="text" class="form-control" name="pincode" id="pincode"/>
                         <div class="text-danger" id="pincode-err"></div>
                    </div>
                    </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary update-billing-btn">Update</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
                </form>
      </div>
    </div>
  </div>
</div>


<!-- Shipping Address Modal -->

<div class="modal fade" id="shipping_address" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Shipping Address</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top:-20px">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <div class="modal-body shipping">
            <form method="post" id="shippingform" action="{{route('admin.updatecustomershipping')}}">
               @csrf
                <div class="row">
                    <input type="hidden" name="id" id="id" />
                    <input type="hidden" name="customer_id" value="{{$customer->id}}" />
                    <div class="col-sm-6 form-group">
                        <label class="label-control label">Country <span class="required">*</span></label>
                         <select  id="country-dropdown" class="form-control" name="country">
                            <option value="">-- Select Country --</option>
                            @foreach ($countries as $data)
                            <option @if($customer->country==$data->id) selected @endif value="{{$data->id}}">
                                {{$data->name}}
                            </option>
                            @endforeach
                        </select>
                        <div class="text-danger" id="country-err"></div>
                    </div>
                    <div class="col-sm-6 form-group">
                        <label class="label-control label">State <span class="required">*</span></label>
                        <select id="state-dropdown" class="form-control" name="state">
                        </select>
                        <div class="text-danger" id="state-err"></div>
                    </div>
                    <div class="col-sm-6 form-group">
                        <label class="label-control label">City<span class="required">*</span></label>
                       <select id="city-dropdown" class="form-control" name="city">
                            
                        </select>
                        <div class="text-danger" id="city-err"></div>
                    </div>

                   <div class="col-md-6 form-group">
                        <label class="label-control label">Contact No. <span class="required">*</span></label>
                        <input type="text" class="form-control" name="mobile_number" id="mobile_number"/>
                        <div class="text-danger" id="mobile_number-err"></div>
                    </div>
                    <div class="col-sm-6 form-group">
                        <label class="label-control label">Email Id <span class="required">*</span></label>
                        <input type="text" class="form-control" name="email" id="email"/>
                        <div class="text-danger" id="email-err"></div>
                    </div>
                   
                    <div class="col-sm-6 form-group">
                        <label class="label-control label">Zip Code <span class="required">*</span></label>
                        <input type="text" class="form-control" name="pincode" id="pincode"/>
                        <div class="text-danger" id="pincode-err"></div>
                    </div>
                    </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary update-shipping-btn">Update</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
                </form>
      </div>
    </div>
  </div>
</div>
<!--//editprofile-->
<!--<div class="modal fade" id="editprofile" tabindex="-1" role="dialog" aria-labelledby="editprofile" aria-hidden="true">-->
<!--  <div class="modal-dialog" role="document">-->
<!--    <div class="modal-content">-->
<!--      <div class="modal-header">-->
<!--        <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>-->
<!--        <button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
<!--          <span aria-hidden="true">&times;</span>-->
<!--        </button>-->
<!--      </div>-->
<!--      <div class="modal-body">-->
<!--        ...-->
<!--      </div>-->
<!--      <div class="modal-footer">-->
<!--        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
<!--        <button type="button" class="btn btn-primary">Save changes</button>-->
<!--      </div>-->
<!--    </div>-->
<!--  </div>-->
<!--</div>
//
<!--<div class="modal fade" id="changepassword" tabindex="-1" role="dialog" aria-labelledby="editprofile" aria-hidden="true">-->
<!--  <div class="modal-dialog" role="document">-->
<!--    <div class="modal-content">-->
<!--      <div class="modal-header">-->
<!--        <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>-->
<!--        <button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
<!--          <span aria-hidden="true">&times;</span>-->
<!--        </button>-->
<!--      </div>-->
<!--      <div class="modal-body">-->
<!--        ...-->
<!--      </div>-->
<!--      <div class="modal-footer">-->
<!--        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
<!--        <button type="button" class="btn btn-primary">Save changes</button>-->
<!--      </div>-->
<!--    </div>-->
<!--  </div>-->
<!--</div>-->
<!--<div class="modal fade" id="review" tabindex="-1" role="dialog" aria-labelledby="editprofile" aria-hidden="true">-->
<!--  <div class="modal-dialog" role="document">-->
<!--    <div class="modal-content">-->
<!--      <div class="modal-header">-->
<!--        <h5 class="modal-title" id="exampleModalLabel">Review & Rating</h5>-->
<!--        <button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
<!--          <span aria-hidden="true">&times;</span>-->
<!--        </button>-->
<!--      </div>-->
<!--      <div class="modal-body">-->
<!--        ...-->
<!--      </div>-->
<!--      <div class="modal-footer">-->
<!--        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
<!--        <button type="button" class="btn btn-primary">Save changes</button>-->
<!--      </div>-->
<!--    </div>-->
<!--  </div>-->
<!--</div>-->
<!--<div class="modal fade" id="complaints" tabindex="-1" role="dialog" aria-labelledby="editprofile" aria-hidden="true">-->
<!--  <div class="modal-dialog" role="document">-->
<!--    <div class="modal-content">-->
<!--      <div class="modal-header">-->
<!--        <h5 class="modal-title" id="exampleModalLabel">Complaints</h5>-->
<!--        <button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
<!--          <span aria-hidden="true">&times;</span>-->
<!--        </button>-->
<!--      </div>-->
<!--      <div class="modal-body">-->
<!--        ...-->
<!--      </div>-->
<!--      <div class="modal-footer">-->
<!--        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
<!--        <button type="button" class="btn btn-primary">Save changes</button>-->
<!--      </div>-->
<!--    </div>-->
<!--  </div>-->
<!--</div>-->
<!--<div class="modal fade" id="sendemail" tabindex="-1" role="dialog" aria-labelledby="editprofile" aria-hidden="true">-->
<!--  <div class="modal-dialog" role="document">-->
<!--    <div class="modal-content">-->
<!--      <div class="modal-header">-->
<!--        <h5 class="modal-title" id="exampleModalLabel">SendEmail</h5>-->
<!--        <button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
<!--          <span aria-hidden="true">&times;</span>-->
<!--        </button>-->
<!--      </div>-->
<!--      <div class="modal-body">-->
<!--        ...-->
<!--      </div>-->
<!--      <div class="modal-footer">-->
<!--        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
<!--        <button type="button" class="btn btn-primary">Save changes</button>-->
<!--      </div>-->
<!--    </div>-->
<!--  </div>-->
<!--</div>-->
<!--<div id="brand-modal" class="modal fade" role="dialog">-->
<!--</div>-->
@include('admin.footer')
<script>
$(document).on("click", ".add-profile-btn", function(event) {
    event.preventDefault();
    $('#profileform #name-err').html('');
     $('#profileform #image-err').html('');
     $('#profileform #email-err').html('');
     $('#profileform #country-err').html('');
     $('#profileform #mobile_number-err').html('');
     $('#profileform #state-err').html('');
     $('#profileform #gender-err').html('');
     $('#profileform #dob-err').html('');
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
            //  $(this).attr('disabled', true);
              var frm = $('#profileform');
             var formData = new FormData(frm[0]);
            $.ajax({
                url: $('#profileform').attr('action'),
                 type: 'POST',
                 processData: false,
                contentType: false,
                dataType: 'json',
                data: formData,
                context: this,
                success: function(result) {
                    if (result.success) {
                        // sessionStorage.setItem('social',true);
                        location.reload();
                    } else {
                        $(this).attr('disabled', false);
                        if (result.code == 422) {
                            for (const key in result.errors) {
                                $(`#profileform #${key}-err`).html(result.errors[key][0]);
                            }
                        } else {
                            console.log(result);
                        }
                    }
                }
            });
        });
        
$(document).on("click", ".update-billing-btn", function(event) {
    event.preventDefault();
    $('#billingform #mobile_number-err').html('');
     $('#billingform #pincode-err').html('');
     $('#billingform #country-err').html('');
     $('#billingform #state-err').html('');
     $('#billingform #email-err').html('');
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
            //  $(this).attr('disabled', true);
              var frm = $('#billingform');
             var formData = new FormData(frm[0]);
            $.ajax({
                url: $('#billingform').attr('action'),
                 type: 'POST',
                 processData: false,
                contentType: false,
                dataType: 'json',
                data: formData,
                context: this,
                success: function(result) {
                    if (result.success) {
                        // sessionStorage.setItem('social',true);
                        location.reload();
                    } else {
                        $(this).attr('disabled', false);
                        if (result.code == 422) {
                            for (const key in result.errors) {
                                $(`#billingform #${key}-err`).html(result.errors[key][0]);
                            }
                        } else {
                            console.log(result);
                        }
                    }
                }
            });
        });

$(document).on("click", ".update-shipping-btn", function(event) {
    event.preventDefault();
   $('#shippingform #mobile_number-err').html('');
     $('#shippingform #pincode-err').html('');
     $('#shippingform #country-err').html('');
     $('#shippingform #state-err').html('');
     $('#shippingform #email-err').html('');
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
            //  $(this).attr('disabled', true);
              var frm = $('#shippingform');
             var formData = new FormData(frm[0]);
            $.ajax({
                url: $('#shippingform').attr('action'),
                 type: 'POST',
                 processData: false,
                contentType: false,
                dataType: 'json',
                data: formData,
                context: this,
                success: function(result) {
                    if (result.success) {
                        // sessionStorage.setItem('social',true);
                        location.reload();
                    } else {
                        $(this).attr('disabled', false);
                        if (result.code == 422) {
                            for (const key in result.errors) {
                                $(`#shippingform #${key}-err`).html(result.errors[key][0]);
                            }
                        } else {
                            console.log(result);
                        }
                    }
                }
            });
        });
$(document).on("submit", "#submitpassword", function(event) {
    event.preventDefault();
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
            //  $(this).attr('disabled', true);
              var frm = $('#submitpassword');
             var formData = new FormData(frm[0]);
            $.ajax({
                url: $('#submitpassword').attr('action'),
                 type: 'POST',
                 processData: false,
                contentType: false,
                dataType: 'json',
                data: formData,
                context: this,
                success: function(result) {
                    if (result.success) {
                        Swal.fire('Password Update Successfully!')

                         
                        location.reload();
                    } else {
                        // $(this).attr('disabled', false);
                        if (result.code == 422) {
                            for (const key in result.errors) {
                                console.log(result.errors[key][0])
                                $(`.passwordchange #${key}-err`).html(result.errors[key][0]);
                            }
                        } else {
                            console.log(result);
                        }
                    }
                }
            });
        });
 $('body').on('click', '.billingmodal', function () {
    var id = $(this).data('id');
    $.ajax({
        url:`{{url('admin/edit-customer-billing/${id}')}}`,
        type:"GET",
        success: function (result) {
        $('.billing #id').val(result.id);
        $('.billing #country-dropdown').val(result.country);
        $('.billing #state-dropdown').html('<option value="' + result.states.id + '">' + result.states.name + '</option>');
        $('.billing #city-dropdown').html('<option value="' + result.citys.id + '">' + result.citys.name + '</option>');
         $('.billing #email').val(result.email);
         $('.billing #mobile_number').val(result.mobile_number);
         $('.billing #pincode').val(result.pincode);
        }
    })
    // var email = $(this).data('email');
    // var email = $(this).data('email');
    
    // alert(data);
})
$('body').on('click', '.shippingmodal', function () {
    var id = $(this).data('id');
    $.ajax({
        url:`{{url('admin/edit-customer-shipping/${id}')}}`,
        type:"GET",
        success: function (result) {
            console.log
            $('.shipping #id').val(result.id);
            $('.shipping #country-dropdown').val(result.country);
            $('.shipping #state-dropdown').html('<option value="' + result.states.id + '">' + result.states.name + '</option>');
            $('.shipping #city-dropdown').html('<option value="' + result.citys.id + '">' + result.citys.name + '</option>');
         $('.shipping #email').val(result.email);
         $('.shipping #mobile_number').val(result.mobile_number);
         $('.shipping #pincode').val(result.pincode);
        }
    })
    // var email = $(this).data('email');
    // var email = $(this).data('email');
    // $('.billing #id').val(id);
    // $('.billing #email').val(email);
    // alert(data);
})

$(document).ready(function () {
            $('#country-dropdown').on('change', function () {
                var idCountry = this.value;
                $("#state-dropdown").html('');
                $.ajax({
                    url: "{{url('admin/fetch-states')}}",
                    type: "POST",
                    data: {
                        country_id: idCountry,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#state-dropdown').html('<option value="">-- Select State --</option>');
                        $.each(result.states, function (key, value) {
                            $("#state-dropdown").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                        $('#city-dropdown').html('<option value="">-- Select City --</option>');
                    }
                });
            });
            $('#state-dropdown').on('change', function () {
                var idState = this.value;
                $("#city-dropdown").html('');
                $.ajax({
                    url: "{{url('admin/fetch-cities')}}",
                    type: "POST",
                    data: {
                        state_id: idState,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (res) {
                        if(res.cities.length>0){
                        // $('#city-dropdown').html('<option value="">-- Select City --</option>');
                        
                        $.each(res.cities, function (key, value) {
                            $("#city-dropdown").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                        }else{
                            $("#city-dropdown").html('<option value="">City Not Found</option>');
                        }
                    }
                });
            });
            $('.billing #country-dropdown').on('change', function () {
                var idCountry = this.value;
                $(".billing #state-dropdown").html('');
                $.ajax({
                    url: "{{url('admin/fetch-states')}}",
                    type: "POST",
                    data: {
                        country_id: idCountry,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('.billing #state-dropdown').html('<option value="">-- Select State --</option>');
                        $.each(result.states, function (key, value) {
                            $(".billing #state-dropdown").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                        $('.billing #city-dropdown').html('<option value="">-- Select City --</option>');
                    }
                });
            });
            $('.billing #state-dropdown').on('change', function () {
                var idState = this.value;
                $(".billing #city-dropdown").html('');
                $.ajax({
                    url: "{{url('admin/fetch-cities')}}",
                    type: "POST",
                    data: {
                        state_id: idState,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (res) {
                       if(res.cities.length>0){
                             $.each(res.cities, function (key, value) {
                            $(".billing #city-dropdown").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                        }else{
                            $(".billing #city-dropdown").html('<option value="">City Not Found</option>');
                        }
                    }
                });
            });
            
            $('.shipping #country-dropdown').on('change', function () {
                var idCountry = this.value;
                $(".shipping #state-dropdown").html('');
                $.ajax({
                    url: "{{url('admin/fetch-states')}}",
                    type: "POST",
                    data: {
                        country_id: idCountry,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('.shipping #state-dropdown').html('<option value="">-- Select State --</option>');
                        $.each(result.states, function (key, value) {
                            $(".shipping #state-dropdown").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                        $('.shipping #city-dropdown').html('<option value="">-- Select City --</option>');
                    }
                });
            });
            $('.shipping #state-dropdown').on('change', function () {
                var idState = this.value;
                $(".shipping #city-dropdown").html('');
                $.ajax({
                    url: "{{url('admin/fetch-cities')}}",
                    type: "POST",
                    data: {
                        state_id: idState,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (res) {
                        if(res.cities.length>0){
                        $('.shipping #city-dropdown').html('<option value="">-- Select City --</option>');
                        $.each(res.cities, function (key, value) {
                            $(".shipping #city-dropdown").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                        }else{
                            $(".shipping #city-dropdown").html('<option value="">City Not Found</option>');
                        }
                    }
                });
            });
  
        });
        
        
    // function deleteConfirmation(id) {
    //     Swal.fire({
    //         title: 'Are you sure?',
    //         text: "You won't be able to revert this!",
    //         icon: 'warning',
    //         showCancelButton: true,
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         confirmButtonText: 'Yes, delete it!'
    //     }).then((result) => {
    //         if (result.isConfirmed) {
    //             $.ajax({
    //                 url: `{{ URL::to('admin/manage-brand/${id}') }}`,
    //                 type: "DELETE",
    //                 dataType: "json",
    //                 success: function(result) {
    //                     if (result.success) {
    //                         Swal.fire(
    //                             'Deleted!',
    //                             'success'
    //                         );
    //                         setTimeout(function() {
    //                             location.reload();
    //                         }, 400);
    //                     } else {
    //                         Swal.fire(result.msgText);
    //                     }
    //                 }
    //             });

    //         }
    //     })
    // };
    $(document).ready(function(event) {
        // $(document).on("click", ".add-brand", function(event) {
        //     $.ajax({
        //         url: "{{ URL::to('admin/manage-customer/create') }}",
        //         type: "GET",
        //         dataType: "json",
        //         success: function(result) {
        //             if (result.success) {
        //                 $("#brand-modal").html(result.html);
        //                 $("#brand-modal").modal('show');
        //             } else {

        //             }
        //         }
        //     });
        // });

        $(document).on('keyup', "#name", function(event) {
            let name = $(this).val();
            let url = name.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
            $("#url").val(url);
        })

        $(document).on("keyup", "#meta_title", function(event) {
            let title = $(this).val();
            $('#meta_title-limit').html(`We recommend title between 50–60 characters.(${title.length} character)`);
        });

        $(document).on("keyup", "#meta_description", function(event) {
            let title = $(this).val();
            $('#meta_description-limit').html(`We recommend descriptions between 50–160 characters.(${title.length} character)`);
        });

        // $(document).on("click", ".add-brand-btn", function(event) {
        //     $(this).attr('disabled', true);
        //     $('#name-err').html('');
        //     $('#url-err').html('');
        //     $('#image-err').html('');
        //     $('#meta_title-err').html('');
        //     $('#meta_keyword-err').html('');
        //     $('#meta_description-err').html('');
        //     $('#status-err').html('');
        //     let formData = new FormData();
        //     formData.append('name', $('#name').val());
        //     formData.append('url', $('#url').val());
        //     formData.append('meta_title', $('#meta_title').val());
        //     formData.append('meta_keyword', $('#meta_keyword').val());
        //     formData.append('meta_description', $('#meta_description').val());
        //     formData.append('status', $('#status').val());
        //     formData.append('image', (typeof $('#image')[0].files[0] == 'undefined') ? '' : $('#image')[0].files[0]);
        //     $.ajax({
        //         url: "{{ URL::to('admin/manage-brand') }}",
        //         type: 'POST',
        //         processData: false,
        //         contentType: false,
        //         dataType: 'json',
        //         data: formData,
        //         context: this,
        //         success: function(result) {
        //             if (result.success) {
        //                 location.reload();
        //             } else {
        //                 $(this).attr('disabled', false);
        //                 if (result.code == 422) {
        //                     for (const key in result.errors) {
        //                         $(`#${key}-err`).html(result.errors[key][0]);
        //                     }
        //                 } else {
        //                     console.log(result);
        //                 }
        //             }
        //         }
        //     });
        // });

        $(document).on("click", ".edit-brand", function(event) {
            let id = $(this).attr('brand_id');
            $.ajax({
                url: `{{ URL::to('admin/manage-customer/${id}') }}`,
                type: "get",
                dataType: "json",
                success: function(result) {
                    if (result.success) {
                        $("#brand-modal").html(result.html);
                        $("#brand-modal").modal('show');
                    } else {
                        toastr.error('error encountered ' + result.msgText);
                    }
                },
                error: function(error) {
                    toastr.error('error encountered ' + error.statusText);
                }
            });
        });
        
        $(document).on("click", "#update-brand-btn", function(event) {
            $(this).attr('disabled', true);
            var _token = '{{ csrf_token() }}';
            
            let formData = new FormData();
            // formData.append('_method', 'PUT');
            formData.append('_token', _token);
            formData.append('name', $('#name').val());
            formData.append('email', $('#email').val());
            formData.append('mobile', $('#mobile').val());
            formData.append('status', $('#status').val());
            formData.append('password', $('#password').val());
            // formData.append('image', (typeof $('#image')[0].files[0] == 'undefined') ? '' : $('#image')[0].files[0]);
            
            let brand_id = $(this).attr('brand_id');
            // console.log(form_data);return false;
            $.ajax({
                url: `{{ URL::to('admin/update-customer/${brand_id}') }}`,
                type: 'POST',
                processData: false,
                contentType: false,
                dataType: 'json',
                data: formData,
                context: this,
                success: function(result) {
                    // console.log(result);return false;
                    if (result.success) {
                        Swal.fire(
                            'Updated!',
                            'success'
                        );
                        setTimeout(function() {
                            location.reload();
                        }, 400);
                    } else {
                        $(this).attr('disabled', false);
                        if (result.code == 422) {
                            for (const key in result.errors) {
                                $(`#${key}-err`).html(result.errors[key][0]);
                            }
                        } else {
                            console.log(error);
                        }
                    }
                }
            });
        });
    });
</script>
<script>
    $(function() {
    $( "#tabs" ).tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );
    $( "#tabs li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );
  });
</script>

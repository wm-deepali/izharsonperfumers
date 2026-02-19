@include('admin.header')
<style>
    .example-box{
        float:left;
        width: 500px;
        margin: 25px auto;
        padding:15px;
    }
    .custom-radio{
        float: left;
        width: auto;
        display: inline-block;
        margin-right: 20px;
    }
    .custom-control-input {
     position: static; 
    opacity: 1;
}
.bg-success
{
    background:#13ad9e;
    color:#fff;
}
.d-flex
{
   display:flex; 
}
.justify-content-between
{
    justify-content:space-between;
}

</style>
<div class="app-content content container-fluid">

    <div class="content-wrapper">

        <div class="content-header row">

            <div class="content-header-left col-md-6 col-xs-12 mb-2">

                <h3 class="content-header-title mb-0">Account</h3>

                <div class="row breadcrumbs-top">

                    <div class="breadcrumb-wrapper col-xs-12">

                        <ol class="breadcrumb">

                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>

                            <li class="breadcrumb-item">Account Setting</li>

                            <li class="breadcrumb-item active">Account Setting

                            </li>

                        </ol>

                    </div>

                </div>

            </div>

        </div>

       <div class="account-setting-section">
       <ul id="accounttab" class="nav nav-tabs" role="tablist">
        
        <li class="nav-item">
            <a id="tab-profile" href="#pane-profile" class="nav-link active" data-toggle="tab" role="tab">Admin Profile</a>
        </li>
        <li class="nav-item">
            <a id="tab-branch" href="#pane-branch" class="nav-link" data-toggle="tab" role="tab" >Our Branch</a>
        </li>
        <li class="nav-item">
            <a id="tab-gst" href="#pane-gst" class="nav-link" data-toggle="tab" role="tab">GST & Invoice Setting</a>
        </li>
        <li class="nav-item">
            <a id="tab-payment" href="#pane-payment" class="nav-link" data-toggle="tab" role="tab">Payment Gateway</a>
        </li>

        <li class="nav-item">
            <a id="tab-email" href="#pane-email" class="nav-link" data-toggle="tab" role="tab">Email API</a>
        </li>

        <li class="nav-item">
            <a id="tab-sms" href="#pane-sms" class="nav-link" data-toggle="tab" role="tab">SMS API</a>
        </li>
         <li class="nav-item">
            <a id="tab-password" href="#pane-password" class="nav-link" data-toggle="tab" role="tab">Password Setting</a>
        </li>
        
    </ul>


    <div id="accountcontent" class="tab-content" role="tablist">
        <div id="pane-profile" class="card tab-pane fade show active in" role="tabpanel" aria-labelledby="tab-profile">
             <div class="card-body">
                   <form method="POST" id="profileform" action="{{route('admin.updateadminprofile')}}" enctype="multipart/form-data">
                       @csrf
                    <div class="row form-group">
                       <div class="col-xl-4 col-lg- col-md-6 col-12">
                               <label>Profile Photo<span class="text-danger">(Image Size 300*300)</span></label>
                               <input type="file" class="form-control" placeholder="" name="image">
                               <div class="text-danger" id="image-err"></div>
                               <img src="{{ URL::asset('storage/' . auth()->user()->image) }}" style="width:60px" />
                           </div>

                        <div class="col-xl-4 col-lg-6 col-md-6 col-12">
                           <div class="wdinput form-group">
                               <label>Admin Logo (Login Page)<span class="text-danger">(Image Size 500*500)</span></label>
                               <input type="file" class="form-control" placeholder="" name="image_login_page">
                               <div class="text-danger" id="image_login_page-err"></div>
                               <img src="{{ URL::asset('storage/' . auth()->user()->image_login_page) }}" style="width:60px" />
                           </div>
                       </div>
                       
                       
                       <div class="col-xl-4 col-lg-6 col-md-6 col-12">
                           <div class="wdinput form-group">
                               <label>Admin Logo (Admin Header)<span class="text-danger">(Image Size 500*500)</span></label>
                               <input type="file" class="form-control" placeholder="" name="image_header">
                               <div class="text-danger" id="image_header-err"></div>
                               <img src="{{ URL::asset('storage/' . auth()->user()->image_header) }}" style="width:60px" />
                           </div>
                       </div>
                        </div>
                         <div class="row form-group">
                       <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                           <div class="wdinput form-group">
                               <label>Admin Name</label>
                               <input type="text" class="form-control" placeholder="" name="name" value="{{auth()->user()->name}}">
                               <div class="text-danger" id="name-err"></div>
                           </div>
                       </div>
                       
                       <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                           <div class="wdinput form-group">
                               <label>Login Email Id</label>
                               <input type="text" class="form-control" placeholder="" name="email" value="{{auth()->user()->email}}" >
                               <div class="text-danger" id="email-err"></div>
                           </div>
                       </div>
                       <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                           <div class="wdinput form-group">
                               <label>Registered Mobile No.</label>
                               <input type="text" class="form-control" placeholder="" name="phone_number" value="{{auth()->user()->phone_number}}">
                               <div class="text-danger" id="phone_number-err"></div>
                           </div>
                       </div>
                       
                       <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                           <div class="wdinput form-group">
                               <label>Alert Email Id</label>
                               <input type="email" class="form-control" placeholder="" name="alert_email" value="{{auth()->user()->alert_email}}">
                               <div class="text-danger" id="alert_email-err"></div>
                           </div>
                       </div>
                       </div>
                       <div class="row">
                           <div class="col-lg-4">
                               <button class="btn adminbtn-blue btn-lg update-profile-btn"> Update</button>
                           </div>
                       </div>
                   </form>
                </div>
        </div>

        <div id="pane-branch" class="tab-pane" role="tabpanel">
             <div class="card-body">
                     <div class="card-block card-orders-detail p-0">
                         <div class="card">
                            <div class="d-flex justify-content-between">
                                <h3>Branches</h3>
                                <!--<a href="" data-toggle="modal" data-target="#edit_address"><i class="fa fa-pencil-square-o"></i></a>-->
                                <a href="javascript:void(0)" class="btn btn-md btn-primary" id="add_address"><i class="fa fa-plus"></i> Add New Branch</a>
                            </div>
                            <hr/>
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
                                                    <th>Branch Name </th>
                                                    <th>Full Address </th>
                                                    <th>Contact Number </th>
                                                    <th>Email ID</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (isset($datas) && count($datas) > 0)
                                                    @foreach ($datas as $data)
                                                        <tr>
                                                            <td>{{ $data->created_at }}</td>
                                                            <td>{{ $data->name }}</td>
                                                            <td>{{ $data->address }}</td>
                                                            <td>{{ $data->contact_number }}</td>
                                                            <td>{{ $data->email }}</td>
                                                           
                                                            <td>{{ $data->status=="active" ? "Active" : "De-Active" }}</td>
                                                            <td class="text-truncate">
                                                                <ul class="actions">
                                                                    <li><a href="javascript:void(0)" class="show-address" address_id="{{ $data->id }}" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                                                    <li><a href="javascript:void(0)" class="edit-address" address_id="{{ $data->id }}" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                                    <li><a href="javascript:void(0)" onclick="deleteConfirmation({{ $data->id }})" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                                    <li><a href="javascript:void(0)" onclick="updateStatus({{ $data->id }})" title="Status">@if($data->status =="active")<i style="color:green" class="fa fa-check" aria-hidden="true"></i>@else <i style="color:red" class="fa fa-times" aria-hidden="true"></i> @endif</a></li>
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
                    </div>
                </section>
                            
                              
                         </div>
                     </div>
                </div>
        </div>

        <div id="pane-gst" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-gst">
           <div class="card-body">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                        <h3>GST</h3>
                        <form method="POST" id="gstform" action="{{route('admin.saveGSTDetails')}}">
                            @csrf
                             <div class="row">
                       <div class="col-md-12">
                           <div class="wdinput form-group">
                               <label>Company Name</label>
                               <input type="text" class="form-control" placeholder="Company Name" name="company_name" value="{{$settinggst->company_name}}">
                               <div class="text-danger" id="company_name-err"></div>
                           </div>
                       </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                           <div class="wdinput form-group">
                               <label>Country</label>
                               <select class="form-control" name="country" id="country">
                                   <option value="">-- Select Country --</option>
                                   @foreach($countrys as $country)
                                   <option @if($settinggst->country_id==$country->id) selected @endif value="{{$country->id}}">{{$country->name}}</option>
                                   @endforeach
                               </select>
                               <div class="text-danger" id="country-err"></div>
                           </div>
                       </div>
                       <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                           <div class="wdinput form-group">
                               <label>State</label>
                               <select class="form-control" name="state" id="state">
                                   <option value="">-- Select State --</option>
                                   @foreach($states as $state)
                                   <option @if($settinggst->state_id==$state->id) selected @endif value="{{$state->id}}">{{$state->name}}</option>
                                   @endforeach
                               </select>
                               <div class="text-danger" id="state-err"></div>
                           </div>
                       </div>

                       <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                           <div class="wdinput form-group">
                               <label>City</label>
                                <select class="form-control" name="city" id="city-dropdown">
                                    <option value="">-- Select City --</option>
                                     @foreach($cities as $city)
                                   <option @if($settinggst->city_id==$city->id) selected @endif value="{{$city->id}}">{{$city->name}}</option>
                                   @endforeach
                                    
                                </select>
                                <div class="text-danger" id="city-err"></div>
                           </div>
                           </div>

                       <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                           <div class="wdinput form-group">
                               <label>Pincode</label>
                                <input type="text" class="form-control" placeholder="Pincode" name="pin_code" value="{{$settinggst->pin_code}}">
                                <div class="text-danger" id="pin_code-err"></div>
                           </div>
                       </div>

                       <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                           <div class="wdinput form-group">
                               <label>GST Number</label>
                                <input type="text" class="form-control" placeholder="GST Number" name="gst_number" value="{{$settinggst->gst_number}}">
                                <div class="text-danger" id="gst_number-err"></div>
                           </div>
                       </div>

                       <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                           <div class="wdinput form-group">
                               <label>PAN Card Number</label>
                                <input type="text" class="form-control" placeholder="PAN Card Number" name="pan_number" value="{{$settinggst->pan_number}}">
                                <div class="text-danger" id="pan_number-err"></div>
                           </div>
                       </div>
                       
                        <div class="col-md-12">
                           <div class="wdinput form-group">
                               <label>Full Address</label>
                               <textarea class="form-control" rows="3" placeholder="Full Address" name="invoice_address">{{$settinggst->invoice_address}}</textarea>
                               <div class="text-danger" id="invoice_address-err"></div>
                           </div>
                       </div>
                        <div class="col-xl-12 col-lg-12 col-md-6 col-12">
                           <div class="wdinput form-group">
                               <button type="submit" class="btn adminbtn-blue btn-lg">Update</button>
                           </div>
                       </div>
                     
                       <div class="col-md-12">
                        <h3>Invoice Setting</h3>
                        </div>
                       
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                           <div class="wdinput form-group">
                               <label>Enter Prefix</label>
                                <input type="text" class="form-control" placeholder="Enter Prefix" name="invoice_prefix" value="{{$settinggst->invoice_prefix}}">
                                <div class="text-danger" id="invoice_prefix-err"></div>
                           </div>
                       </div>

                       <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                           <div class="wdinput form-group">
                               <label>Enter Serial Number</label>
                                <input type="text" class="form-control" placeholder="Enter Serial Number" name="invoice_number" value="{{$settinggst->invoice_number}}">
                                <div class="text-danger" id="invoice_number-err"></div>
                           </div>
                       </div>
                       <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                           <div class="wdinput form-group">
                               <button type="submit" class="btn adminbtn-blue btn-lg">Update</button>
                           </div>
                       </div>
                      
                   </div>
                        
                        
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                        
                            <div class="row">
                                <div class='col-sm-12'>
                                    <!-- Default checked -->
                                <!--    <label class="custom-control-label" for="enabledChecked">GST</label>-->
                                <!--    <label class="switch">-->
                                <!--  <input type="checkbox" name="status" id="enabledChecked" value="enabled" @if($settinggst->gst_status=="yes") checked  @endif>-->
                                <!--  <span class="slider round"></span>-->
                                <!--</label>-->
                                
                                <!--<label class="custom-control-label" for="disabledChecked">VAT</label>-->
                                <!-- <label class="switch">-->
                                <!--  <input type="checkbox" name="status" id="disabledChecked" value="other" @if($settinggst->vat_status=="yes") checked  @endif>-->
                                <!--  <span class="slider round"></span>-->
                                <!--</label>-->
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" id="enabledChecked" name="status" value="enabled" @if($settinggst->gst_status=="yes") checked  @endif >
                                        <label class="custom-control-label" for="enabledChecked">GST</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" value="other" class="custom-control-input" id="disabledChecked" name="status" @if($settinggst->vat_status=="yes") checked  @endif >
                                        <label class="custom-control-label" for="disabledChecked">VAT</label>
                                    </div>
                                </div>
                                </div>
                                 
                                <div class="gst_show mt-2" @if($settinggst->gst_status=="no") hidden @endif >
                                  <!--<form method="POST" action="{{route('admin.saveGSTDetails')}}">-->
                                  <!--    @csrf-->
                                <div class="row">
                                <div class="col-md-12">
                                    <h3>Sales</h3>
                                </div>
                                <div class="col-lg-4">
                                    <div class="wdinput form-group">
                                     <label>IGST</label>
                                <input type="text" class="form-control" name="igst_percent" value="{{$settinggst->igst_percent}}">
                                <div class="text-danger" id="igst_percent-err"></div>
                                </div>
                                </div>
                                 <div class="col-lg-4">
                                     <div class="wdinput form-group">
                                      <label>SGST</label>
                                <input type="text" class="form-control" name="sgst_percent" value="{{$settinggst->sgst_percent}}" >
                                <div class="text-danger" id="sgst_percent-err"></div>
                                </div>
                                 </div>
                                  <div class="col-lg-4">
                                      <div class="wdinput form-group">
                                       <label>CGST</label>
                                <input type="text" class="form-control" name="cgst_percent" value="{{$settinggst->cgst_percent}}" >
                                <div class="text-danger" id="cgst_percent-err"></div>
                                </div>
                                  </div>
                                  </div>
                             
                                <div class="col-xl-4 col-lg-6 col-md-6 col-12">
                           <div class="wdinput form-group">
                               <button type="submit" class="btn adminbtn-blue btn-lg">Update</button>
                           </div>
                       </div>  
                            </div>
                            <div class="vat mt-2"  id="otherAnswer" @if($settinggst->vat_status=="no") hidden @endif  >
                            <div class="row">
                              <div class="col-md-12">
                                    <h3>VAT</h3>
                                </div>
                                
                                </div>
                               
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="wdinput form-group">
                                         <label>Sales</label>
                                           <input type="text" class="form-control" name="vat" value="{{$settinggst->vat}}">
                                           <div class="text-danger" id="vat-err"></div>
                                           </div>
                                    </div>
                                     <div class="col-xl-4 col-lg-6 col-md-6 col-12">
                                   <div class="wdinput form-group">
                                       <button type="submit" class="btn adminbtn-blue btn-lg">Update</button>
                                   </div>
                               </div>
                            </div>
                        </form>
                    </div>
                    
                </div>
              </div>
          </div>
        </div>

      

        <div id="pane-payment" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-payment">
            <div class="card-body">
                    <form id="razorpayform" method="POST" action="{{route('admin.saverazorpay')}}">
                        @csrf
                       <div class="payment-gateway-box">
                        <div class="row">
                        <div class="col-xl-3 col-lg-3 col-md-3 col-12">
                           <div class="wdinput form-group">
                               
                               <img src="https://razorpay.com/build/browser/static/razorpay-logo.5cdb58df.svg">
                           </div>
                       </div>

                       <div class="col-xl-3 col-lg-3 col-md-3 col-12">
                           <div class="wdinput form-group">
                               <label>Key Id</label>
                                <input type="text" class="form-control" placeholder="Enter Key Id" value="{{$payment->key}}" name="key">
                                <div class="text-danger" id="key-err"></div>
                           </div>
                       </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-12">
                           <div class="wdinput form-group">
                               <label>Secret </label>
                                <input type="text" class="form-control" placeholder="Enter Secret" value="{{$payment->secret}}" name="secret">
                                <div class="text-danger" id="secret-err"></div>
                           </div>
                       </div>
                   </div>
                    </div>
                   <div class="row">
                       <div class="col-md-12">
                           <div class="wdinput form-group">
                               <button class="btn adminbtn-blue btn-lg razorpaybtn">Update</button>
                           </div>
                       </div>

                   </div>
                        </form>
                </div>
                 <div class="card-body">
                    <form id="bankform" method="POST" action="{{route('admin.updatebank')}}">
                        @csrf
                       <div class="payment-gateway-box">
                        <div class="row">
                        <div class="col-xl-3 col-lg-3 col-md-3 col-12">
                           <div class="wdinput form-group">
                               
                               <h2>Bank Account Detail</h2>
                           </div>
                       </div>
</div>
                        <div class="row">
                       <div class="col-xl-3 col-lg-3 col-md-3 col-12">
                           <div class="wdinput form-group">
                               <label>Account Name</label>
                                <input type="text" class="form-control" placeholder="Enter Account Name" value="{{$bank->ac_name}}" name="ac_name">
                                <div class="text-danger" id="ac_name-err"></div>
                           </div>
                       </div>
                        <div class="col-xl-3 col-lg-3 col-md-3 col-12">
                           <div class="wdinput form-group">
                               <label>Account Number </label>
                                <input type="text" class="form-control" placeholder="Enter Account Number" value="{{$bank->ac_number}}" name="ac_number">
                                <div class="text-danger" id="ac_number-err"></div>
                           </div>
                       </div>
                       <div class="col-xl-3 col-lg-3 col-md-3 col-12">
                           <div class="wdinput form-group">
                               <label>Bank Name</label>
                                <input type="text" class="form-control" placeholder="Enter Bank Name" value="{{$bank->bank_name}}" name="bank_name">
                                <div class="text-danger" id="bank_name-err"></div>
                           </div>
                       </div>
                       <div class="col-xl-3 col-lg-3 col-md-3 col-12">
                           <div class="wdinput form-group">
                               <label>IFSC Code </label>
                                <input type="text" class="form-control" placeholder="Enter IFSC Code" value="{{$bank->ifsc_code}}" name="ifsc_code">
                                <div class="text-danger" id="ifsc_code-err"></div>
                           </div>
                       </div>
                       <div class="col-xl-3 col-lg-3 col-md-3 col-12">
                           <div class="wdinput form-group">
                               <label>Bank Branch </label>
                                <input type="text" class="form-control" placeholder="Enter Bank Branch" value="{{$bank->bank_branch}}" name="bank_branch">
                                <div class="text-danger" id="bank_branch-err"></div>
                           </div>
                       </div>
                       <div class="col-xl-3 col-lg-3 col-md-3 col-12">
                           <div class="wdinput form-group">
                               <label>Payment Image</label>
                                <input type="file" class="form-control" value="{{$bank->payment_image}}" id="payment_image" name="payment_image">
                                <div class="text-danger" id="payment_image-err"></div>
                           </div>
                       </div>
                       <div class="col-xl-3 col-lg-6 col-md-3 col-12">
                           <div class="wdinput form-group">
                               <img id="paymentimgpre" height="300px" src="{{url('storage').'/'.$bank->payment_image}}" />
                           </div>
                       </div>
                   </div>
                    </div>
                   <div class="row">
                       <div class="col-md-12">
                           <div class="wdinput form-group">
                               <button class="btn adminbtn-blue btn-lg bankbtn">Update</button>
                           </div>
                       </div>

                   </div>
                        </form>
                </div>
            
        </div>


          <div id="pane-email" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-email">
             <div class="card-body">
                    <form method="POST" id="emailform" action="{{route('admin.updateemailsetting')}}">
                        @csrf
                     <div class="email-api-box">
                        <div class="row">
                        <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                           <div class="wdinput form-group">
                               
                               <img src="https://sendgrid.com/brand/sg-twilio/SG_Twilio_Lockup_RGBx1.png">
                           </div>
                       </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                           <div class="wdinput form-group">
                               <label>MAIL MAILER</label>
                                <input type="text" class="form-control" placeholder="Enter MAIL MAILER" name="mailer" value="{{$mail->mailer}}">
                                <div class="text-danger" id="mailer-err"></div>
                           </div>
                       </div>
                       <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                           <div class="wdinput form-group">
                               <label>MAIL HOST</label>
                                <input type="text" class="form-control" placeholder="Enter MAIL HOST" name="host" value="{{$mail->host}}">
                                <div class="text-danger" id="host-err"></div>
                           </div>
                       </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                           <div class="wdinput form-group">
                               <label>MAIL PORT</label>
                                <input type="text" class="form-control" placeholder="Enter MAIL PORT" name="port" value="{{$mail->port}}">
                                <div class="text-danger" id="port-err"></div>
                           </div>
                       </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                           <div class="wdinput form-group">
                               <label>MAIL USERNAME</label>
                                <input type="text" class="form-control" placeholder="Enter MAIL USERNAME" name="username" value="{{$mail->username}}">
                                <div class="text-danger" id="username-err"></div>
                           </div>
                       </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                           <div class="wdinput form-group">
                               <label>MAIL PASSWORD</label>
                                <input type="text" class="form-control" placeholder="Enter MAIL PASSWORD" name="password" value="{{$mail->password}}">
                                <div class="text-danger" id="password-err"></div>
                           </div>
                       </div>
                       <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                           <div class="wdinput form-group">
                               <label>MAIL FROM</label>
                                <input type="text" class="form-control" placeholder="Enter MAIL FROM" name="mail_from" value="{{$mail->mail_from}}">
                                <div class="text-danger" id="mail_from-err"></div>
                           </div>
                       </div>
                       <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                           <div class="wdinput form-group">
                               <label>MAIL ENCRYPTION</label>
                                <input type="text" class="form-control" placeholder="Enter MAIL ENCRYPTION" name="encryption" value="{{$mail->encryption}}">
                                <div class="text-danger" id="encryption-err"></div>
                           </div>
                       </div>
                       <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                           <div class="wdinput form-group">
                               <label>MAIL FROM NAME</label>
                                <input type="text" class="form-control" placeholder="Enter MAIL FROM NAME" name="name" value="{{$mail->name}}">
                                <div class="text-danger" id="name-err"></div>
                           </div>
                       </div>
                        
                   </div>
                    </div>

                    
                   <div class="row">
                       <div class="col-md-12">
                           <div class="wdinput form-group">
                               <button class="btn adminbtn-blue btn-lg email-update-btn" type="submit">Update</button>
                           </div>
                       </div>

                   </div>
                        </form>
                </div>
            
        </div>

        <div id="pane-sms" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-sms">
              <div class="card-body">
                    <form>
                     <div class="email-api-box">
                        <div class="row">
                        <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                           <div class="wdinput form-group">
                               
                               <img src="https://www.webmingo.com/front/img/header/logo-b.png">
                           </div>
                       </div>

                       <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                           <div class="wdinput form-group">
                               <label>API Key</label>
                                <input type="text" class="form-control" placeholder="API Key" name="">
                                
                           </div>
                       </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-12">
                           <div class="wdinput form-group">
                               <label>Auth Key</label>
                                <input type="text" class="form-control" placeholder="Auth key" name="">
                           </div>
                       </div>
                        
                   </div>
                    </div>

                    
                   <div class="row">
                       <div class="col-md-12">
                           <div class="wdinput form-group">
                               <button class="btn adminbtn-blue btn-lg">Update</button>
                           </div>
                       </div>

                   </div>
                        </form>
                </div>
            
        </div>
        
        
         <div id="pane-password" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-password">
             <div class="card-body">
                    <form id="passform" method="POST" action="{{route('admin.update-password-new')}}">
                        @csrf
                        <div class="row">
                       <div class="col-xl-4 col-lg-4 col-md-6 col-12">
                           <div class="wdinput form-group">
                               <label>Enter New Password</label>
                                <input type="password" class="form-control" placeholder="Enter New Password" name="new_password">
                                <div class="text-danger" id="new_password-err"></div>
                           </div>
                       </div>
                        <div class="col-xl-4 col-lg-4 col-md-6 col-12">
                           <div class="wdinput form-group">
                               <label>Confirm New Password</label>
                                <input type="password" class="form-control" placeholder="Confirm New Password" name="new_password_confirmation">
                                <div class="text-danger" id="new_password_confirmation-err"></div>
                           </div>
                       </div>
                       <div class="col-xl-4 col-lg-4 col-md-6 col-12">
                            <div class="wdinput mt-2">
                               <button type="submit" class="btn adminbtn-blue btn-lg update-password-btn">Update</button>
                           </div>
                      </div>
                   </div>
                 </form> 
               
                          <h3 class="mb-2">Recent Password Activity</h3>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" id="example">
                                <thead>
                                    <tr>
                                        <th>Date &amp; Time</th>
                                        <th>IP Address</th>
                                        <th>Password Update Type</th>
                                        <th>Location</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($passwords as $password)
                                       <tr>
                                           <td>{{date('d-m-Y H:i A',strtotime($password->created_at))}}</td>
                                           <td>{{$password->ip_address}}</td>
                                           <td>{{$password->password_update_type}}</td>
                                           <td>{{$password->location}}</td>
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


<!--  edit address modal -->
<div id="companyaddress-modal" class="modal fade" role="dialog">
</div>
@include('admin.footer')
<script>

 $(document).on("click", ".update-password-btn", function(event) {
    event.preventDefault();
    $('#new_password-err').html('');
     $('#new_password_confirmation-err').html('');
              var frm = $('#passform');
             var formData = new FormData(frm[0]);
            $.ajax({
                url: $('#passform').attr('action'),
                 type: 'POST',
                 processData: false,
                contentType: false,
                dataType: 'json',
                data: formData,
                context: this,
                success: function(result) {
                    if (result.success) {
                        location.reload();
                    } else {
                        $(this).attr('disabled', false);
                        if (result.code == 422) {
                            for (const key in result.errors) {
                                $(`#${key}-err`).html(result.errors[key][0]);
                            }
                        } else {
                            console.log(result);
                        }
                    }
                }
            });
        });
        
        $(document).on("click", ".razorpaybtn", function(event) {
    event.preventDefault();
    $('#key-err').html('');
     $('#secret-err').html('');
              var frm = $('#razorpayform');
             var formData = new FormData(frm[0]);
            $.ajax({
                url: $('#razorpayform').attr('action'),
                 type: 'POST',
                 processData: false,
                contentType: false,
                dataType: 'json',
                data: formData,
                context: this,
                success: function(result) {
                    if (result.success) {
                        window.location = "{{url('admin/manage-account/#pane-payment')}}"
                        
                    } else {
                        $(this).attr('disabled', false);
                        if (result.code == 422) {
                            for (const key in result.errors) {
                                $(`#${key}-err`).html(result.errors[key][0]);
                            }
                        } else {
                            console.log(result);
                        }
                    }
                }
            });
        });
         $(document).on("click", ".update-profile-btn", function(event) {
    event.preventDefault();
    $('#name-err').html('');
     $('#email-err').html('');
     $('#phone_number-err').html('');
     $('#alert_email-err').html('');
     $('#image-err').html('');
     $('#image_login_page-err').html('');
     $('#image_header-err').html('');
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
                        location.reload();
                    } else {
                        $(this).attr('disabled', false);
                        if (result.code == 422) {
                            for (const key in result.errors) {
                                $(`#${key}-err`).html(result.errors[key][0]);
                            }
                        } else {
                            console.log(result);
                        }
                    }
                }
            });
        });
        
        $(document).on("click", ".email-update-btn", function(event) {
    event.preventDefault();
    $('#mailer-err').html('');
     $('#host-err').html('');
     $('#port-err').html('');
     $('#username-err').html('');
     $('#password-err').html('');
     $('#mail_from-err').html('');
     $('#encryption-err').html('');
     $('#name-err').html('');
              var frm = $('#emailform');
             var formData = new FormData(frm[0]);
            $.ajax({
                url: $('#emailform').attr('action'),
                 type: 'POST',
                 processData: false,
                contentType: false,
                dataType: 'json',
                data: formData,
                context: this,
                success: function(result) {
                    if (result.success) {
                        window.location = "{{url('admin/manage-account/#pane-email')}}"
                    } else {
                        $(this).attr('disabled', false);
                        if (result.code == 422) {
                            for (const key in result.errors) {
                                $(`#${key}-err`).html(result.errors[key][0]);
                            }
                        } else {
                            console.log(result);
                        }
                    }
                }
            });
        });
         $('#country').on('change', function () {
                var idCountry = this.value;
                $("#state").html('');
                $.ajax({
                    url: "{{url('admin/fetch-states')}}",
                    type: "POST",
                    data: {
                        country_id: idCountry,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (result) {
                        $('#state').html('<option value="">-- Select State --</option>');
                        $.each(result.states, function (key, value) {
                            $("#state").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                        $('#city-dropdown').html('<option value="">-- Select City --</option>');
                    }
                });
            });
        $(document).on("submit", "#gstform", function(event) {
    event.preventDefault();
    $('#company_name-err').html('');
     $('#invoice_address-err').html('');
     $('#invoice_prefix-err').html('');
     $('#pan_number-err').html('');
     $('#state-err').html('');
     $('#city-err').html('');
     $('#gst_number-err').html('');
     $('#pin_code-err').html('');
     $('#country-err').html('');
     $('#cgst_percent-err').html('');
     $('#sgst_percent-err').html('');
     $('#igst_percent-err').html('');
     $('#igst_percent_services-err').html('');
     $('#cgst_percent_services-err').html('');
     $('#sgst_percent_services-err').html('');
     $('#vat-err').html('');
     $('#vat_services-err').html('');
     $('#invoice_number-err').html('');
              var frm = $('#gstform');
             var formData = new FormData(frm[0]);
            $.ajax({
                url: $('#gstform').attr('action'),
                 type: 'POST',
                 processData: false,
                contentType: false,
                dataType: 'json',
                data: formData,
                context: this,
                success: function(result) {
                    if (result.success) {
                        window.location = "{{url('admin/manage-account/#pane-gst')}}"
                    } else {
                        $(this).attr('disabled', false);
                        if (result.code == 422) {
                            for (const key in result.errors) {
                                $(`#${key}-err`).html(result.errors[key][0]);
                            }
                        } else {
                            console.log(result);
                        }
                    }
                }
            });
        });
        
        
 $(document).on("click", ".show-address", function(event) {
            let id = $(this).attr('address_id');
            $.ajax({
                url: `{{ url('admin/manage-companyaddress/${id}') }}`,
                type: "get",
                dataType: "json",
                success: function(result) {
                    if (result.success) {
                        $("#companyaddress-modal").html(result.html);
                        $("#companyaddress-modal").modal('show');
                    } else {
                        toastr.error('error encountered ' + result.msgText);
                    }
                },
                error: function(error) {
                    toastr.error('error encountered ' + error.statusText);
                }
            });
        });
        
$(document).on("click", ".edit-address", function(event) {
            let id = $(this).attr('address_id');
            $.ajax({
                url: `{{ URL::to('admin/manage-companyaddress/${id}/edit') }}`,
                type: "get",
                dataType: "json",
                success: function(result) {
                    if (result.success) {
                        $("#companyaddress-modal").html(result.html);
                        $("#companyaddress-modal").modal('show');
                    } else {
                        toastr.error('error encountered ' + result.msgText);
                    }
                },
                error: function(error) {
                    toastr.error('error encountered ' + error.statusText);
                }
            });
        });
function deleteConfirmation(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `{{ URL::to('admin/manage-companyaddress/${id}') }}`,
                    type: "DELETE",
                    dataType: "json",
                    success: function(result) {
                        if (result.success) {
                            Swal.fire(
                                'Deleted!',
                                'success'
                            );
                            setTimeout(function() {
                                location.reload();
                            }, 400);
                        } else {
                            Swal.fire(result.msgText);
                        }
                    }
                });

            }
        })
    };
    
$(document).on("click", "#add_address", function(event) {
            $.ajax({
                url: "{{ URL::to('admin/manage-companyaddress/create') }}",
                type: "GET",
                dataType: "json",
                success: function(result) {
                    if (result.success) {
                        $("#companyaddress-modal").html(result.html);
                        $("#companyaddress-modal").modal('show');
                    } else {

                    }
                }
            });
        });

$(document).on("click", ".add-address-btn", function(event) {
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
             $('#name-err').html('');
             $('#country-err').html('');
             $('#state-err').html('');
             $('#city-err').html('');
             $('#status-err').html('');
             $('#zip_code-err').html('');
             $('#email-err').html('');
             $('#contact_number-err').html('');
             $('#map_url-err').html('');
             $('#address-err').html('');
            // $(this).attr('disabled', true);
            $.ajax({
                url: "{{ URL::to('admin/manage-companyaddress') }}",
                type: 'POST',
                dataType: 'json',
                data: $("#addressform").serialize(),
                success: function(result) {
                    if (result.success) {
                        sessionStorage.setItem('save_order',true);
                        window.location= "{{url('admin/manage-account/#branch')}}";
                        $("#companyaddress-modal").modal('hide');
                    } else {
                        // $(this).attr('disabled', false);
                        if (result.code == 422) {
                            for (const key in result.errors) {
                                $(`#addressform #${key}-err`).html(result.errors[key][0]);
                            }
                        } else {
                            console.log(result);
                        }
                    }
                }
            });
        });
        
        $(document).on("click", ".update-address-btn", function(event) {
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
             $('#name-err').html('');
             $('#country-err').html('');
             $('#state-err').html('');
             $('#city-err').html('');
             $('#status-err').html('');
             $('#zip_code-err').html('');
             $('#email-err').html('');
             $('#contact_number-err').html('');
             $('#map_url-err').html('');
             $('#address-err').html('');
            // $(this).attr('disabled', true);
            
            let address_id = $(this).attr('address_id');
            $.ajax({
                url: `{{ URL::to('admin/manage-companyaddress/${address_id}') }}`,
                type: 'PUT',
                dataType: 'json',
               data: $("#addressform").serialize(),
                success: function(result) {
                    if (result.success) {
                         sessionStorage.setItem('save_order',true);
                        location.reload();
                        window.location = "{{url('admin/manage-account')}}";
                        $("#companyaddress-modal").modal('hide');
                    } else {
                        // $(this).attr('disabled', false);
                        if (result.code == 422) {
                            for (const key in result.errors) {
                                $(`#${key}-err`).html(result.errors[key][0]);
                            }
                        } else {
                            console.log(result);
                        }
                    }
                }
            });
        });
     
$(function () {
    var hash = location.hash;
    if(hash == "#pane-branch"){
         $("#tab-branch").click();
    }
     if(hash == "#pane-email"){
         $("#tab-email").click();
    }
     if(hash == "#pane-sms"){
         $("#tab-sms").click();
    }
     if(hash == "#pane-gst"){
         $("#tab-gst").click();
    }
     if(hash == "#pane-payment"){
         $("#tab-payment").click();
    }
        if ( sessionStorage.getItem('save_order') ) {
                $("#tab-branch").click();
                sessionStorage.removeItem('save_order');
            }
});
function updateStatus(id){
        Swal.fire({
            title: 'Are you sure?',
            icon: 'success',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, update it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `{{ URL::to('admin/manage-companyaddress/change-status/${id}') }}`,
                    type: "POST",
                    dataType: "json",
                    success: function(result) {
                        if (result.success) {
                            Swal.fire(
                                "Status changed Succesfully"
                            );
                            setTimeout(function() {
                                location.reload();
                            }, 40);
                        } else {
                            Swal.fire(result.msgText);
                        }
                    }
                });

            }
        }) 
    }
    
$('#state').on('change', function () {
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
                       
                        $('#city-dropdown').html('<option value="">-- Select City --</option>');
                        $.each(res.cities, function (key, value) {
                            $("#city-dropdown").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                    }
                });
            });
  $(document).ready(function() {
            $("input[type='radio']").change(function() {
                if ($(this).val() == "other") {
                    $("#otherAnswer").removeAttr('hidden');
                    $("#otherAnswer").show();
                    $(".gst_show").hide();
                } else {
                    $("#otherAnswer").hide();
                }
                
                 if ($(this).val() == "enabled") {
                      $(".gst_show").removeAttr('hidden');
                      $(".gst_show").show();
                 }
            });
           
        });
        
       $(document).ready(()=>{
      $('#payment_image').change(function(){
        const file = this.files[0];
        console.log(file);
        if (file){
          let reader = new FileReader();
          reader.onload = function(event){
            console.log(event.target.result);
            $('#paymentimgpre').attr('src', event.target.result);
          }
          reader.readAsDataURL(file);
        }
      });
    });
    
    $(document).on("click", ".bankbtn", function(event) {
    event.preventDefault();
    $('#ac_name-err').html('');
     $('#ac_number-err').html('');
     $('#bank_name-err').html('');
     $('#ifsc_code-err').html('');
     $('#bank_branch-err').html('');
     $('#payment_image-err').html('');
              var frm = $('#bankform');
             var formData = new FormData(frm[0]);
            $.ajax({
                url: $('#bankform').attr('action'),
                 type: 'POST',
                 processData: false,
                contentType: false,
                dataType: 'json',
                data: formData,
                context: this,
                success: function(result) {
                    if (result.success) {
                        window.location = "{{url('admin/manage-account/#pane-payment')}}"
                        
                    } else {
                        $(this).attr('disabled', false);
                        if (result.code == 422) {
                            for (const key in result.errors) {
                                $(`#${key}-err`).html(result.errors[key][0]);
                            }
                        } else {
                            console.log(result);
                        }
                    }
                }
            });
        });
</script>

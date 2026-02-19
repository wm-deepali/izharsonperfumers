@include('admin.header')
<!--/home/xyzeagledemo/public_html/opalmarketings/resources/views/admin/add-garage/view-garage-detail.blade.php-->
<style>
   .actions > li > a 
    {
        color:#13ad9e !important;
    }
</style>
 <div class="app-content content container-fluid">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-xs-12 mb-2">
                <h3 class="content-header-title mb-0">Garage & Franchise</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-xs-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="https://eagledemo.xyz/opalmarketings/admin/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active">View Garage Details</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        
      
        <div class="col-xl-12 col-lg-12"> 
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">MANAGE - Garage Details</h4>
                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                             <li><a href="javascript:void(0)" class="add-brand"><i class="fa fa-refresh"></i> Refresh </a></li> 
                            <li><a href="javascript:history.go(-1)"><i class="fa fa-backward"></i> Go Back</a></li>
                        </ul>
                    </div> 
                </div>
                <section>
                    <div class="container">
                      <div class="profile-header proposal">
                        <div class="profile-img">
                          <img src="https://eagledemo.xyz/opalmarketings/storage/profile/4Eq4zW8cpvESCB2aP9vbWkQ4TQ9rRCyFyGGZPZ0j.jpg" width="150" alt="Profile Image">
                        </div>
                        <div class="profile-nav-info">
                            
                            <div class="row">
                                <div class="col-sm-5">
                                    <ul class="list-style">
                                        <h4><strong>raushan raushan</strong></h4>
                                        <li>
                                            <i class="fa fa-phone"></i> +91 - 1234967894
                                        </li>
                                        <li><i class="fa fa-envelope"></i> seicatozoprou-7950@yopmail.com</li>
                                        <li><strong>Gender</strong>: male</li>
                                        <li><strong>DOB</strong>: 1998-02-25</li>
                                    </ul>
                                </div>
                                
                                <div class="col-sm-7 bl"> 
                                    <div class="rg-usr">
                                        <div class="d-flex justify-content-between">
                                    </div>
                                         <ul class="list-style">
                                             
                                        <li><strong>Full Address</strong> : <span class="user-add"></span></li>
                                        <li>
                                            <ul class="list-style-o">
                                                <li>
                                                    <strong>Country</strong> : <span class="ref-n"> India </span>
                                                </li>
                                                <li>
                                                    <strong>State</strong> : <span class="ref-n"> Bihar </span>
                                                </li>
                                            </ul>
                                         </li>
                                        <li>
                                            <ul class="list-style-o">
                                                <li>
                                                    <strong>City</strong> :  Patna </li>
                                                <li>
                                                     <strong>Zip Code</strong> : <span class="ref-n">801107</span>
                                                </li>
                                            </ul>
                                          
                                        </li>
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
                            <li><a href="#tabs-1">View All Bookings</a></li>
                            <li><a href="#tabs-2">View All Schedule</a></li>
                            <li><a href="#tabs-3">View Documents</a></li>
                            <li><a href="#tabs-4">Change Password</a></li>
                          </ul>
                              <div id="tabs-1">
                                <section class="cover card-orders-detail">
                                     <div class="row">
                                         <div class="col-md-12">
                                           <h5><strong> View All Bookings</strong></h5>
                                           
                                           <div class="card-headers">
                                                    <ul class="nav nav-tabs" role="tablist">
                                                    	<li class="nav-item">
                                                    		<a class="nav-link active" data-toggle="tab" href="#active_booking " role="tab">Active Bookings</a>
                                                    	</li>
                                                    	<li class="nav-item">
                                                    		<a class="nav-link" data-toggle="tab" href="#completed_booking" role="tab">Completed Bookings</a>
                                                    	</li>
                                                    	<li class="nav-item">
                                                    		<a class="nav-link" data-toggle="tab" href="#cancelled_booking" role="tab">Cancelled Bookings</a>
                                                    	</li>
                                                    </ul>
                                                   
                                                </div>
                                                <div class="tab-content">
                                                	<div class="tab-pane active" id="active_booking" role="tabpanel">
                                                
                                                	<div class="card-body collapse in">
                                                    <div class="card-block card-dashboard">
                                                        <div class="table-responsive">
                                                            <table class="table table-striped table-bordered" id="example">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Booking ID</th>
                                                                        <th>Customer Name</th>
                                                                        <th>Mobile Number & Email ID</th>
                                                                        <th>Car Make</th>
                                                                        <th>Car Model</th>
                                                                        <th>Service Type</th>
                                                                        <th>Service Schedule</th>
                                                                        <th>Pick & Drop</th>
                                                                        <th>Billed Amount</th>
                                                                        <th>Payment Status</th>
                                                                        <th>Service Status</th>
                                                                        <th>Action Button</th>
                                                                    </tr>
                                                                </thead> 
                                                                <tbody>
                                                                    <tr>
                                                                        <td>1</td>
                                                                        <td>A</td>
                                                                        <td>9876543210 & admin@gmail.com</td>
                                                                        <td></td>
                                                                        <td>Toyota</td>
                                                                        <td>Oil Grade</td>
                                                                        <td>22 Dec 2022, 02:00 am</td>
                                                                        <td>Yes</td>
                                                                        <td>$500</td>
                                                                        <td></td>
                                                                        <td>Active</td>
                                                                        <td class="text-truncate">
                                                                             <ul class="actions">
                                                                                <li><a href="" title="View Customer Detail"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                                                                <li><a href="javascript:void(0)" title="View Service Booking"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                                                                <li><a href=""  title="Download Invoice"><i class="fa fa-download" aria-hidden="true"></i></a></li>
                                                                                <li><a href="" title="Change Garage"><i class="fa fa-edit" aria-hidden="true"></i></a></li>
                                                                                <li><a href="" title="Change Schedule"><i class="fa fa-calendar" aria-hidden="true"></i></a></li>
                                                                             
                                                                            </ul>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>1</td>
                                                                        <td>A</td>
                                                                        <td>9876543210 & admin@gmail.com</td>
                                                                        <td></td>
                                                                        <td>Toyota</td>
                                                                        <td>Other Services</td>
                                                                        <td>22 Dec 2022, 02:00 am</td>
                                                                        <td>Yes</td>
                                                                        <td>$500</td>
                                                                        <td></td>
                                                                        <td>Active</td>
                                                                        <td class="text-truncate">
                                                                             <ul class="actions">
                                                                                <li><a href="" title="View Customer Detail"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                                                                <li><a href="javascript:void(0)" title="View Service Booking"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                                                                <li><a href=""  title="Download Invoice"><i class="fa fa-download" aria-hidden="true"></i></a></li>
                                                                                <li><a href="" title="Change Garage"><i class="fa fa-edit" aria-hidden="true"></i></a></li>
                                                                                <li><a href="" title="Change Schedule"><i class="fa fa-calendar" aria-hidden="true"></i></a></li>
                                                                             
                                                                            </ul>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>1</td>
                                                                        <td>A</td>
                                                                        <td>9876543210 & admin@gmail.com</td>
                                                                        <td></td>
                                                                        <td>Toyota</td>
                                                                        <td>VAS</td>
                                                                        <td>22 Dec 2022, 02:00 am</td>
                                                                        <td>Yes</td>
                                                                        <td>$500</td>
                                                                        <td></td>
                                                                        <td>Active</td>
                                                                        <td class="text-truncate">
                                                                             <ul class="actions">
                                                                                <li><a href="" title="View Customer Detail"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                                                                <li><a href="javascript:void(0)" title="View Service Booking"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                                                                <li><a href=""  title="Download Invoice"><i class="fa fa-download" aria-hidden="true"></i></a></li>
                                                                                <li><a href="" title="Change Garage"><i class="fa fa-edit" aria-hidden="true"></i></a></li>
                                                                                <li><a href="" title="Change Schedule"><i class="fa fa-calendar" aria-hidden="true"></i></a></li>
                                                                             
                                                                            </ul>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                        	</div>
                                        	<div class="tab-pane" id="completed_booking" role="tabpanel">
                                        	     
                                        	<div class="card-body collapse in">
                                                    <div class="card-block card-dashboard">
                                                        <div class="table-responsive">
                                                            <table class="table table-striped table-bordered" id="example1">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Booking ID</th>
                                                                        <th>Customer Name</th>
                                                                        <th>Mobile Number & Email ID</th>
                                                                        <th>Car Make</th>
                                                                        <th>Car Model</th>
                                                                        <th>Service Type</th>
                                                                        <th>Service Schedule</th>
                                                                        <th>Pick & Drop</th>
                                                                        <th>Billed Amount</th>
                                                                        <th>Payment Status</th>
                                                                        <th>Service Status</th>
                                                                        <th>Action Button</th>
                                                                    </tr>
                                                                </thead> 
                                                                <tbody>
                                                                    <tr>
                                                                        <td>1</td>
                                                                        <td>A</td>
                                                                        <td>9876543210 & admin@gmail.com</td>
                                                                        <td></td>
                                                                        <td>Toyota</td>
                                                                        <td>Oil Grade</td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td>$500</td>
                                                                        <td></td>
                                                                        <td>Completed</td>
                                                                        <td class="text-truncate">
                                                                             <ul class="actions">
                                                                                <li><a href="" title="View Customer Detail"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                                                                <li><a href="javascript:void(0)" title="View Service Booking"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                                                                <li><a href=""  title="Download Invoice"><i class="fa fa-download" aria-hidden="true"></i></a></li>
                                                                             
                                                                            </ul>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                        	</div>
                                        	<div class="tab-pane" id="cancelled_booking" role="tabpanel">
                                        		<div class="card-body collapse in">
                                                    <div class="card-block card-dashboard">
                                                        <div class="table-responsive">
                                                            <table class="table table-striped table-bordered" id="example2">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Booking ID</th>
                                                                        <th>Customer Name</th>
                                                                        <th>Mobile Number & Email ID</th>
                                                                        <th>Car Make</th>
                                                                        <th>Car Model</th>
                                                                        <th>Service Type</th>
                                                                        <th>Service Schedule</th>
                                                                        <th>Pick & Drop</th>
                                                                        <th>Billed Amount</th>
                                                                        <th>Payment Status</th>
                                                                        <th>Service Status</th>
                                                                        <th>Action Button</th>
                                                                    </tr>
                                                                </thead> 
                                                                <tbody>
                                                                    <tr>
                                                                        <td>1</td>
                                                                        <td>A</td>
                                                                        <td>9876543210 & admin@gmail.com</td>
                                                                        <td></td>
                                                                        <td>Toyota</td>
                                                                        <td>VAS</td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td>$500</td>
                                                                        <td></td>
                                                                        <td>Cancelled</td>
                                                                        <td class="text-truncate">
                                                                             <ul class="actions">
                                                                                <li><a href="" title="View Customer Detail"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                                                                <li><a href="javascript:void(0)" title="View Service Booking"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                                                                <li><a href=""  title="Download Invoice"><i class="fa fa-download" aria-hidden="true"></i></a></li>
                                                                            </ul>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                        	</div>
                                         </div>
                                         </div>
                                     </div>
                                </section>
                            </div><!-- end tab -->
                            
                            
                            <div id="tabs-2">
                                <section>
                               </section>
                            </div>
                            
                            
                            <div id="tabs-3">
                                <section>
                               </section>
                            </div>
        
                      <div id="tabs-4">
                        <section>
                            
                              <h3 class="mb-2"><strong>Change Password</strong></h3>
                                <form method="post" action="">     
                                    <div class="form-group row">
                                <div class="col-sm-4">
                                    <label class="label-control">New Password</label>
                                    <input type="password" class="form-control" name="new_password"  />
                                                    </div>
                                 <div class="col-sm-4">
                                    <label class="label-control">Confirm Password</label>
                                    <input type="password" class="form-control" name="new_password_confirmation" />
                                </div>
                                  <button class="btn adminbtn-blue mt-2" type="submit">Change Password</button>
                            </div>
                           
                                </form>
                            </section>
                        </div>
        
                      </div>
                      </div><!--end proposal -->
                     
                    </div>
                
                    
                    
                </section>
            </div>
        </div>
    </div>
</div>

<!--  edit profile modal  -->

<div class="modal fade" id="edit_profil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top:-20px">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <div class="modal-body">
           <form method="POST" action="https://eagledemo.xyz/opalmarketings/admin/update-customer-profile" enctype="multipart/form-data">
               <input type="hidden" name="_token" value="tU6y7pNyb6Lrp3qioCCd9ePHD696yRusNaRiS7sz">                <div class="row">
                    <div class="col-sm-6 form-group">
                        <label class="label-control label">Name <span class="required">*</span></label>
                        <input type="text" class="form-control" name="name" value="raushan raushan"/>
                        <input type="hidden" name="id" value="43" />
                    </div>
                    <div class="col-sm-6 form-group">
                        <label class="label-control label">Email Id<span class="required">*</span></label>
                        <input type="text" class="form-control" name="email" value="seicatozoprou-7950@yopmail.com" />
                    </div>

                    <div class="col-md-6 form-group">
                        <label class="label-control label">Mobile No. <span class="required">*</span></label>
                        <input type="text" class="form-control" name="mobile_number" value="1234967894"/>
                    </div>
                     <div class="col-sm-6 form-group">
                        <label class="label-control label">Country<span class="required">*</span></label>
                         
                    </div>
                    <div class="col-sm-6 form-group">
                        <label class="label-control label">State<span class="required">*</span></label>
                        <select id="state-dropdown" class="form-control" name="state">
                            <option value="5">  Bihar  </option>
                        </select>
                    </div>
                     <div class="col-sm-6 form-group">
                        <label class="label-control label">City<span class="required">*</span></label>
                        <select id="city-dropdown" class="form-control" name="city">
                            <option value="563">  Patna  </option>
                        </select>
                    </div>
                    <div class="col-sm-6 form-group">
                        <label class="label-control label">Gender <span class="required">*</span></label>
                        <select class="form-control" name="gender">
                            <option  selected   value="male">Male</option>
                            <option  value="female">Fe-Male</option>
                        </select>
                    </div>
                    <div class="col-sm-6 form-group">
                        <label class="label-control label">DOB <span class="required">*</span></label>
                        <input type="date" class="form-control" name="dob" value="1998-02-25"/>
                    </div>
                    
                    <!--<div class="col-sm-6 form-group">-->
                    <!--    <label class="label-control label">Referred By <span class="required">*</span></label>-->
                    <!--    <input type="text" class="form-control"/>-->
                    <!--</div>-->
                    <div class="col-sm-6 form-group">
                        <label class="label-control label">Registration Date<span class="required">*</span></label>
                        <input type="datetime-local" class="form-control" name="registration_date" value="2022-12-12 15:00:41"/>
                    </div>
                     <img src="https://eagledemo.xyz/opalmarketings/storage/profile/4Eq4zW8cpvESCB2aP9vbWkQ4TQ9rRCyFyGGZPZ0j.jpg" width="150" alt="Profile Image">
                    <div class="col-sm-12 form-group">
                        <label class="label-control label">Image<span class="required">*</span></label>
                        <input type="file" class="form-control" name="image"/>
                    </div>
                    </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary add-brand-btn">Update</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
      </div>
    </div>
  </div>
</div>

@include('admin.footer')
<script>
    $(document).ready(function() {
    $('#example2').dataTable();
    
} );

</script>
<script>
    $(function() {
    $( "#tabs" ).tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );
    $( "#tabs li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );
  });
</script>
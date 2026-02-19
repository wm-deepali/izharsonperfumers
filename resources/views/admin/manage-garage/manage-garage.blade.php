@include('admin.header')
 <div class="app-content content container-fluid">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-xs-12 mb-2">
                <h3 class="content-header-title mb-0">Garage & Franchise</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-xs-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="https://eagledemo.xyz/opalmarketings/admin/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active">Manage Garage
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">MANAGE - Garage</h4>
                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a href="https://eagledemo.xyz/opalmarketings/admin/add-garage" class="add-faq"><i class="fa fa-plus"></i> Add </a></li>
                            <li><a href="#"><i class="fa fa-backward"></i> Go Back</a></li>
                        </ul>
                    </div>
                </div>
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
                                                    <th>Garage Type</th>
                                                    <th>Contact Person</th>
                                                    <th>Email ID</th>
                                                    <th>Mobile No.</th>
                                                    <th>Country</th>
                                                    <th>State</th>
                                                    <th>City</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                 <tr>
                                                    <td>2022-12-20 10:42:33</td>
                                                    <td></td>
                                                    <td>112445555</td>
                                                    <td>testdev@gmail.com</td>
                                                    <td>9876543210</td>
                                                    <td>India</td>
                                                    <td>Uttar Pradesh</td>
                                                    <td>Lucknow</td>
                                                    <td class="text-truncate">
                                                        <ul class="actions">
                                                            <li><a href="https://eagledemo.xyz/opalmarketings/admin/view-garage-detail" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                                            <li><a href="" title="Edit" data-toggle="modal" data-target="#edit_modal"><i class="fa fa-edit" aria-hidden="true"></i></a></li>
                                                            <li><a href="#" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                            <li><a href="javascript:void(0)" title="Status"><i class="fa fa-check" aria-hidden="true"></i></a></li>
                                                            <li><a href="javascript:void(0)" title="Upload Documents" data-toggle="modal" data-target="#upload-document_modal"><i class="fa fa-upload" aria-hidden="true"></i></a></li>
                                                            <li><a href="javascript:void(0)" title="View All Services"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                                            <li><a href="javascript:void(0)" title="View All Service Schedule"><i class="fa fa-calendar" aria-hidden="true"></i></a></li>
                                                            <li><a href="javascript:void(0)" title="Change Password"><i class="fa fa-key" aria-hidden="true"></i></a></li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>2022-12-20 10:42:33</td>
                                                    <td></td>
                                                    <td>112445555</td>
                                                    <td>testdev@gmail.com</td>
                                                    <td>9876543210</td>
                                                    <td>India</td>
                                                    <td>Uttar Pradesh</td>
                                                    <td>Lucknow</td>
                                                    <td class="text-truncate">
                                                        <ul class="actions">
                                                            <li><a href="https://eagledemo.xyz/opalmarketings/admin/view-garage-detail" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                                            <li><a href="" title="Edit" data-toggle="modal" data-target="#edit_modal"><i class="fa fa-edit" aria-hidden="true"></i></a></li>
                                                            <li><a href="#" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                            <li><a href="javascript:void(0)" title="Status"><i class="fa fa-ban text-danger" aria-hidden="true"></i></a></li>
                                                            <li><a href="javascript:void(0)" title="Upload Documents" data-toggle="modal" data-target="#upload-document_modal"><i class="fa fa-upload" aria-hidden="true"></i></a></li>
                                                            <li><a href="javascript:void(0)" title="View All Services"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                                            <li><a href="javascript:void(0)" title="View All Service Schedule"><i class="fa fa-calendar" aria-hidden="true"></i></a></li>
                                                            <li><a href="javascript:void(0)" title="Change Password"><i class="fa fa-key" aria-hidden="true"></i></a></li>
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
                </section>
            </div>
        </div>
    </div>
</div>
@include('admin.footer')

<!-- edit modal -->

<div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top:-25px">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
                <div class="form-group row">
                    <div class="col-sm-4">
                        <label class="label-control label">Select Garage Type
                             <span class="required">*</span></label>
                        <select id="service_category_id"
                            class="form-control">
                            <option value="">-- Select --</option>
                            <option value="8"> Self Owned</option>
                            <option value="9"> Franchise</option>
                         </select>
                        <div class="text-danger validation-err"
                            id="service_category_id-err"></div>
                    </div>

                    <div class="col-sm-4">
                        <label class="label-control label">Garage Full Name
                            <span class="required">*</span></label>
                        <input type="text" class="form-control"/>
                        <div class="text-danger validation-err"
                            id="name-err"></div>
                    </div>
                    <div class="col-sm-4">
                        <label class="label-control label">Contact Person Name<span class="required">*</span></label>
                        <input type="text" class="form-control"/>
                        <div class="text-danger validation-err"
                            id="service_time-err"></div>
                    </div>
                 </div>
                <div class="form-group row">
               <div class="col-sm-4">
                    <label class="label-control label">Email Id <span
                            class="required">*</span></label>
                    <input type="email" class="form-control"/>
                    <div class="text-danger validation-err" id="status-err">
                    </div>
                </div>
               <div class="col-md-4">
                    <label class="label-control label">Mobile Number <span
                            class="required">*</span></label>
                     <input type="number" class="form-control"/>
                    <div class="text-danger validation-err" id="image-err">
                    </div>
                </div>
                 <div class="col-md-4">
                    <label class="label-control label">Country <span
                            class="required">*</span></label>
                     <input type="text" class="form-control"/>
                    <div class="text-danger validation-err" id="image-err">
                    </div>
                </div>
               </div>
                 
            <div class="form-group row">
                <div class="col-md-4">
                    <label class="label-control label">State <span
                            class="required">*</span> </label>
                     <input type="text" class="form-control"/>
                    <div class="text-danger validation-err" id="image-err">
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="label-control label">City <span
                            class="required">*</span></label>
                     <input type="text" class="form-control"/>
                    <div class="text-danger validation-err" id="image-err">
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="label-control label">Zip Code <span
                            class="required">*</span> </label>
                     <input type="text" class="form-control"/>
                    <div class="text-danger validation-err" id="image-err">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                  <div class="col-md-4">
                    <label class="label-control label">Enter Password <span
                            class="required">*</span> </label>
                            <input type="password" class="form-control"/>
                    <div class="text-danger validation-err" id="image-err">
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="label-control label">Confirm New Password <span
                            class="required">*</span></label>
                     <input type="password" class="form-control"/>
                    <div class="text-danger validation-err" id="image-err">
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="label-control label">Map Location <span
                            class="required">*</span></label>
                     <input type="password" class="form-control"/>
                    <div class="text-danger validation-err" id="image-err">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <label class="label-control label">Full Address <span
                            class="required">*</span></label>
                     <textarea class="form-control" cols="4" rows="3"></textarea>
                    <div class="text-danger validation-err" id="image-err">
                    </div>
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
         <button type="button" class="btn btn-primary">Update</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>



<!-- // edit modal -->

<!-- upload documents -->

<div class="modal fade" id="upload-document_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload Documents</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top:-25px">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
                <div class="form-group row">
               <div class="col-sm-4">
                    <label class="label-control label">Document Number <span
                            class="required">*</span></label>
                    <input type="email" class="form-control"/>
                    <div class="text-danger validation-err" id="status-err">
                    </div>
                </div>
               <div class="col-md-4">
                    <label class="label-control label">Document Name <span
                            class="required">*</span></label>
                     <input type="number" class="form-control"/>
                    <div class="text-danger validation-err" id="image-err">
                    </div>
                </div>
                 <div class="col-md-4">
                    <label class="label-control label">Browse File <span
                            class="required">*</span></label>
                     <input type="file" class="form-control"/>
                    <div class="text-danger validation-err" id="image-err">
                    </div>
                </div>
               </div>
        </form>
      </div>
      <div class="modal-footer">
         <button type="button" class="btn btn-primary">Upload</button>
        
      </div>
    </div>
  </div>
</div>

<!-- // upload documents modal -->
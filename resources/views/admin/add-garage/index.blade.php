@include('admin.header')
<!--/home/xyzeagledemo/public_html/opalmarketings/resources/views/admin/add-garage/index.blade.php-->


<div class="app-content content container-fluid">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-xs-12 mb-2">
                <h3 class="content-header-title mb-0">Garage & Franchise</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-xs-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="https://eagledemo.xyz/opalmarketings/admin/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="https://eagledemo.xyz/opalmarketings/admin/manage-services">Add
                                    Garage</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Basic form layout section start -->
            <section id="horizontal-form-layouts">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body collapse in row">
                                <div class="col-xl-12 col-lg-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">ADD</h4>
                                            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                            <div class="heading-elements">
                                                <ul class="list-inline mb-0">
                                                    <li><a data-action="reload"><i class="ft-rotate-cw"></i> Refresh</a></li>
                                                    <li><a href="javascript:history.go(-1)"><i class="fa fa-backward"></i> Go
                                                            Back</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="card-block">
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
                                                  <div class="form-actions">
                                                    <button type="button" class="btn btn-primary pull-right" id="add-category-btn"><i class="fa fa-check-square-o"></i> Submit</button>
                                                 </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                              
                  </section>
            </div>
        </div>
</div>

@include('admin.footer')
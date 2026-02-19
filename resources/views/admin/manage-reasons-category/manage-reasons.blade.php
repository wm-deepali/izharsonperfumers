@include('admin.header')
<div class="app-content content container-fluid">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-xs-12 mb-2">
                <h3 class="content-header-title mb-0">Reason</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-xs-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            {{-- <li class="breadcrumb-item">Reasons Category</li> --}}
                            <li class="breadcrumb-item active">Manage Reasons</li>
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
                            <div class="card-header">
                    <h4 class="card-title">Manage Reasons</h4>
                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <!--<li><a href="#" class="add-faq" data-toggle="modal" data-target="#addReason"><i class="fa fa-plus"></i> Add </a></li>-->
                            <li><a href="https://eagledemo.xyz/opalmarketings/admin/manage-reasons"><i class="fa fa-backward" ></i> Go Back</a></li>
                        </ul>
                    </div>
                </div>
                            <div class="card-body collapse in">
                                <div class="card-block card-dashboard">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered" id="example">
                                            <thead>
                                                <tr>
                                                    <th>Date &amp; Time</th>
                                                    <th>Reason Type</th>
                                                    <th>Reason Category</th>
                                                    <th>Reasons</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>20 Dec</td>
                                                    <td>NA</td>
                                                    <td>NA</td>
                                                    <td>Na</td>
                                                    <td class="text-truncate">
                                                        <ul class="actions">
                                                        <!--<li><a href="#" title="Process Refunds" data-toggle="modal" data-target="#addReason"><i class="fa fa-plus" aria-hidden="true"></i></a></li>-->
                                                        <li><a href="#" title="Process Refunds" ><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                                         <li><a href="#" title="View Customer Request" ><i class="fa fa-edit" aria-hidden="true"></i></a></li>
                                                         <li><a href="#" title="View Order Detail" ><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                         <!--<li><a href="#" title="View Customer Detail" data-toggle="modal" data-target="#myModal"><i class="fa fa-eye" aria-hidden="true"></i></a></li>-->
                                                         <!--<li><a href="#" title="Download Invoice" data-toggle="modal" data-target="#myModal"><i class="fa fa-download" aria-hidden="true"></i></a></li>-->
                                                        </ul>
                                                    </td>
                                                </tr>
                                                
                                                <tr>
                                                    <td>20 Dec</td>
                                                    <td>NA</td>
                                                    <td>NA</td>
                                                    <td>Process</td>
                                                    <td class="text-truncate">
                                                        <ul class="actions">
                                                        <!--<li><a href="#" title="Process Refunds" data-toggle="modal" data-target="#addReason"><i class="fa fa-plus" aria-hidden="true"></i></a></li>-->
                                                        <li><a href="#" title="Process Refunds" data-toggle="modal" data-target="#myModal"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                                         <li><a href="#" title="View Customer Request" data-toggle="modal" data-target="#myModal"><i class="fa fa-edit" aria-hidden="true"></i></a></li>
                                                         <li><a href="#" title="View Order Detail" data-toggle="modal" data-target="#myModal"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                         <!--<li><a href="#" title="View Customer Detail" data-toggle="modal" data-target="#myModal"><i class="fa fa-eye" aria-hidden="true"></i></a></li>-->
                                                         <!--<li><a href="#" title="Download Invoice" data-toggle="modal" data-target="#myModal"><i class="fa fa-download" aria-hidden="true"></i></a></li>-->
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
<!-- Modal -->
<div class="modal fade" id="addReason" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reason Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top:-25px">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="reasonOptions">
            <form>
              <div class="form-group">
                <label for="exampleFormControlInput1">Enter reason</label>
                <input type="text" class="form-control" id="exampleFormControlInput1">
              </div>
              <div class="form-group">
                <button type="button" class="btn adminbtn-blue btn-lg">Submit</button>
              </div>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>

@include('admin.footer')
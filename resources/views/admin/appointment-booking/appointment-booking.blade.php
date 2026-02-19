@include('admin.header')
<div class="app-content content container-fluid">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-xs-12 mb-2">
                <h3 class="content-header-title mb-0">Manage Online Appointments</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-xs-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            {{-- <li class="breadcrumb-item">Catalog</li> --}}
                            <li class="breadcrumb-item active">Manage Online Appointments</li>
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
                            <!--<div class="card-header">-->
                            <!--    <div class="add-reason"><span data-toggle="modal" data-target="#addReason">Add <i class="fa fa-plus"></i></span</div>-->
                            <!--</div>-->
                            <div class="card-header">
                    <h4 class="card-title">MANAGE - Online Appointments</h4>
                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <!--<li><a href="#" class="add-faq" data-toggle="modal" data-target="#addReason"><i class="fa fa-plus"></i> Add </a></li>-->
                            <li><a href="javascript:history.go(-1)"><i class="fa fa-backward" ></i> Go Back</a></li>
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
                                                    <th>Customer Name</th>
                                                    <th>Email id</th>
                                                    <th>Mobile Number</th>
                                                    <th>Car Make</th>
                                                    <th>Car Model</th>
                                                    <th>Fuel Type</th>
                                                    <th>Description</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                 @if (isset($datas) && count($datas) > 0)
                                                    @foreach ($datas as $data)
                                                <tr>
                                                    <td>20 Dec</td>
                                                    <td>{{$data->name}}</td>
                                                    <td>{{$data->email}}</td>
                                                    <td>{{$data->mobile_number}}</td>
                                                    <td>{{$data->carmake}}</td>
                                                    <td>{{$data->carmodel}}</td>
                                                    <td>{{$data->fuel_type}}</td>
                                                    <td>{{$data->description}}</td>
                                                    <td class="text-truncate">
                                                        <ul class="actions">
                                                        <li><a href="#" title="Process Refunds" ><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                                         <li><a href="#" title="View Order Detail" ><i class="fa fa-trash" aria-hidden="true"></i></a></li>
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

@include('admin.footer')

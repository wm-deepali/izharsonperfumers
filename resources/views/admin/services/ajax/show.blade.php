@include('admin.header')
<div class="app-content content container-fluid">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-xs-12 mb-2">
                <h3 class="content-header-title mb-0">Catalog</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-xs-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.manage-product.index') }}">Manage
                                    Services</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
       
             <div class="content-body">
             <section id="horizontal-form-layouts">
            <!-- Modal content-->
            <form class="form form-horizontal">

                <div class="form-group row">

                    <div class="col-sm-4">
                        <b class="label-control label"> Date &amp; Time:-</b><span>{{$service->created_at}}</span>
                    </div>
                    <div class="col-sm-4">
                        <b class="label-control label">Service Icon:-</b><span>
                            
                        @if (isset($service->image))
                        <a href="javascript:void(0)" class="view-image" service_id="{{ $service->id }}">
                            <img src="{{ asset('services_images/' . $service->image) }}" height="50" width="50">
                        </a>
                    @else
                        NA
                    @endif
                        </span>
                    </div>
                    <div class="col-sm-4">
                        <b class="label-control label">Service Name:-</b><span>{{ $service->name}}</span>
                    </div>
                    <div class="col-sm-4">
                        <b class="label-control label">Time Duration (in Hours):-</b><span>{{ $service->service_time}}</span>
                    </div>
                    
                    <div class="col-sm-4">
                        <b
                            class="label-control label">Parent Category:-</b><span>{{ \App\Models\Services::test($service->service_category_id) ?? '-' }}</span>
                    </div>
                    <div class="col-sm-4">
                        <b
                            class="label-control label">Status:-</b><span>{{$service->status=="active" ? "Active" : "De-Active"}}</span>
                    </div>
                    
                    <div class="col-sm-4">
                        <b class="label-control label">Service Description:-</b><span>{!! $service->description !!}</span>
                    </div>
                    
                   
                    <div class="mt-3" style="margin-top:30px">
                        <table class="table table-striped mt-3">
                            <thead>
                                <tr>
                                    <th>Car Make</th>
                                    <th>Car Model</th>
                                    <th>MRP</th>
                                    <th>Discount(%)</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($serviceoption as $variant)

                                <tr>
                                    <td>{{$variant->carmake->name}}</td>
                                    <td>{{$variant->carmodel->name}}</td>
                                    <td>{{$variant->mrp}}</td>
                                    <td>{{$variant->discount_percentage}}</td>
                                    <td>{{$variant->price}}</td>
                                </tr>


                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>

            </form>
                        </section>
        </div>
    </div>
</div>
@include('admin.footer')
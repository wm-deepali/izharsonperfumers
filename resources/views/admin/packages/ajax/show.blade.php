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
                            <li class="breadcrumb-item"><a href="{{ route('admin.manage-packages.index') }}">Manage
                                    packages</a></li>
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
                        <b class="label-control label"> Date &amp; Time:-</b><span>{{$package->created_at}}</span>
                    </div>
                    <div class="col-sm-4">
                        <b class="label-control label">package Icon:-</b><span>
                            
                        @if (isset($package->image))
                    <a href="javascript:void(0)" class="view-image" category_id="{{ $package->id }}">
                        <img src="{{ URL::asset('package_images/' . $package->image) }}" height="50" width="50">
                    </a>
                @else
                    NA
                @endif
                        </span>
                    </div>
                    <div class="col-sm-4">
                        <b class="label-control label">package Name:-</b><span>{{ $package->name}}</span>
                    </div>
                    <div class="col-sm-4">
                        <b class="label-control label">Time Duration (in Hours):-</b><span>{{ $package->service_time}}</span>
                    </div>
                    
                    
                    <div class="col-sm-4">
                        <b
                            class="label-control label">Status:-</b><span>{{$package->status=="active" ? "Active" : "De-Active"}}</span>
                    </div>
                    
                    <div class="col-sm-4">
                        <b class="label-control label">Short Description:-</b><span>{!! $package->short_description !!}</span>
                    </div>
                    <div class="col-sm-4">
                        <b class="label-control label">Detail Description:-</b><span>{!! $package->detail_description !!}</span>
                    </div>
             {{--       <div class="col-sm-4">
                        <b class="label-control label">Currency :-</b><span>{!! $package->currency_type !!}</span>
                    </div>
                    <div class="col-sm-4">
                        <b class="label-control label">Service Category :-</b><span>{{ \App\Models\Services::test($package->service_category_id) ?? '-' }}</span>
                    </div>
                    <div class="col-sm-4">
                        <b class="label-control label">Services :-</b><span>{{$package->service->name}}</span>
                    </div>
                    --}}
                   
                    <div class="mt-3" style="margin-top:30px">
                        <table class="table table-striped mt-3">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Car Origin</th>
                                    <th>Oil Grade</th>
                                    <th>No Of Cylinder</th>
                                    <th>MRP</th>
                                    <th>Discount(%)</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($packageoption as $key=> $variant)

                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$variant->carorigin->title}}</td>
                                    <td>{{$variant->oilgrade->title}}</td>
                                    <td>{{$variant->cylinder->title}}</td>
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
<div class="modal-dialog">
    <!-- Modal content-->
    <form class="form form-horizontal">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">View</h4>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-sm-4">
                        <b class="label-control label">Date &amp; Time:-</b><span>{{$brand->created_at}}</span>
                    </div>
                    <div class="col-sm-4">
                        <b class="label-control label">Model Image:-</b><span>@if (isset($brand->image))
                            <a href="javascript:void(0)" class="view-image" brand_id="{{ $brand->id }}">
                                <img src="{{ asset('brands_imagesmodel/' . $brand->image) }}" height="50" width="50">
                            </a>
                            @else
                            NA
                            @endif</span>
                    </div>
                    <div class="col-sm-4">
                        <b class="label-control label">Car Model:-</b><span>{{$brand->name}}</span>
                    </div>
                    <div class="col-sm-4">
                        <b class="label-control label">Car Manufacturer:-</b><span>{{$brand->brand->name}}</span>
                    </div>
                    <div class="col-sm-4">
                        <b
                            class="label-control label">Status:-</b><span>{{$brand->status=="active" ? "Active" : "De-Active"}}</span>
                    </div>
                    <div class="col-sm-4">
                        <b
                            class="label-control label">Fuel Type:-</b><span>@php echo implode(",",json_decode($brand->fueltype)); @endphp</span>
                    </div>

                </div>
            </div>
        </div>
    </form>
</div>
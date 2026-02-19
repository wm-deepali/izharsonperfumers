@include('admin.header')
<div class="app-content content container-fluid">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-xs-12 mb-2">
                <h3 class="content-header-title mb-0">Shipping</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-xs-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.manage-shipping') }}">Manage Shipping</a></li>
                            <li class="breadcrumb-item active">EDIT SHIPPING</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">EDIT SHIPPING</h4>
                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i> Refresh </a></li>
                            <li><a href="javascript:history.go(-1)"><i class="fa fa-backward"></i> Go Back</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body collapse in">
                    <div class="card-block">
                        <form class="form form-horizontal">
                            <div class="form-body">
                                <div class="form-group row">
                                    <label class="col-md-2 label-control">Shipping Type</label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder="Enter Shipping Type " name="name" id="name" value="{{ $shippingData->name }}">
                                        <div class="text-danger validation-err" id="name-err"></div>
                                    </div>
                                    <label class="col-md-2 label-control">Per 1000 ML (Inter State)</label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder="Enter Per 1000 ML (Inter State)" name="in_state_charge" id="in_state_charge" value="{{ $shippingData->in_state_charge }}">
                                        <div class="text-danger validation-err" id="in_state_charge-err"></div>
                                    </div>
                                    
                                </div>

                               


                            
                                <div class="form-group row">
                                    <label class="col-md-2 label-control">Per 1000 ML (Intra State)</label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder="Enter Per 1000 ML (Intra State)" name="out_state_charge" id="out_state_charge" value="{{ $shippingData->out_state_charge }}">
                                        <div class="text-danger validation-err" id="out_state_charge-err"></div>
                                    </div>
                                   <label class="col-md-2 label-control">Delivery Days Range</label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder="Enter Delivery Days Range " name="delivery_days_range" id="delivery_days_range" value="{{ $shippingData->delivery_days_range }}">
                                        <div class="text-danger validation-err" id="delivery_days_range-err"></div>
                                    </div>
                                    
                                </div>
                            <div class="form-group row">
                                <label class="col-md-2 label-control">Max Charges</label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder="Enter Max Charges" name="max_charges" id="max_charges" value="{{ $shippingData->max_charges }}">
                                        <div class="text-danger validation-err" id="max_charges-err"></div>
                                    </div>
                                    
                                    <label class="col-md-2 label-control">Status* </label>
                                    <div class="col-md-4">
                                        <select class="form-control" name="status" id="status">
                                            <option value="active" @if ($shippingData->status == 'active') selected @endif>Active</option>
                                            <option value="block" @if ($shippingData->status == 'block') selected @endif>De-Activate</option>
                                        </select>
                                        <div class="text-danger validation-err" id="status-err"></div>
                                    </div>
                                   
                                </div>
              
                                <div class="form-group row">
                                    <div class="col-sm-12 text-center mt-3">
                                        <button type="button" class="btn btn-primary" id="update-shipping-btn" shipping_cost_id="{{ $shippingData->id }}">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.footer')
<script>
    $(document).ready(function() {
        $(document).on("click", "#update-shipping-btn", function(event) {
            $(this).attr('disabled', true);
            $(".validation-err").html("");
            let formData = new FormData();
           
            formData.append('name', $('#name').val());
            formData.append('in_state_charge', $('#in_state_charge').val());
            formData.append('out_state_charge', $('#out_state_charge').val());
            formData.append('delivery_days_range', $('#delivery_days_range').val());
            formData.append('status', $('#status').val());
            formData.append('max_charges', $('#max_charges').val());
            let shipping_cost_id = $(this).attr('shipping_cost_id');
            $.ajax({
                url: `{{ URL::to('admin/update-shipping/${shipping_cost_id}') }}`,
                type: 'POST',
                processData: false,
                contentType: false,
                dataType: 'json',
                data: formData,
                context: this,
                success: function(result) {
                    if (result.success) {
                        window.location = "{{ URL::to('admin/manage-shipping') }}";
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
    });
</script>

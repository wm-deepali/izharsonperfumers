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
                            <li class="breadcrumb-item active">EDIT FREE SHIPPING</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">EDIT FREE SHIPPING</h4>
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
                                    <label class="col-md-2 label-control">Min Order Amount (Intra State)</label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder="Enter Min Order Value" name="min_order_amount_intrastate" id="min_order_amount_intrastate" value="{{ $shippingData->min_order_value_intrastate }}">
                                        <div class="text-danger validation-err" id="min_order_amount_intrastate-err"></div>
                                    </div>
                                    <label class="col-md-2 label-control"> Min Order Amount (Inter State)</label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder="Enter Min Quantity Value" name="min_order_amount_interstate" id="min_order_amount_interstate" value="{{ $shippingData->min_order_value_interstate }}">
                                        <div class="text-danger validation-err" id="min_order_amount_interstate-err"></div>
                                    </div>
                                </div>
                               
                                
                                    
                                    
                                <div class="form-group row">
                                    <label class="col-md-2 label-control">Delivery Days Range (Intra State)</label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder="Enter Delivery Days Range (Intra State)" name="day_range_inter_state" id="day_range_inter_state" value="{{ $shippingData->day_range_inter_state }}">
                                        <div class="text-danger validation-err" id="day_range_inter_state-err"></div>
                                    </div>
                                    <label class="col-md-2 label-control">Delivery Days Range (Intra State)</label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder="Enter Delivery Days Range (Intra State)" name="day_range_intra_state" id="day_range_intra_state" value="{{ $shippingData->day_range_intra_state }}">
                                        <div class="text-danger validation-err" id="day_range_intra_state-err"></div>
                                    </div>
                                {{--   <label class="col-md-2 label-control">Max Order Amount  </label>
                                        <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder="Enter Max Order Amount" name="max_order_value" id="max_order_value" value="{{ $shippingData->max_order_value }}">
                                        <div class="text-danger validation-err" id="max_order_value-err"></div>
                                    </div>
                                  
                                    <label class="col-md-2 label-control">In State Per Piece Charge </label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder="Enter Per Piece Charge" name="in_state_charge" id="in_state_charge" value="{{ $shippingData->in_state_charge }}">
                                        <div class="text-danger validation-err" id="in_state_charge-err"></div>
                                    </div>
                                      --}} 
                                </div>


                            {{--  
                                <div class="form-group row">
                                     <label class="col-md-2 label-control">Per Pcs Cost (Inter State)</label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder="Enter Per Pcs Cost (Inter State)" name="out_state_charge" id="out_state_charge" value="{{ $shippingData->out_state_charge }}">
                                        <div class="text-danger validation-err" id="out_state_charge-err"></div>
                                    </div>
                                <label class="col-md-2 label-control">Max Delivery Days</label>
                                    <div class="col-md-4">
                                        <input type="number" class="form-control" placeholder="Enter Max Days " name="maximum_days" id="maximum_days" value="{{ $shippingData->maximum_days }}">
                                        <div class="text-danger validation-err" id="maximum_days-err"></div>
                                    </div>
                                   
                                </div>
                                  --}} 
                                <div class="form-group row">
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
            formData.append('min_order_amount_intrastate', $('#min_order_amount_intrastate').val());
            formData.append('min_order_amount_interstate', $('#min_order_amount_interstate').val());
            formData.append('day_range_inter_state', $('#day_range_inter_state').val());
            formData.append('day_range_intra_state', $('#day_range_intra_state').val());
        
            formData.append('status', $('#status').val());
            let shipping_cost_id = $(this).attr('shipping_cost_id');
            $.ajax({
                url: `{{ URL::to('admin/update-free-shipping/${shipping_cost_id}') }}`,
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

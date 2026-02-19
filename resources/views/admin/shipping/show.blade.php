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
                        <b class="label-control label">Min Order Value:-</b><span>{{$shipping->min_order_value}}</span>
                    </div>
                    <div class="col-sm-4">
                        <b class="label-control label">Per Pcs Cost (Intrastate):-</b><span>{{$shipping->in_state_charge}}</span>
                    </div>
                    <div class="col-sm-4">
                        <b class="label-control label">Per Pcs Cost (Inter State):-</b><span>{{$shipping->out_state_charge}}</span>
                    </div>
                    
                    <div class="col-sm-4">
                        <b
                            class="label-control label">Delivery Days Status:-</b><span>{{$shipping->status=="active" ? "Active" : "De-Active"}}</span>
                    </div>
                   
                </div>
            </div>
        </div>
    </form>
</div>
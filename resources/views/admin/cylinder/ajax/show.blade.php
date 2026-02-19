<div class="modal-dialog">
    <!-- Modal content-->
    <form class="form form-horizontal">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">View</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6 form-group">
                        <b class="label-control label">No Of Cylinder:-</b><span> {{$carorigin->title}}</span>
                    </div>
                    <div class="col-sm-6 form-group">
                        <b
                            class="label-control label">Status:-</b><span> {{$carorigin->status=="active" ? "Active" : "De-Active"}}</span>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
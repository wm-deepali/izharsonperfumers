<style>
    .modal-body {
    height: 30vh;
    overflow-y: auto;
}
</style>
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
                        <b class="label-control label">Brand Name:-</b><span>{{$carorigin->title}}</span>
                    </div>
                    <div class="col-sm-4">
                        <b
                            class="label-control label">Status:-</b><span>{{$carorigin->status=="active" ? "Active" : "De-Active"}}</span>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
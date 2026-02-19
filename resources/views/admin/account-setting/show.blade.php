<style>
    .modal-body {
    height: 80vh;
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
                        <b class="label-control label">Branch Name:-</b><span>{{$companyaddress->name}}</span>
                    </div>
                    <div class="col-sm-4">
                        <b class="label-control label">Country Name:-</b><span>{{$companyaddress->countries->name}}</span>
                    </div>
                    <div class="col-sm-4">
                        <b class="label-control label">State Name:-</b><span>{{$companyaddress->states->name}}</span>
                    </div>
                    <div class="col-sm-4">
                        <b class="label-control label">City Name:-</b><span>{{$companyaddress->citys->name}}</span>
                    </div>
                    <div class="col-sm-4">
                        <b class="label-control label">Zip Code:-</b><span>{{$companyaddress->zip_code}}</span>
                    </div>
                    <div class="col-sm-4">
                        <b class="label-control label">Email:-</b><span>{{$companyaddress->email}}</span>
                    </div>
                    <div class="col-sm-4">
                        <b class="label-control label">Contact Number:-</b><span>{{$companyaddress->contact_number}}</span>
                    </div>
                    <div class="col-sm-4">
                        <b class="label-control label">Address:-</b><span>{{$companyaddress->address}}</span>
                    </div>
                     <div class="col-sm-4">
                        <b
                            class="label-control label">Status:-</b><span>{{$companyaddress->status=="active" ? "Active" : "De-Active"}}</span>
                    </div>
                    <div class="col-sm-12">
                        <b class="label-control label">Map Location:-</b><span>{!! $companyaddress->map_url !!}</span>
                    </div>
                   
                </div>
            </div>
        </div>
    </form>
</div>
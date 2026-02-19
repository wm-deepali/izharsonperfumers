<style>
    .modal-body {
    height: 60vh;
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
                    <div class="col-sm-6 mb-3">
                        <b class="label-control label">Promotion Name:-</b><span>{{$promotion->name}}</span>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <b class="label-control label">Promotion Validity:-</b><span>{{$promotion->validity}}</span>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <b class="label-control label">Promotion URL:-</b><span>{{$promotion->url}}</span>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <b class="label-control label">Promotion Image:-</b><span>
                             @if(isset($promotion->image))
                                <a href="javascript:void(0)">
                                    <img src="{{ URL::asset('storage/' . $promotion->image) }}" class="img-fluid"style="height:50px;" />
                                </a>
                            @else
                            NA
                            @endif

                        </span>
                    </div>
                    <div class="row ml-3">
                        <b class="label-control label">Promotion Detail:-</b>
                        {!! $promotion->detail!!}</div>

                </div>
            </div>
        </div>
    </form>
</div>
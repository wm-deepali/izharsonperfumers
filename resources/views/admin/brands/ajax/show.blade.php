<div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <form class="form form-horizontal">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">View</h4>
            </div>
            <div class="modal-body">
                <div class="row">

                    <div class="col-sm-4 form-group">
                        <b class="label-control label"> Date &amp; Time:-</b><span>{{$brand->created_at}}</span>
                    </div>
                    <div class="col-sm-4 form-group">
                        <b class="label-control label">Company Logo:-</b><span>@if (isset($brand->image))
                            <a href="javascript:void(0)" class="view-image" brand_id="{{ $brand->id }}">
                                <img src="{{ asset('brands_images/' . $brand->image) }}" height="50" width="50">
                            </a>
                            @else
                            NA
                            @endif
                        </span>
                    </div>
                    <div class="col-sm-4 form-group">
                        <b class="label-control label">Car Manufacturer:-</b><span>{{$brand->name}}</span>
                    </div>
                    <div class="col-sm-4 form-group">
                        <b class="label-control label">URL Slug:-</b><span>{{$brand->url}}</span>
                    </div>

                    <div class="col-sm-4 form-group">
                        <b
                            class="label-control label">Status:-</b><span>{{$brand->status=="active" ? "Active" : "De-Active"}}</span>
                    </div>
                    <div class="col-sm-4 form-group">
                        <b
                            class="label-control label">Meta Title:-</b><span>{{$brand->meta->meta_title}}</span>
                    </div>
                    <div class="col-sm-4 form-group">
                        <b
                            class="label-control label">Meta Keywords:-</b><span>{{$brand->meta->meta_description}}</span>
                    </div>
                    <div class="col-sm-4 form-group">
                        <b
                            class="label-control label">Meta Description:-</b><span>{{$brand->meta->meta_keyword}}</span>
                    </div>
                    <div class="col-sm-4 form-group">
                        <b
                            class="label-control label">Canonical Tag:-</b><span>{{$brand->meta->canonical_tags}}</span>
                    </div>
                    <div class="col-sm-4 form-group">
                        <b
                            class="label-control label">Twitter Cards:-</b><span>{{$brand->meta->twitter_cards}}</span>
                    </div>
                    <div class="col-sm-4 form-group">
                        <b
                            class="label-control label">OG Tags:-</b><span>{{$brand->meta->og_tags}}</span>
                    </div>
                    
                </div>
            </div>
        </div>
    </form>
</div>
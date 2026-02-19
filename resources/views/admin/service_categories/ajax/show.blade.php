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
                        <b class="label-control label"> Date &amp; Time:-</b><span>{{$category->created_at}}</span>
                    </div>
                    <div class="col-sm-4">
                        <b class="label-control label">Service Icon:-</b>
                        <span>
                        @if (isset($category->image))
                                                                    <a href="javascript:void(0)" class="view-image" category_id="{{ $category->id }}">

                                                                        <img src="{{ asset('service_cat_images/' . $category->image) }}" height="50" width="50">
                                                                    </a>
                                                                @else
                                                                    NA
                                                                @endif
                        </span>
                    </div>
                    <div class="col-sm-4">
                        <b class="label-control label">Service Name:-</b><span>{{$category->name}}</span>
                    </div>
                    <div class="col-sm-4">
                        <b class="label-control label">URL Slug:-</b><span>{{$category->slug}}</span>
                    </div>
                    <div class="col-sm-4">
                        <b class="label-control label">Other Services:-</b><span>{{$category->other_service}}</span>
                    </div>
                    <div class="col-sm-4">
                        <b class="label-control label">VAS:-</b><span>{{$category->value_added_service}}</span>
                    </div>
                    <div class="col-sm-4">
                        <b class="label-control label">Description:-</b><span>{{$category->description}}</span>
                    </div>

                    <div class="col-sm-4">
                        <b
                            class="label-control label">Status:-</b><span>{{$category->status=="active" ? "Active" : "De-Active"}}</span>
                    </div>
                    <div class="col-sm-4">
                        <b
                            class="label-control label">Meta Title:-</b><span>{{$category->meta->meta_title}}</span>
                    </div>
                    <div class="col-sm-4">
                        <b
                            class="label-control label">Meta Keywords:-</b><span>{{$category->meta->meta_description}}</span>
                    </div>
                    <div class="col-sm-4">
                        <b
                            class="label-control label">Meta Description:-</b><span>{{$category->meta->meta_keyword}}</span>
                    </div>
                    
                </div>
            </div>
        </div>
    </form>
</div>
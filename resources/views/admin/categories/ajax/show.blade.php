<style>
    .modal-body {
    height: 30vh;
    overflow-y: auto;
}
</style>

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
                        <b class="label-control label">@if(isset($category->parent_id)) Sub Category @else Category @endif Name:-</b><span>{{$category->name}}</span>
                    </div>
                    @if($category->parent_id)
                    <div class="col-sm-4 form-group">
                        <b class="label-control label">Parent Category:-</b><span>{{$category->parent->name}}</span>
                    </div>
                    @else
                    <div class="col-sm-4 form-group">
                        <b class="label-control label">URL Slug:-</b><span>{{$category->slug}}</span>
                    </div>
                    @endif
                    
                    <div class="col-sm-4 form-group">
                        <b class="label-control label">@if(isset($category->parent_id)) Sub-Category @else Category @endif Icon:-</b><span> @if (isset($category->image))
                            <a href="javascript:void(0)" class="view-image" category_id="{{ $category->id }}">
                                <img src="{{ asset('categories_images/' . $category->image) }}" height="40" width="40">
                            </a>
                        @else
                            NA
                        @endif</span>
                    </div>
                    
                    <div class="col-sm-4 form-group">
                        <b
                            class="label-control label">Status:-</b><span>{{$category->status=="active" ? "Active" : "De-Active"}}</span>
                    </div>
                    <div class="col-sm-4 form-group">
                        <b
                            class="label-control label">Meta Title:-</b><span>{{$category->meta->meta_title}}</span>
                    </div>
                    <div class="col-sm-4 form-group">
                        <b
                            class="label-control label">Meta Keywords:-</b><span>{{$category->meta->meta_description}}</span>
                    </div>
                    <div class="col-sm-4 form-group">
                        <b
                            class="label-control label">Meta Description:-</b><span>{{$category->meta->meta_keyword}}</span>
                    </div>
                    <div class="col-sm-4 form-group">
                        <b
                            class="label-control label">Canonical Tag:-</b><span>{{$category->meta->canonical_tags}}</span>
                    </div>
                    <div class="col-sm-4 form-group">
                        <b
                            class="label-control label">Twitter Cards:-</b><span>{{$category->meta->twitter_cards}}</span>
                    </div>
                    <div class="col-sm-4 form-group">
                        <b
                            class="label-control label">OG Tags:-</b><span>{{$category->meta->og_tags}}</span>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
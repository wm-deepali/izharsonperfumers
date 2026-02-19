<div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <form class="form form-horizontal">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit</h4>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                <div class="col-sm-4">
                        <label class="label-control label">Car Manufacturer <span class="required">*</span></label>
                        <select class="form-control" name="brand_id" id="brand_id" placeholder="Enter Car Manufacturer">
                            @foreach($brands as $brand)
                            <option value="{{$brand->id}}" @if($brandmodel->brand_id == $brand->id) selected
                                @endif>{{$brand->name}}</option>
                            @endforeach
                        </select>
                        <div class="text-danger" id="brand-err"></div>
                    </div>
                    <div class="col-sm-4">
                        <label class="label-control label">Car Model <span class="required">*</span></label>
                        <input type="text" class="form-control" placeholder="Enter Car Model" name="name" id="name"
                            value="{{ $brandmodel->name }}">
                        <div class="text-danger" id="name-err"></div>
                    </div>
                    @if($language)
                    <div class="col-sm-4">
                        <label class="label-control label">Car Model Ar<span class="required">*</span></label>
                        <input type="text" class="form-control" placeholder="Enter Arabic Car Model" name="name_ar"
                            id="name_ar" value="{{ $brandmodel->name_ar }}">
                        <div class="text-danger" id="name_ar-err"></div>
                    </div>
                    @endif
                    
                </div>

                <div class="form-group row">
                    {{--
                <div class="col-sm-3">
                        <label class="label-control label">Url <span class="required">*</span></label>
                        <input type="text" class="form-control" placeholder="Enter Url" name="url" id="url" value="{{ $brandmodel->url }}">
                    <div class="text-danger" id="url-err"></div>
                </div>
                --}}
                <div class="col-md-3">
                    <label class="label-control label">Model Image	 <span class="required">*</span></label>
                    <input type="file" class="form-control" name="image" id="image">
                    <div class="text-danger" id="image-err"></div>
                </div>
                <div class="col-sm-3">
                    <label class="label-control label">Status <span class="required">*</span></label>
                    <select class="form-control" name="status" id="status">
                        <option value="active" @if ($brandmodel->status == 'active') selected @endif>Active</option>
                        <option value="block" @if ($brandmodel->status == 'block') selected @endif>De-Active</option>
                    </select>
                    <div class="text-danger" id="status-err"></div>
                </div>
                <div class="col-md-3">
                    <label class="label-control label">Fules Types</label>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="check1" name="fueltype[]" value="Petrol"
                            <?php  if(isset($brandmodel->fueltype) && in_array("Petrol", json_decode($brandmodel->fueltype))){ echo 'checked';}  ?>>
                        <label class="form-check-label" for="check1">Petrol</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="check2" name="fueltype[]" value="Diesel"
                            <?php if(isset($brandmodel->fueltype) && in_array("Diesel", json_decode($brandmodel->fueltype))){ echo 'checked';}  ?>>
                        <label class="form-check-label" for="check2">Diesel</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="check3" name="fueltype[]"
                            value="Electric Vehicle"
                            <?php if(isset($brandmodel->fueltype) && in_array("Electric Vehicle", json_decode($brandmodel->fueltype))){ echo 'checked';}  ?>>
                        <label class="form-check-label" for="check3">Electric Vehicle</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="check4" name="fueltype[]" value="CNG"
                            <?php if(isset($brandmodel->fueltype) && in_array("CNG", json_decode($brandmodel->fueltype))){ echo 'checked';}  ?>>
                        <label class="form-check-label" for="check4">CNG</label>
                    </div>
                    <div class="col-md-3">
                    @php
    use App\Models\Cylinder;
    $cylinders = Cylinder::all();
@endphp
                    <label class="label-control label">Cylinder</label>
                    @foreach($cylinders as $cylinder)
                    <div class="form-check">
                          <input type="checkbox" <?php if(isset($brandmodel->cylinder) && in_array($cylinder->id, json_decode($brandmodel->cylinder))){ echo 'checked';}  ?> class="form-check-input" id="check2" name="cylinder[]" value="{{$cylinder->id}}" >
                          <label class="form-check-label" for="check2">{{$cylinder->title}}</label>
                        </div>
                    @endforeach

</div>
                    <div class="text-danger" id="image-err"></div>
                </div>

            </div>
            {{--
                <div class="form-group row">
                    <div class="col-sm-4">
                        <label class="label-control label">Meta Title <span class="required">*</span></label>
                        <input type="text" class="form-control" placeholder="Enter Meta Title" name="meta_title" id="meta_title" maxlength="60" value="{{ $brandmodel->meta_title }}">
            <span class="note-span" id="meta_title-limit">We recommend title between 50–60 characters.(0
                character)</span>
            <div class="text-danger" id="meta_title-err"></div>
        </div>

        <div class="col-sm-4">
            <label class="label-control label">Meta Keywords <span class="required">*</span></label>
            <textarea class="form-control" rows="4" cols="7" placeholder="Enter Meta Keywords" name="meta_keyword"
                id="meta_keyword">{{ $brandmodel->meta_keyword }}</textarea>
            <div class="text-danger" id="meta_keyword-err"></div>
        </div>

        <div class="col-sm-4">
            <label class="label-control label">Meta Description <span class="required">*</span></label>
            <textarea class="form-control" rows="4" cols="7" placeholder="Enter Meta Description"
                name="meta_description" id="meta_description"
                maxlength="160">{{ $brandmodel->meta_description }}</textarea>
            <span class="note-span" id="meta_description-limit">We recommend descriptions between 50–160 characters.(0
                character)</span>
            <div class="text-danger" id="meta_description-err"></div>
        </div>
</div>

<div class="form-group row">
    <div class="col-sm-4">
        <label class="label-control label">Meta Title (ar)<span class="required">*</span></label>
        <input type="text" class="form-control" placeholder="Enter Meta Title" name="meta_title_ar" id="meta_title_ar"
            maxlength="60" value="{{ $brandmodel->meta_title_ar }}">
        <span class="note-span" id="meta_title-limit">We recommend title between 50–60 characters.(0 character)</span>
        <div class="text-danger" id="meta_title-err"></div>
    </div>

    <div class="col-sm-4">
        <label class="label-control label">Meta Keywords (ar)<span class="required">*</span></label>
        <textarea class="form-control" rows="4" cols="7" placeholder="Enter Meta Keywords_ar" name="meta_keyword_ar"
            id="meta_keyword_ar">{{ $brandmodel->meta_keyword_ar }}</textarea>
        <div class="text-danger" id="meta_keyword-err"></div>
    </div>

    <div class="col-sm-4">
        <label class="label-control label">Meta Description (ar)<span class="required">*</span></label>
        <textarea class="form-control" rows="4" cols="7" placeholder="Enter Meta Description" name="meta_description_ar"
            id="meta_description_ar" maxlength="160">{{ $brandmodel->meta_description_ar }}</textarea>
        <span class="note-span" id="meta_description-limit">We recommend descriptions between 50–160 characters.(0
            character)</span>
        <div class="text-danger" id="meta_description-err"></div>
    </div>
</div>
--}}
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-primary" id="update-brandmodel-btn"
        brandmodel_id="{{ $brandmodel->id }}">Submit</button>
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
</form>
</div>
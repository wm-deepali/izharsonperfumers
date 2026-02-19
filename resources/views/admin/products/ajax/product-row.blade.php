<div class="block">
    <div class="form-group row">
        <div class="col-sm-2">
            <label class="label label-control" for="color_1"><span class="subcatname1">Choose Color</span><span class="mandatory-red subcat1req"></span></label>
            <select class="form-control color" name="color[]" id="color_1">
                <option value="">Select</option>
                @if (isset($colors) && count($colors) > 0)
                    @foreach ($colors as $color)
                        <option value="{{ $color->id }}">{{ $color->name }}</option>
                    @endforeach
                @endif
            </select>
            <div class="text-danger" id="color-err"></div>
        </div>

        <div class="col-sm-2">
            <label class="label label-control" for="attribute_1_1"><span class="attribute_name_1">Choose {{ $attribute_name_1 }}</span><span class="mandatory-red subcat2req"></span></label>
            <select class="form-control attribute_1" name="attribute_1[]" id="attribute_1_1">
                <option value="">Choose</option>
                @if (isset($attribute_1_childs) && count($attribute_1_childs) > 0)
                    @foreach ($attribute_1_childs as $attribute_1_child)
                        <option value="{{ $attribute_1_child->id }}">{{ $attribute_1_child->name }}</option>
                    @endforeach
                @endif
            </select>
            <div class="text-danger" id="attribute_1-err"></div>
        </div>

        <div class="col-sm-2">
            <label class="label label-control" for="attribute_2_1"><span class="attribute_name_2">Choose {{ $attribute_name_2 }}</span><span class="mandatory-red subcat3req"></span></label>
            <select class="form-control attribute_2" name="attribute_2[]" id="attribute_2_1">
                <option value="">Choose</option>
                @if (isset($attribute_2_childs) && count($attribute_2_childs) > 0)
                    @foreach ($attribute_2_childs as $attribute_2_child)
                        <option value="{{ $attribute_2_child->id }}">{{ $attribute_2_child->name }}</option>
                    @endforeach
                @endif
            </select>
            <div class="text-danger" id="attribute_2-err"></div>
        </div>

        <div class="col-sm-1">
            <label class="label-control">Stock</label>
            <input type="number" class="form-control stock" min="1" name="stock[]" value="1">
            <div class="text-danger" id="stock-err"></div>
        </div>
        <div class="col-sm-1">
            <label class="label-control">MRP</label>
            <input type="number" placeholder="MRP" class="form-control mrp" min="1" name="mrp[]" value="1">
            <div class="text-danger" id="mrp-err"></div>
        </div>
        <div class="col-sm-1">
            <label class="label-control">Discount(%)</label>
            <input type="number" class="form-control discount_percentage" min="1" max="100" name="discount_percentage[]" value="0">
            <div class="text-danger" id="discount_percentage-err"></div>
        </div>
        <div class="col-sm-1">
            <label class="label-control">Price</label>
            <input type="number" placeholder="Price" class="form-control price" readonly min="1" name="price[]" value="1">
            <div class="text-danger" id="price-err"></div>
        </div>
        <div class="col-sm-2">
            <span class="remove">Remove</span>
        </div>
    </div>
</div>

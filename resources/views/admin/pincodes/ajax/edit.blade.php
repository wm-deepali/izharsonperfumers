<div class="modal-dialog">
    <!-- Modal content-->
    <form class="form form-horizontal">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit</h4>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="label-control label">State</label>
                        <select class='form-control' name='state' id='state'>
                            <option value=''>Select</option>
                            @if (isset($states) && count($states) > 0)
                                @foreach ($states as $state)
                                    <option value='{{ $state->id }}' @if ($state->id == $pincode->state_id) selected @endif>{{ $state->name }}</option>
                                @endforeach
                            @endif
                        </select>
                        <div class="text-danger validation-err" id="state-err"></div>
                    </div>
                    <div class="col-sm-6">
                        <label class="label-control label">City</label>
                        <select class='form-control' name='city' id='city'>
                            <option value=''>Select</option>
                            @if (isset($cities) && count($cities) > 0)
                                @foreach ($cities as $city)
                                    <option value='{{ $city->id }}' @if ($city->id == $pincode->city_id) selected @endif>{{ $city->name }}</option>
                                @endforeach
                            @endif
                        </select>
                        <div class="text-danger validation-err" id="city-err"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label class="label-control label">Pincode</label>
                        <input type="text" class="form-control" placeholder="Enter PinCode" name="pincode" id="pincode" value="{{ $pincode->pincode }}">
                        <div class="text-danger validation-err" id="pincode-err"></div>
                    </div>
                </div>
                <div class="form-actions row">
                    <div class="col-sm-12 text-center">
                        <button type="button" class="btn btn-primary" id="update-pincode-btn" pincode_id="{{ $pincode->id }}">Submit</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

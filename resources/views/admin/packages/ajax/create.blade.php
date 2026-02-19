@include('admin.header')
<style type="text/css">
span.select2.select2-container.select2-container--default.select2-container--above {
    width: 250px !important;
}

span.select2.select2-container.select2-container--default {
    width: 250px !important;
}
</style>

<div class="app-content content container-fluid">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-xs-12 mb-2">
                <h3 class="content-header-title mb-0">Catalog</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-xs-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.manage-services.index') }}">Manage
                                    Service</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Basic form layout section start -->
            <section id="horizontal-form-layouts">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">ADD</h4>
                                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i> Refresh</a></li>
                                        <li><a href="javascript:history.go(-1)"><i class="fa fa-backward"></i> Go
                                                Back</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body collapse in">
                                <div class="col-xl-6 col-lg-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-block">
                                                <form>
                                                    <!--<ul class="nav nav-tabs nav-top-border no-hover-bg nav-justified">-->
                                                    <!--    <li class="nav-item">-->
                                                    <!--        <a class="nav-link active general-tab" id="active-tab1"-->
                                                    <!--            data-toggle="tab" href="#active1"-->
                                                    <!--            aria-controls="active1" aria-expanded="true">General</a>-->
                                                    <!--    </li>-->
                                                    <!--    <li class="nav-item">-->
                                                    <!--        <a class="nav-link option-tab" id="link-tab3"-->
                                                    <!--            data-toggle="tab" href="#link3" aria-controls="link3"-->
                                                    <!--            aria-expanded="false">Add Variants</a>-->
                                                    <!--    </li>-->

                                                        <!-- <li class="nav-item">
                                                    <!--        <a class="nav-link seo-tab" id="link-tab2" data-toggle="tab"-->
                                                    <!--            href="#link2" aria-controls="link2"-->
                                                    <!--            aria-expanded="false">SEO</a>-->
                                                    <!--    </li> -->
                                                    <!--</ul>-->
                                                    <div class="tab-content">
                                                        <div role="tabpanel" class="tab-pane fade active in"
                                                            id="active1" aria-labelledby="active-tab1"
                                                            aria-expanded="true">
                                                            <div class="form-group row">
                                                                <div class="col-sm-6">
                                                                    <label class="label-control label">Package Name
                                                                        <span class="required">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Enter Name" name="name" id="name">
                                                                    <div class="text-danger validation-err"
                                                                        id="name-err"></div>
                                                                </div>
                                                                @if($language)
                                                                <div class="col-sm-6">
                                                                    <label class="label-control label">Package Name (ar)
                                                                        <span class="required">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Enter Arabic Name" name="name_ar"
                                                                        id="name_ar">
                                                                    <div class="text-danger validation-err"
                                                                        id="name_ar-err"></div>
                                                                </div>
                                                                
                                                                @endif
                                                                
                                                             {{--    <div class="col-sm-6">
                                                                    <label class="label-control label">Currency <span
                                                                            class="required">*</span></label>
                                                                    <select class="form-control" name="currency_type"
                                                                        id="currency_type">
                                                                        <option value="SAR">SAR</option>
                                                                        <option value="USD">USD</option>
                                                                    </select>
                                                                    <div class="text-danger validation-err"
                                                                        id="currency_type-err"></div>
                                                                </div>
                                                                </div>
                                                                
                                                                --}}
                                                                <!-- <div class="col-sm-4">
                                                                    <label class="label-control label">Slug <span
                                                                            class="required">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Enter Slug" name="slug" id="slug">
                                                                    <div class="text-danger validation-err"
                                                                        id="slug-err"></div>
                                                                </div> -->
                                                                 <div class="form-group row">
                                                                  <div class="col-sm-6">
                                                                    <label class="label-control label">Time Duration (in
                                                                        Hours)<span class="required">*</span></label>
                                                                    <input type="number" class="form-control"
                                                                        placeholder="Enter Time Duration (in Hours)"
                                                                        name="service_time" id="service_time">
                                                                    <div class="text-danger validation-err"
                                                                        id="service_time-err"></div>
                                                                </div>
                                                                
                                                                <div class="col-sm-6">
                                                                    <label class="label-control label">Status <span
                                                                            class="required">*</span></label>
                                                                    <select class="form-control" name="status"
                                                                        id="status">
                                                                        <option value="active">Active</option>
                                                                        <option value="block">De-Active</option>
                                                                    </select>
                                                                    <div class="text-danger validation-err"
                                                                        id="status-err"></div>
                                                                </div>
                                                                </div>
                                                                 <div class="form-group row">
                                                                    <div class="col-md-12">
                                                                    <label class="label-control label">Upload Icon /
                                                                        Image <span class="required">*</span> <span
                                                                            class="text-danger">(Upload Icon / Image
                                                                            Size
                                                                            500*500)</span></label>
                                                                    <input type="file" class="form-control" name="image"
                                                                        id="image">
                                                                    <div class="text-danger validation-err"
                                                                        id="image-err">
                                                                    </div>
                                                                </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-md-12">
                                                                        <label class="label-control">
                                                                            Short Description* </label>
                                                                        <textarea class="form-control" cols="4" rows="3"
                                                                            placeholder="Enter Detail"
                                                                            name="short_description"
                                                                            id="short_description"></textarea>
                                                                        <div class="text-danger validation-err"
                                                                            id="short_description-err"></div>
                                                                    </div>
                                                                    </div>
                                                                      

                                                                

                                                                <!-- <div class="col-sm-4">
                                                                    <label class="label-control label">Sub Title <span
                                                                            class="required">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Enter Sub Title" name="sub_title"
                                                                        id="sub_title">
                                                                    <div class="text-danger validation-err"
                                                                        id="sub_title-err"></div>
                                                                </div> -->
                                                                @if($language)
                                                                <div class="col-sm-6">
                                                                    <label class="label-control label">Sub Title
                                                                        (ar)<span class="required">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Enter Sub Title ar"
                                                                        name="sub_title_ar" id="sub_title_ar">
                                                                    <div class="text-danger validation-err"
                                                                        id="sub_title-err"></div>
                                                                </div>
                                                                @endif

                                                               

                                                                <!-- <div class="col-sm-4">
                                                                    <label class="label-control label">Price <span
                                                                            class="required">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Enter Price" name="price"
                                                                        id="price">
                                                                    <div class="text-danger validation-err"
                                                                        id="price-err"></div>
                                                                </div> -->

                                                               

                                                                <!-- <div class="col-sm-4">
                                                                    <label class="label-control label">Discounted Price
                                                                        <span class="required">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Enter Discounted Price"
                                                                        name="discountable_price"
                                                                        id="discountable_price">
                                                                    <div class="text-danger validation-err"
                                                                        id="discountable_price-err"></div>
                                                                </div> -->
                                            {{--
                                                                <div class="col-sm-6">
                                                                    <label class="label-control label">Service Category
                                                                        <span class="required">*</span></label>
                                                                    <select id="service_category_id"
                                                                        class="form-control" name="service_category_id">
                                                                        <option value="">-- Select --</option>
                                                                        @foreach($service_cats as $obj)
                                                                        <option value="{{ $obj->id }}">{{ $obj->name }}
                                                                        </option>
                                                                        @endforeach
                                                                    </select>
                                                                    <div class="text-danger validation-err"
                                                                        id="service_category_id-err"></div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <label class="label-control label">Services <span
                                                                            class="required">*</span></label>
                                                                    <select class="form-control" name="service_id"
                                                                        id="service_id">
                                                                        <option value="0">-- Select --</option>
                                                                    </select>
                                                                    <div class="text-danger validation-err"
                                                                        id="service_id-err"></div>
                                                                </div>
                                                                
                                                                --}}
                                                                
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </form>
                                            </div>
                                        </div>
                                     </div>
                                 </div>
                                  <div class="col-xl-6 col-lg-6">
                                       <div class="card">
                                        <div class="card-body">
                                            <div class="card-block">
                                      <div class="form-group row">
                                        <div class="col-md-12">
                                            <label class="label-control">
                                                Detail Description* </label>
                                            <textarea class="form-control" cols="4" rows="2"
                                                placeholder="Detail Description"
                                                name="detail_description"
                                                id="detail_description"></textarea>
                                            <div class="text-danger validation-err"
                                                id="detail_description-err"></div>
                                        </div>
                                        </div>
                                        </div>
                                        </div>
                                    </div>
                                  </div>
                                  
                                  <div class="col-xl-12">
                                      <h3><strong>Add Variants</strong></h3>
                                      <div class="div-form">
                                        <div class="optionBox">
                                            <div class="block">
                                                <div class="form-group row after-add-more">
                                                    <div class="col-sm-2">
                                                        <label
                                                            class="label label-control">Select Car Origin</label>
                                                        <select class="form-control carorigin"
                                                            name="carorigin[]" id="carorigin">
                                                            <option value="">Select</option>
                                                            @if (isset($carorigin) &&
                                                            count($carorigin) >
                                                            0)
                                                            @foreach ($carorigin as $carorigin)
                                                            <option value="{{ $carorigin->id }}">
                                                                {{ $carorigin->title }}</option>
                                                            @endforeach
                                                            @endif
                                                        </select>
                                                        <div class="text-danger validation-err"
                                                            id="brand-err"></div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <label
                                                            class="label label-control">Select No. of Cylinders</label>
                                                        <select class="form-control cylinder"
                                                            name="cylinder[]" id="cylinder">
                                                            <option value="">Select</option>
                                                            @if (isset($cylinder) &&
                                                            count($cylinder) >
                                                            0)
                                                            @foreach ($cylinder as $cylinder)
                                                            <option value="{{ $cylinder->id }}">
                                                                {{ $cylinder->title }}</option>
                                                            @endforeach
                                                            @endif
                                                        </select>
                                                        <div class="text-danger validation-err"
                                                            id="brand-err"></div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <label
                                                            class="label label-control">Select Oil Grades</label>
                                                        <select class="form-control oilgrade"
                                                            name="oilgrade[]" id="oilgrade">
                                                            <option value="">Select</option>
                                                            @if (isset($oilgrade) &&
                                                            count($oilgrade) >
                                                            0)
                                                            @foreach ($oilgrade as $oilgrade)
                                                            <option value="{{ $oilgrade->id }}">
                                                                {{ $oilgrade->title }}</option>
                                                            @endforeach
                                                            @endif
                                                        </select>
                                                        <div class="text-danger validation-err"
                                                            id="brand-err"></div>
                                                    </div>
                                                   
                                                    <div id="contentall">

                                                        <div class="col-sm-2">
                                                            <label
                                                                class="label-control">MRP</label>
                                                            <input type="number"
                                                                placeholder="MRP"
                                                                class="form-control mrp" min="1"
                                                                name="mrp[]" value="1">
                                                            <div class="text-danger validation-err"
                                                                id="mrp-err"></div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <label
                                                                class="label-control">Discount(%)</label>
                                                            <input type="number"
                                                                class="form-control discount_percentage"
                                                                min="1" max="100"
                                                                name="discount_percentage[]"
                                                                value="0">
                                                            <div class="text-danger validation-err"
                                                                id="discount_percentage-err">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <label class="label-control">
                                                                Offered Price</label>
                                                            <input type="number"
                                                                placeholder=" Offered Price"
                                                                class="form-control price"
                                                                readonly min="1" name="price[]"
                                                                value="1">
                                                            <div class="text-danger validation-err"
                                                                id="price-err"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2 change">
                                                        <label for="">&nbsp;</label><br />
                                                        <span class="btn btn-success add-more">+
                                                            Add</span>
                                                    </div>
                                                </div>

                                                <div class="form-actions">
                                                    <button type="button"
                                                        class="btn btn-primary pull-right"
                                                        id="add-category-btn"><i
                                                            class="fa fa-check-square-o"></i> Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                   </div>
                          </div>
                    </div>
            </section>
        </div>
    </div>
</div>
@include('admin.footer')
<script>
$(document).ready(function() {

    // Department Change
    $('#service_category_id').change(function() {

        // Department id
        var id = $(this).val();

        // Empty the dropdown
        $('#service_id').find('option').not(':first').remove();

        // AJAX request
        $.ajax({
            url: `{{url('/admin/getServices/${id}')}}`,
            type: 'get',
            dataType: 'json',
            success: function(response) {
                var len = 0;
                if (response['data'] != null) {
                    len = response['data'].length;
                }

                if (len > 0) {
                    // Read data and create <option >
                    for (var i = 0; i < len; i++) {
                        var id = response['data'][i].id;
                        var name = response['data'][i].name;
                        var option = "<option value='" + id + "'>" + name + "</option>";
                        $("#service_id").append(option);
                    }
                }

            }
        });
    });
});
$(document).ready(function() {
    CKEDITOR.replace('detail_description', {
        filebrowserUploadUrl: "{{ route('admin.image-upload', ['_token' => csrf_token()]) }}",
        filebrowserUploadMethod: 'form'
    });

    $(document).on("click", ".brandmodel", function() {
        var id = $(this).val();
        let formData = new FormData();
        formData.append('id', id);
        $.ajax({
            url: "{{ URL::to('admin/carmodel') }}",
            type: 'POST',
            processData: false,
            contentType: false,
            dataType: 'json',
            data: formData,
            success: function(result) {
                $(".contentprice" + id).last(`hello`);
                $(".contentprice" + id).css('display', 'block');
            }
        })

    });
    //new code for adding - begin
    var count = 1;
    $("body").on("click", ".add-more", function() {
        count++;
        // $().find("input[type=checkbox]").attr("disabled", true );
        $(".after-add-more").last().find("select").attr("disabled", true);
        $(".after-add-more").last().find("#brand").attr("disabled", true);
        var html = $(".after-add-more").first().clone();
        $(html).find("input[type=text]").val('');
        $(html).find("input[type=number]").val('');
        $(html).find("#brandmodel").html(" ");
        // $(html).find("#contentall").html(" ");
        $(html).find("select").attr("disabled", false);
        $(html).find("#brand").attr("disabled", false);
        $(html).find("input[type=checkbox]").prop("checked", false);
        //  $(html).find(".change").prepend("<label for=''>&nbsp;</label><br/><a class='btn btn-danger remove'>- Remove</a>");
        $(html).find(".change").html(
            "<label for=''>&nbsp;</label><br/><a class='btn btn-danger remove'>- Remove</a>");
        $(".after-add-more").last().after(html);
    });
    $("body").on("click", ".remove", function() {
        count--;
        $(this).parents(".after-add-more").remove();
    });
    //end

    $(document).on("keyup change", ".mrp", function(event) {
        let mrp = $(this).val();
        $(this).closest('.form-group').find('.discount_percentage').val('0');
        $(this).closest('.form-group').find('.price').val(mrp);
    });

    $(document).on("keyup change", ".discount_percentage", function(event) {
        let discount = $(this).val();
        let mrp = $(this).closest('.form-group').find('.mrp').val();
        if (discount > 0 && discount < 100) {
            let discountedprice = parseFloat(mrp) - (mrp * discount / 100);
            $(this).closest('.form-group').find('.price').val(discountedprice);
        } else {
            $(this).val('0');
            $(this).closest('.form-group').find('.price').val(mrp);
        }
    });

    $(document).on("keyup", "#meta_title", function(event) {
        let title = $(this).val();
        $('#meta-title-limit').html(
            `We recommend title between 50–60 characters.(${title.length} character)`);
    });

    $(document).on("keyup", "#meta_description", function(event) {
        let title = $(this).val();
        $('#meta-description-limit').html(
            `We recommend descriptions between 50–160 characters.(${title.length} character)`);
    });

    $(".block").on("change", "#brand", function() {
        var brandid = $(this).val();
        var brandmodel = $(".brandmodel:checked").map(function() {
            return $(this).val();
        }).get()
        let formData = new FormData();
        formData.append('brandid', brandid);
        $(".after-add-more").last().find("#brandmodel").html("");
        $(".after-add-more").last().find("#contentall").html("");
        $.ajax({
            url: "{{ URL::to('admin/getbrandmodel') }}",
            type: 'POST',
            processData: false,
            contentType: false,
            dataType: 'json',
            data: formData,
            success: function(result) {
                console.log(result)
                if (result.length > 0) {

                    for (let i = 0; i < result.length; i++) {
                        console.log(brandmodel.indexOf(result[i]['id'].toString()) !== -1)
                        if (count == 1) {
                            // document.getElementById("brandmodel").innerHTML  +=  `<option value="${result[i]['id']}">${result[i]['name']}</option` ; 
                            $(".after-add-more").last().find("#brandmodel").append(`
                        <input class="form-control brandmodel" name="brandmodel${count}[]" type="checkbox" value="${result[i]['id']}" />${result[i]['name']}
                        `);
                        }
                        if (count != 1) {
                            if (!(brandmodel.indexOf(result[i]['id'].toString()) !== -1)) {
                                $(".after-add-more").last().find("#brandmodel").append(`
                        <input class="form-control brandmodel" name="brandmodel${count}[]" type="checkbox" value="${result[i]['id']}" />${result[i]['name']}
                        `);


                            }
                        }


                    }
                    var data =0;
                    for (let i = 0; i < result.length; i++) {
                        
                        ++data;
                        for (let x = 0; x < JSON.parse(result[i]['cylinder']).length; x++) {
                           let cylinder =JSON.parse(result[i]['cylinder_name'])[x];
                            if (count == 1) {
                                if(x==0){
                                    $(".after-add-more").last().find("#contentall").append(`
                         <div class="contentprice${result[i]['id']}" style="display:none" id="contentp">
                         <div class="col-sm-1" >
                        <label class="label-control">No of Cylinder</label>
                        <input readonly type="text" class="form-control" value="${cylinder}">
                    </div>
                         <div class="col-sm-1" >
                        <label class="label-control">MRP</label>
                        <input type="hidden" id="cylinder${count}" name="cylinder${count}[]" value="${JSON.parse(result[i]['cylinder']).length}" />
                        <input type="hidden" name="cylinders${count}[]" value="${JSON.parse(result[i]['cylinder'])[x]}" />
                        <input type="number" placeholder="MRP" class="form-control mrp" min="1" name="mrp${count}[]" value="">
                        <div class="text-danger validation-err" id="mrp-err"></div>
                    </div>
                    <div class="col-sm-1" >
                        <label class="label-control">Discount(%)</label>
                        <input type="number" class="form-control discount_percentage" min="1" max="100" name="discount_percentage${count}[]" value="0">
                        <div class="text-danger validation-err" id="discount_percentage-err"></div>
                    </div>
                    <div class="col-sm-1" >
                        <label class="label-control"> Offered Price</label>
                        <input type="number" placeholder=" Offered Price" class="form-control price" readonly min="1" name="price${count}[]" value="0">
                        <div class="text-danger validation-err" id="price-err"></div>
                    </div>
                    </div>
                    <br></br>
                    <br></br>
                        `);
                                }else{
                                $(".after-add-more").last().find("#contentall").append(`
                         <div class="contentprice${result[i]['id']}" style="display:none" id="contentp">
                         <div class="col-sm-1" >
                        <label class="label-control">No of Cylinder</label>
                        <input readonly type="text" class="form-control" value="${cylinder}">
                    </div>
                         <div class="col-sm-1" >
                        <label class="label-control">MRP</label>
                        <input type="hidden" name="cylinders${count}[]" value="${JSON.parse(result[i]['cylinder'])[x]}" />

                        <input type="number" placeholder="MRP" class="form-control mrp" min="1" name="mrp${count}[]" value="">
                        <div class="text-danger validation-err" id="mrp-err"></div>
                    </div>
                    <div class="col-sm-1" >
                        <label class="label-control">Discount(%)</label>
                        <input type="number" class="form-control discount_percentage" min="1" max="100" name="discount_percentage${count}[]" value="0">
                        <div class="text-danger validation-err" id="discount_percentage-err"></div>
                    </div>
                    <div class="col-sm-1" >
                        <label class="label-control"> Offered Price</label>
                        <input type="number" placeholder=" Offered Price" class="form-control price" readonly min="1" name="price${count}[]" value="0">
                        <div class="text-danger validation-err" id="price-err"></div>
                    </div>
                    </div>
                    <br></br>
                    <br></br>
                        `);
                                }
                            }
                            if (count != 1) {
                                if (!(brandmodel.indexOf(result[i]['id'].toString()) !== -
                                        1)) {
                                            if(x==0){
                                                $(".after-add-more").last().find("#contentall").append(`
                                <div class="contentprice${result[i]['id']}" style="display:none" id="contentp">
                                <div class="col-sm-1" >
                        <label class="label-control">No of Cylinder</label>
                        <input readonly type="text" class="form-control" value="${cylinder}">
                    </div>
                                <div class="col-sm-1">
                    
                        <label class="label-control">MRP</label>
                        <input type="hidden" name="cylinder${count}[]" value="${JSON.parse(result[i]['cylinder']).length}" />
                        <input type="hidden" name="cylinders${count}[]" value="${JSON.parse(result[i]['cylinder'])[x]}" />
                        <input type="number" placeholder="MRP" class="form-control mrp" min="1" name="mrp${count}[]" value="">
                        <div class="text-danger validation-err" id="mrp-err"></div>
                    </div>
                    <div class="col-sm-1">
                        <label class="label-control">Discount(%)</label>
                        <input type="number" class="form-control discount_percentage" min="1" max="100" name="discount_percentage${count}[]" value="0">
                        <div class="text-danger validation-err" id="discount_percentage-err"></div>
                    </div>
                    <div class="col-sm-1">
                        <label class="label-control"> Offered Price</label>
                        <input type="number" placeholder=" Offered Price" class="form-control price" readonly min="1" name="price${count}[]" value="0">
                        <div class="text-danger validation-err" id="price-err"></div>
                    </div>
                    `);
                                            }else{
                                    $(".after-add-more").last().find("#contentall").append(`
                                <div class="contentprice${result[i]['id']}" style="display:none" id="contentp">
                                <div class="col-sm-1" >
                        <label class="label-control">Cylinder</label>
                        <input readonly type="text" class="form-control" value="${cylinder}">
                        <div class="text-danger validation-err" id="discount_percentage-err"></div>
                    </div>
                                <div class="col-sm-1">
                        <label class="label-control">MRP</label>
                        <input type="hidden" name="cylinder${count}[]" value="${JSON.parse(result[i]['cylinder']).length}" />
                        <input type="hidden" name="cylinders${count}[]" value="${JSON.parse(result[i]['cylinder'])[x]}" />

                        <input type="number" placeholder="MRP" class="form-control mrp" min="1" name="mrp${count}[]" value="">
                        <div class="text-danger validation-err" id="mrp-err"></div>
                    </div>
                    <div class="col-sm-1">
                        <label class="label-control">Discount(%)</label>
                        <input type="number" class="form-control discount_percentage" min="1" max="100" name="discount_percentage${count}[]" value="0">
                        <div class="text-danger validation-err" id="discount_percentage-err"></div>
                    </div>
                    <div class="col-sm-1">
                        <label class="label-control"> Offered Price</label>
                        <input type="number" placeholder=" Offered Price" class="form-control price" readonly min="1" name="price${count}[]" value="0">
                        <div class="text-danger validation-err" id="price-err"></div>
                    </div>
                    
                        `);

                                            }
                                }
                            }


                        }
                    }
                }
            }
        });
    });
})
$(document).on('keyup', "#name", function(event) {
    let name = $(this).val();
    let slug = name.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
    $("#slug").val(slug);
})

$(document).on("keyup", "#meta_title", function(event) {
    let title = $(this).val();
    $('#meta_title-limit').html(`We recommend title between 50–60 characters.(${title.length} character)`);
});

$(document).on("keyup", "#meta_description", function(event) {
    let title = $(this).val();
    $('#meta_description-limit').html(
        `We recommend descriptions between 50–160 characters.(${title.length} character)`);
});
$(document).on("click", "#add-category-btn", function(event) {
    $(this).attr('disabled', true);
    $('.validation-err').html('');
    for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].updateElement();
        }
    let formData = new FormData();
    formData.append('service_category_id', $('#service_category_id').val());
    formData.append('service_id', $('#service_id').val());

    formData.append('name', $('#name').val());
    formData.append('name_ar', $('#name_ar').val());
    formData.append('sub_title', $('#sub_title').val());
    formData.append('sub_title_ar', $('#sub_title_ar').val());
    formData.append('currency_type', $('#currency_type').val());
    formData.append('price', $('#price').val());
    formData.append('discountable_price', $('#discountable_price').val());
    // formData.append('pkg_features', CKEDITOR.instances['pkg_features'].getData());
    formData.append('slug', $('#slug').val());
    formData.append('meta_title', $('#meta_title').val());
    formData.append('meta_keyword', $('#meta_keyword').val());
    formData.append('meta_description', $('#meta_description').val());
    formData.append('meta_title_ar', $('#meta_title_ar').val());
    formData.append('meta_keyword_ar', $('#meta_keyword_ar').val());
    formData.append('meta_description_ar', $('#meta_description_ar').val());
    formData.append('status', $('#status').val());
    formData.append('image', (typeof $('#image')[0].files[0] == 'undefined') ? '' : $('#image')[0].files[0]);
    formData.append('service_time', $('#service_time').val());
    formData.append('name_ar', $('#name_ar').val());
    formData.append('status', $('#status').val());
    formData.append('short_description', $('#short_description').val());
    formData.append('detail_description', $('#detail_description').val());
    var data = $("select[name='carorigin[]']").length;
    let variant_options = $('.block').map((e, i) => {
        // var newdata = [];
        // var mrpdata = [];
        // var discountdata = [];
        // var pricedata = [];
        // var cylinderdata = [];
        // var cylindersdata = [];
        // for (i = 1; i <= data; i++) {
        //     // var cylinderdata = $("input[name='cylinder"+i+"[]']").val();
        //     // var cylinderdata = $("input[name='cylinder"+i+"[]']").val();
        //     // console.log(cylinderdata);
        //     newdata.push($("input[name='brandmodel"+i+"[]']:checked").map(function() {
        //         return $(this).val();
        //     }).get());
        //     cylinderdata.push($("input[name='cylinder"+i+"[]']").map(function() {
        //         return $(this).val();
        //     }).get());
        //     cylindersdata.push($("input[name='cylinders"+i+"[]']").map(function() {
        //         return $(this).val();
        //     }).get());
        //     mrpdata.push($("input[name='mrp"+ i+"[]']").map(function() {
        //         return $(this).val();
        //     }).get());
        //     discountdata.push($("input[name='discount_percentage"+i+"[]']").map(function() {
        //         return $(this).val();
        //     }).get());
        //     pricedata.push($("input[name='price"+i+"[]']").map(function() {
        //         return $(this).val();
        //     }).get());
         
           
        // }
        return {
            carorigin: $("select[name='carorigin[]']").map(function() {
                return $(this).val();
            }).get(),
            cylinder: $("select[name='cylinder[]']").map(function() {
                return $(this).val();
            }).get(),
            mrp: $("input[name='mrp[]']").map(function() {
                return $(this).val();
            }).get(),
            discount_percentage: $("input[name='discount_percentage[]']").map(function() {
                return $(this).val();
            }).get(),
            price: $("input[name='price[]']").map(function() {
                return $(this).val();
            }).get(),
            oilgrade:$("select[name='oilgrade[]']").map(function() {
                return $(this).val();
            }).get(),
        }
        data--;
    }).toArray();
    formData.append('variant_options', JSON.stringify(variant_options));
    $.ajax({
        url: "{{ URL::to('admin/manage-packages') }}",
        type: 'POST',
        processData: false,
        contentType: false,
        dataType: 'json',
        data: formData,
        context: this,
        success: function(result) {
            if (result.success) {
                window.location = "{{ URL::to('admin/manage-packages') }}";
            } else {
                $(this).attr('disabled', false);
                if (result.code == 422) {
                    for (const key in result.errors) {
                        $(`#${key}-err`).html(result.errors[key][0]);
                    }
                } else {
                    console.log(result);
                }
            }
        }
    });
});
</script>
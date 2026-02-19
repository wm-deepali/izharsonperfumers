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
                            <div class="card-body collapse in row">
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
                                                                    <label class="label-control label">Service
                                                                        Category <span class="required">*</span></label>
                                                                    <select id="service_category_id"
                                                                        class="form-control">
                                                                        <option value="">-- Select --</option>
                                                                        @foreach($service_cats as $obj)
                                                                        <option value="{{ $obj->id }}">
                                                                            {{ $obj->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <div class="text-danger validation-err"
                                                                        id="service_category_id-err"></div>
                                                                </div>

                                                                <div class="col-sm-6">
                                                                    <label class="label-control label">Service Name
                                                                        <span class="required">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Enter Service Name" name="name" id="name">
                                                                    <div class="text-danger validation-err"
                                                                        id="name-err"></div>
                                                                </div>
                                                                @if($language)

                                                                <div class="col-sm-6">
                                                                    <label class="label-control label">Service Name
                                                                        (ar)<span class="required">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Enter Service Name Arabic" name="name_ar"
                                                                        id="name_ar">
                                                                    <div class="text-danger validation-err"
                                                                        id="name_ar-err"></div>
                                                                </div>
                                                                @endif
                                                            </div>
                                                            <div class="form-group row">
                                                             <div class="col-sm-6">
                                                                    <label class="label-control label">Time Duration (in Hours)<span class="required">*</span></label>
                                                                    <input type="number" class="form-control"
                                                                        placeholder="Enter Time Duration (in Hours)" name="service_time"
                                                                        id="service_time">
                                                                    <div class="text-danger validation-err"
                                                                        id="service_time-err"></div>
                                                                </div>
                                                                
                                                           <div class="col-sm-6">
                                                                <label class="label-control label">Status <span
                                                                        class="required">*</span></label>
                                                                <select class="form-control" name="status" id="status">
                                                                    <option value="active">Active</option>
                                                                    <option value="block">De-Active</option>
                                                                </select>
                                                                <div class="text-danger validation-err" id="status-err">
                                                                </div>
                                                            </div>
                                                           
                                                           </div>
                                                             <div class="form-group row">
                                                              <div class="col-md-12">
                                                                <label class="label-control label">Upload Icon / Image <span
                                                                        class="required">*</span> <span
                                                                        class="text-danger">(Upload Icon / Image Size
                                                                        500*500)</span></label>
                                                                 <input type="file" class="form-control" name="image"
                                                                    id="image">
                                                                <div class="text-danger validation-err" id="image-err">
                                                                </div>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        <div role="tabpanel" class="tab-pane fade" id="link3"
                                                        aria-labelledby="active-tab3" aria-expanded="true">
                                                        
                                                    </div>
                                                   
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                  <div class="col-xl-6 col-lg-6 pt-2">
                                      <div class="form-group row">
                                        <div class="col-md-12">
                                            <label class="label-control">
                                            Service Description* </label>
                                            <textarea class="form-control" cols="4" rows="2"
                                                placeholder="Enter Detail"
                                                name="Service Description"
                                                id="description"></textarea>
                                            <div class="text-danger validation-err"
                                                id="description-err"></div>
                                        </div>
                                    </div>
                                    @if($language)
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <label class="label-control">
                                            Service Description Ar </label>
                                            <textarea class="form-control" cols="4" rows="2"
                                                placeholder="Enter Detail"
                                                name="description_ar"
                                                id="description_ar"></textarea>
                                            <div class="text-danger validation-err"
                                                id="short_description_ar-err"></div>
                                        </div>
                                    </div>
                                    @endif
                              </div>
                              
                              <div class="col-lg-12">
                                  <h3><strong>Add Variants</strong></h3>
                                  <div class="div-form"> 
                                        <div class="optionBox">
                                            <div class="block">
                                                <div class="form-group row after-add-more">
                                                    <div class="col-sm-2">
                                                        <label class="label label-control">Select
                                                            Car
                                                            Make </label>
                                                        <select class="form-control brand"
                                                            name="brand[]" id="brand">
                                                            <option value="">Select</option>
                                                            @if (isset($brands) && count($brands) >
                                                            0)
                                                            @foreach ($brands as $brand)
                                                            <option value="{{ $brand->id }}">
                                                                {{ $brand->name }}</option>
                                                            @endforeach
                                                            @endif
                                                        </select>
                                                        <div class="text-danger validation-err"
                                                            id="brand-err"></div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label class="label label-control">Select
                                                            Car
                                                            Model</label>
                                                        <!--<input type="checkbox" id="ckbCheckAll" />Select All-->
                                                        <div id="brandmodel">
                                                        </div>
                                                        <div class="text-danger validation-err"
                                                            id="brand-err"></div>
                                                    </div>
                                                     <div class="col-sm-6">
                                                    <div id="contentall">
                                                       <div class="row">
                                                        <div class="col-sm-3">
                                                            <label class="label-control">MRP</label>
                                                            <input type="number" placeholder="MRP"
                                                                class="form-control mrp" min="1"
                                                                name="mrp[]" value="1">
                                                            <div class="text-danger validation-err"
                                                                id="mrp-err"></div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <label
                                                                class="label-control">Discount(%)</label>
                                                            <input type="number"
                                                                class="form-control discount_percentage"
                                                                min="1" max="100"
                                                                name="discount_percentage[]"
                                                                value="0">
                                                            <div class="text-danger validation-err"
                                                                id="discount_percentage-err"></div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <label
                                                                class="label-control"> Offered Price</label>
                                                            <input type="number" placeholder=" Offered Price"
                                                                class="form-control price" readonly
                                                                min="1" name="price[]" value="1">
                                                            <div class="text-danger validation-err"
                                                                id="price-err"></div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                     <div class="row">
                                                    <div class="col-sm-2 change">
                                                        <label for="">&nbsp;</label><br />
                                                        <span class="btn btn-success add-more">+
                                                            Add</span>
                                                    </div>
                                                    </div>
                                                </div>

                                                
                                            </div>
                                            <div class="form-actions">
                                                        <button type="button" class="btn btn-primary pull-right" id="add-category-btn"><i class="fa fa-check-square-o"></i>Submit</button>
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
    CKEDITOR.replace('description', {
        filebrowserUploadUrl: "{{ route('admin.image-upload', ['_token' => csrf_token()]) }}",
        filebrowserUploadMethod: 'form'
    });
    
     $(document).on("click",".brandmodel",function(){
            var id = $(this).val();
            $(".contentprice"+id).css('display','block');
        });
     //new code for adding - begin
    var count =1;
        $("body").on("click",".add-more",function(){
            count++;
            // $().find("input[type=checkbox]").attr("disabled", true );
            $(".after-add-more").last().find("input[type=checkbox]").attr("disabled", true );
            $(".after-add-more").last().find("#brand").attr("disabled", true );
            var html = $(".after-add-more").first().clone();
            $(html).find("input[type=text]").val('');
            $(html).find("input[type=number]").val('');
            $(html).find("#brandmodel").html(" ");
            $(html).find("#contentall").html(" ");
            $(html).find("input[type=checkbox]").attr("disabled", false );
            $(html).find("#brand").attr("disabled", false );
            $(html).find("input[type=checkbox]").prop("checked", false );
            //  $(html).find(".change").prepend("<label for=''>&nbsp;</label><br/><a class='btn btn-danger remove'>- Remove</a>");
              $(html).find(".change").html("<label for=''>&nbsp;</label><br/><a class='btn btn-danger remove'>- Remove</a>");
            $(".after-add-more").last().after(html);
        });
        $("body").on("click",".remove",function(){
            count--;
            $(this).parents(".after-add-more").remove();
        });
        //end
        
         $(document).on("keyup change", ".mrp", function(event) {
            let mrp = $(this).val();
            $(this).closest('.form-group #contentall #contentp').find('.discount_percentage').val('0');
            $(this).closest('.form-group #contentall #contentp').find('.price').val(mrp);
        });

        $(document).on("keyup change", ".discount_percentage", function(event) {
            let discount = $(this).val();
            let mrp = $(this).closest('.form-group #contentall #contentp').find('.mrp').val();
            if (discount > 0 && discount < 100) {
                let discountedprice = parseFloat(mrp) - (mrp * discount / 100);
                $(this).closest('.form-group #contentall #contentp').find('.price').val(discountedprice);
            } else {
                $(this).val('0');
                $(this).closest('.form-group #contentall #contentp').find('.price').val(mrp);
            }
        });
        
        $(document).on("keyup", "#meta_title", function(event) {
            let title = $(this).val();
            $('#meta-title-limit').html(`We recommend title between 50–60 characters.(${title.length} character)`);
        });

        $(document).on("keyup", "#meta_description", function(event) {
            let title = $(this).val();
            $('#meta-description-limit').html(`We recommend descriptions between 50–160 characters.(${title.length} character)`);
        });
        
    $(".block").on("change", "#brand", function() {
            var brandid = $(this).val();
            var brandmodel = $(".brandmodel:checked").map(function(){return $(this).val();}).get()
            console.log(brandmodel)
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
                success:function(result){
                    
                   if(result.length>0){
                    for (let i =0;i<result.length;i++){
                        console.log(brandmodel.indexOf(result[i]['id'].toString()) !== -1)
                        if(count==1){
                        // document.getElementById("brandmodel").innerHTML  +=  `<option value="${result[i]['id']}">${result[i]['name']}</option` ; 
                        $(".after-add-more").last().find("#brandmodel").append(`
                        <input class="form-control brandmodel" name="brandmodel${count}[]" type="checkbox" value="${result[i]['id']}" />${result[i]['name']}
                        `);
                        }
                        if(count !=1){
                            if(!(brandmodel.indexOf(result[i]['id'].toString()) !== -1)){
                                $(".after-add-more").last().find("#brandmodel").append(`
                        <input class="form-control brandmodel" name="brandmodel${count}[]" type="checkbox" value="${result[i]['id']}" />${result[i]['name']}
                        `);
                          
                           
                        }
                        }
                        
                        
                    }
                    for (let i =0;i<result.length;i++){
                        if(count==1){
                        // document.getElementById("brandmodel").innerHTML  +=  `<option value="${result[i]['id']}">${result[i]['name']}</option` ; 
                        $(".after-add-more").last().find("#contentall").append(`
                         <div class="contentprice${result[i]['id']}" style="display:none" id="contentp">
                         <div class="row">
                        <div class="col-sm-3">
                        <label class="label-control">MRP</label>
                        <input type="number" placeholder="MRP" class="form-control mrp" min="1" name="mrp${count}[]" value="1">
                        <div class="text-danger validation-err" id="mrp-err"></div>
                    </div>
                    <div class="col-sm-3" >
                        <label class="label-control">Discount(%)</label>
                        <input type="number" class="form-control discount_percentage" min="1" max="100" name="discount_percentage${count}[]" value="0">
                        <div class="text-danger validation-err" id="discount_percentage-err"></div>
                    </div>
                    <div class="col-sm-3" >
                        <label class="label-control"> Offered Price</label>
                        <input type="number" placeholder=" Offered Price" class="form-control price" readonly min="1" name="price${count}[]" value="1">
                        <div class="text-danger validation-err" id="price-err"></div>
                    </div>
                    </div>
                    </div>
                        `);
                        }
                        if(count !=1){
                            if(!(brandmodel.indexOf(result[i]['id'].toString()) !== -1)){
                                $(".after-add-more").last().find("#contentall").append(`
                                <div class="contentprice${result[i]['id']}" style="display:none" id="contentp">
                                <div class="row">
                    <div class="col-sm-3">
                        <label class="label-control">MRP</label>
                        <input type="number" placeholder="MRP" class="form-control mrp" min="1" name="mrp${count}[]" value="1">
                        <div class="text-danger validation-err" id="mrp-err"></div>
                    </div>
                    <div class="col-sm-3">
                        <label class="label-control">Discount(%)</label>
                        <input type="number" class="form-control discount_percentage" min="1" max="100" name="discount_percentage${count}[]" value="0">
                        <div class="text-danger validation-err" id="discount_percentage-err"></div>
                    </div>
                    <div class="col-sm-3">
                        <label class="label-control"> Offered Price</label>
                        <input type="number" placeholder=" Offered Price" class="form-control price" readonly min="1" name="price${count}[]" value="1">
                        <div class="text-danger validation-err" id="price-err"></div>
                    </div>
                    </div>
                    
                        `);
                          
                           
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
    let formData = new FormData();
    formData.append('name', $('#name').val());
    formData.append('service_time', $('#service_time').val());
    formData.append('name_ar', $('#name_ar').val());
    formData.append('service_category_id', $('#service_category_id').val());
    formData.append('status', $('#status').val());
    formData.append('image', (typeof $('#image')[0].files[0] == 'undefined') ? '' : $('#image')[0].files[0]);
     var data = $("select[name='brand[]']").length;
            let variant_options = $('.block').map((e,i)=> {
                var newdata = [];
                var mrpdata = [];
                var discountdata = [];
                var pricedata = [];
                for(i=1;i<=data;i++){
                    newdata.push($("input[name='brandmodel"+i+"[]']:checked").map(function(){return $(this).val();}).get());
                    mrpdata.push($("input[name='mrp"+i+"[]']").map(function(){return $(this).val();}).get());
                    discountdata.push($("input[name='discount_percentage"+i+"[]']").map(function(){return $(this).val();}).get());
                    pricedata.push($("input[name='price"+i+"[]']").map(function(){return $(this).val();}).get());
                    }
                return {
                    brand: $("select[name='brand[]']").map(function(){return $(this).val();}).get(),
                    brandmodel:newdata,
                    mrp: mrpdata,
                    discount_percentage: discountdata,
                    price: pricedata,
                }
                data--;
            }).toArray();
            formData.append('variant_options', JSON.stringify(variant_options));
    $.ajax({
        url: "{{ URL::to('admin/manage-services') }}",
        type: 'POST',
        processData: false,
        contentType: false,
        dataType: 'json',
        data: formData,
        context: this,
        success: function(result) {
            if (result.success) {
                 window.location = "{{ URL::to('admin/manage-services') }}";
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
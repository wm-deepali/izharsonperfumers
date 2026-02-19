@include('admin.header')
<div class="app-content content container-fluid">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-xs-12 mb-2">
                <h3 class="content-header-title mb-0">Catalog</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-xs-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.manage-services.index') }}">Manage Services</a></li>
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
                                <h4 class="card-title">Edit</h4>
                                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i> Refresh</a></li>
                                        <li><a href="javascript:history.go(-1)"><i class="fa fa-backward"></i> Go Back</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body collapse in">
                                <div class="col-xl-12 col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-block">
                                                <form>
                                                    <ul class="nav nav-tabs nav-top-border no-hover-bg nav-justified">
                                                        <li class="nav-item">
                                                            <a class="nav-link active general-tab" id="active-tab1" data-toggle="tab" href="#active1" aria-controls="active1" aria-expanded="true">General</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link option-tab" id="link-tab3" data-toggle="tab" href="#link3" aria-controls="link3" aria-expanded="false">Edit Variants</a>
                                                        </li>

                                                        
                                                    </ul>
                                                    <div class="tab-content px-1 pt-1">
                                                        <div role="tabpanel" class="tab-pane fade active in"
                                                            id="active1" aria-labelledby="active-tab1"
                                                            aria-expanded="true">
                                                            <div class="form-group row">

                                                                <div class="col-sm-4">
                                                                    <label class="label-control label">Service
                                                                        Category <span class="required">*</span></label>
                                                                    <select id="service_category_id" name="service_category_id"
                                                                        class="form-control">
                                                                        <option value="">-- Select --</option>
                                                                         @foreach($service_cats as $obj)
                                <option                                 value="{{ $obj->id }}" {{ $service->service_category_id == $obj->id ? 'selected' : ''}}>{{ $obj->name }}</option>
                            @endforeach
                                                                    </select>
                                                                    <div class="text-danger validation-err"
                                                                        id="service_category_id-err"></div>
                                                                </div>

                                                                <div class="col-sm-4">
                                                                    <label class="label-control label">Service Name
                                                                        <span class="required">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Enter Service Name" name="name" id="name"  value="{{ $service->name }}">
                                                                    <div class="text-danger validation-err"
                                                                        id="name-err"></div>
                                                                </div>
                                                                @if($language)

                                                                <div class="col-sm-4">
                                                                    <label class="label-control label">Service Name
                                                                        (ar)<span class="required">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        placeholder="Enter Service Name Ar" name="name_ar" value="{{ $service->name_ar }}"
                                                                        id="name_ar">
                                                                    <div class="text-danger validation-err"
                                                                        id="name_ar-err"></div>
                                                                </div>
                                                                @endif
                                                                <div class="col-sm-4">
                                                                    <label class="label-control label">Time Duration (in Hours)<span class="required">*</span></label>
                                                                    <input type="number" class="form-control"
                                                                        placeholder="Enter Time Duration (in Hours)" name="service_time" value="{{ $service->service_time }}"
                                                                        id="service_time">
                                                                    <div class="text-danger validation-err"
                                                                        id="service_time-err"></div>
                                                                </div>
                                                                
                                                                <div class="form-group row">
                                                                    <div class="col-md-12">
                                                                        <label class="label-control">
                                                                        Service Description* </label>
                                                                        <textarea class="form-control" cols="4" rows="2"
                                                                            placeholder="Enter Detail"
                                                                            name="description"
                                                                            id="description">{{$service->description}}</textarea>
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
                                                                            id="description_ar">{{$service->description_ar}}</textarea>
                                                                        <div class="text-danger validation-err"
                                                                            id="short_description_ar-err"></div>
                                                                    </div>
                                                                </div>
                                                                @endif
                                                            </div>
                                                           

                                                            <div class="col-md-4">
                                                                <label class="label-control label"> Upload icon / Image <span
                                                                        class="required">*</span> <span
                                                                        class="text-danger">( Upload icon / Image Size
                                                                        500*500)</span></label>
                                                                <input type="file" class="form-control" name="image"
                                                                    id="image">
                                                                <div class="text-danger validation-err" id="image-err">
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-4">
                                                                <label class="label-control label">Status <span
                                                                        class="required">*</span></label>
                                                                <select class="form-control" name="status" id="status">
                                                                    <option value="active" @if ($service->status == 'active') selected @endif>Active</option>
                                                                    <option value="block" @if ($service->status == 'block') selected @endif>De-Active</option>
                                                                </select>
                                                                <div class="text-danger validation-err" id="status-err">
                                                                </div>
                                                            </div>

                                                        </div>

<!-- Start Variant Add Section -->

                                <div role="tabpanel" class="tab-pane fade" id="link3" aria-labelledby="active-tab3" aria-expanded="true">
                                                            <div class="div-form">
                                                               
                                                                <div class="optionBox">



                                                                        @if (isset($service->service_options) && count($service->service_options) > 0)
                                                                        @foreach ($service->service_options as $key=> $service_option)
                                                                    @php $key = $key+1 @endphp
                                                                <div class="block">
                                                                      <input type="hidden"  name="variantId" value="{{$service_option->id}}">
                                                                        <div class="form-group row  after-add-more">

                                                                            <div class="col-md-2">
                                                                                <label class="label-control">Select Car Make </label>
                                                                                <select class="form-control brand" name="brand[]" id="brand" disabled>
                                                                                    <option value="" selected>Select</option>
                                                                                    @if (isset($brands) && count($brands) > 0)
                                                                                        @foreach ($brands as $brand)
                                                                                            <option value="{{ $brand->id }}" @if ($brand->id == $service_option->brand_id) selected @endif>{{ $brand->name }}</option>
                                                                                        @endforeach
                                                                                    @endif
                                                                                </select>
                                                                                <div class="text-danger validation-err" id="brand-err"></div>
                                                                            </div>
                                                                            <div class="col-sm-4">
                                                                                <label class="label label-control">Select Car Model</label>
                                                                                <!--<input type="checkbox" id="ckbCheckAll" checked disabled />Select All-->
                                                                                <div id="brandmodel">
                                                                               
                                                                                    @php
                                                                                    $brandmodels = \App\Models\BrandModel::where('id',$service_option->brandmodel_id)->get();
                                                                                    @endphp
                                                                                    @foreach($brandmodels as $brandmodel)
                                                                                    <input  class="form-control brandmodel" name="brandmodel{{$key}}[]" type="checkbox" value="{{$brandmodel->id}}" checked disabled >{{$brandmodel->name}}
                                                                                    @endforeach
                                                    
                                                                                    </div>
                                                                               
                                                                                <div class="text-danger validation-err" id="brandmodel-err"></div>
                                                                            </div>
                                                                            

                                                                            <div id="contentall">
                                                                                <div id="contentp">
                                                                                    <div class="col-sm-1">
                                                                                        <label class="label-control">MRP</label>
                                                                                        <input type="number" placeholder="MRP" class="form-control mrp" min="1" name="mrp{{$key}}[]" value="{{ $service_option->mrp }}">
                                                                                        <div class="text-danger validation-err" id="mrp-err"></div>
                                                                                    </div>
                                                                                    <div class="col-sm-1">
                                                                                        <label class="label-control">Discount(%)</label>
                                                                                        <input type="number" class="form-control discount_percentage" min="1" max="100" name="discount_percentage{{$key}}[]" value="{{ $service_option->discount_percentage }}">
                                                                                        <div class="text-danger validation-err" id="discount_percentage-err"></div>
                                                                                    </div>
                                                                                    <div class="col-sm-1">
                                                                                        <label class="label-control">Price</label>
                                                                                        <input type="number" placeholder="Price" class="form-control price" readonly min="1" name="price{{$key}}[]" value="{{ $service_option->price }}">
                                                                                        <div class="text-danger validation-err" id="price-err"></div>
                                                                                    </div>
                                                                                    </div>
                                                                                        </div>

                                                            @if($loop->iteration == 1)
                                                                <div class="col-sm-2 change">
                                                                    <label for="">&nbsp;</label><br />
                                                                    <span class="btn btn-success add-more">+ Add</span>
                                                                </div>
                                                            @else
                                                                <div class="col-sm-2 change">
                                                                    <label for=''>&nbsp;</label><br /><a class='btn btn-danger remove'>- Remove</a>
                                                                </div>
                                                            @endif

                                                        <!--     <div class="col-sm-1">-->
                                                        <!--           <span class="checkbox">-->
                                                        <!--     <input name='id[]' type="checkbox" id="checkItem" value="{{$service_option->id}}">-->
                                                        <!--</span>-->


                                                        <!--     </div>-->


                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                    @endif

                                                                  <!--   </form>
 -->

                                                                </div>
                                                            </div>
                                                        </div>
                    <!--- End Variant Add SEction -->


                    <div class="form-actions">
                        <button type="button" class="btn btn-primary pull-right" id="update-product-btn" product_id="{{$service->id}}"><i class="fa fa-check-square-o"></i>Update</button>
                    </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
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
        CKEDITOR.replace('description', {
            filebrowserUploadUrl: "{{ route('admin.image-upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form'
        });

        CKEDITOR.replace('additional_information', {
            filebrowserUploadUrl: "{{ route('admin.image-upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form'
        });

        CKEDITOR.replace('shipping_information', {
            filebrowserUploadUrl: "{{ route('admin.image-upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form'
        });

        CKEDITOR.replace('content');

        // $(document).on("keyup change", ".mrp", function(event) {
        //     let mrp = $(this).val();
        //     $(this).closest('.form-group').find('.discount_percentage').val('0');
        //     $(this).closest('.form-group').find('.price').val(mrp);
        // });

        // $(document).on("keyup change", ".discount_percentage", function(event) {
        //     let discount = $(this).val();
        //     let mrp = $(this).closest('.form-group').find('.mrp').val();
        //     if (discount > 0 && discount < 100) {
        //         let discountedprice = parseFloat(mrp) - (mrp * discount / 100);
        //         $(this).closest('.form-group').find('.price').val(discountedprice);
        //     } else {
        //         $(this).val('0');
        //         $(this).closest('.form-group').find('.price').val(mrp);
        //     }
        // });
        
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
        $(document).ready(function(){
    $("#category").change(function(){
        var data = $(this).val();
        let formData = new FormData();
        formData.append('id',data);
        $("#subcategory_id").html("");
        $.ajax({
            url: `{{ URL::to('admin/fetch-subcategory-by-category') }}`,
                type: 'POST',
                processData: false,
                contentType: false,
                dataType: 'json',
                data: formData,
                context: this,
                success: function(result) {
                    console.log(result);
                    var data = result.length
                    var html="";
                    for(let x=0;x<data;x++){
                            $("#subcategory_id").append(`<option value="${result[x]['id']}">${result[x]['name']}</option>`);
                    }
                }

        })
    })
})
        // $('#brand').select2();
        // $('#category').select2();

        $(document).on('click', '.attribute_options', function(event) {
            $('#attribute_options-err').html('');
            let attribute_options = $(".attribute_options:checked").map(function() {
                return $(this).val();
            }).toArray();
            let formData = new FormData();
            formData.append('attribute_options', attribute_options);
            $.ajax({
                url: `{{ URL::to('admin/fetch-childs-by-attributes') }}`,
                type: 'POST',
                processData: false,
                contentType: false,
                dataType: 'json',
                data: formData,
                context: this,
                success: function(result) {
                    if (result.success) {
                        $(".attribute_name_1").html(`Choose ${result.attribute_name_1}`);
                        $(".attribute_1").html(result.attribute_1_childs);
                        $(".attribute_name_2").html(`Choose ${result.attribute_name_2}`);
                        $(".attribute_2").html(result.attribute_2_childs);
                    } else {
                        if (result.code == 422) {
                            for (const key in result.errors) {
                                $(`#${key}-err`).html(result.errors[key][0]);
                            }
                        } else {

                        }
                    }
                }
            })
        });

        // $(document).on("click", ".add", function(event) {
        //     $('#attribute_options-err').html('');
        //     let attribute_options = $(".attribute_options:checked").map(function() {
        //         return $(this).val();
        //     }).toArray();
        //     let formData = new FormData();
        //     formData.append('attribute_options', attribute_options);
        //     $.ajax({
        //         url: "{{ URL::to('admin/generate-product-row-by-attributes') }}",
        //         type: 'POST',
        //         processData: false,
        //         contentType: false,
        //         dataType: 'json',
        //         data: formData,
        //         context: this,
        //         success: function(result) {
        //             if (result.success) {
        //                 $('.block:last').after(result.html);
        //             }
        //         }
        //     })
        // });

        // $('.optionBox').on('click', '.remove', function() {
        //     $(this).parent().parent().remove();
        // });

       //new code for adding - begin
    //    $("body").on("click",".add-more",function(){
    //         var html = $(".after-add-more").first().clone();
    //         $(html).find("input[type=text]").val('');
    //         $(html).find("input[type=number]").val('');
    //         $(html).find("select").val('');
    //         //  $(html).find(".change").prepend("<label for=''>&nbsp;</label><br/><a class='btn btn-danger remove'>- Remove</a>");
    //           $(html).find(".change").html("<label for=''>&nbsp;</label><br/><a class='btn btn-danger remove'>- Remove</a>");
    //         $(".after-add-more").last().after(html);
    //     });
    //     $("body").on("click",".remove",function(){
    //         $(this).parents(".after-add-more").remove();
    //     });
    //     //end


        $(document).on("click", "#update-product-btn", function(event) {
            $(this).attr('disabled', true);
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
            $(".validation-err").html("");
            let formData = new FormData();
            formData.append('_method', 'PUT');
            formData.append('category', $(".category").map(function() {
                return $(this).val();
            }).toArray());
            let attribute_options = $(".attribute_options:checked").map(function() {
                return $(this).val();
            }).toArray();
            formData.append('name', $('#name').val());
    formData.append('name_ar', $('#name_ar').val());
    formData.append('slug', $('#slug').val());
    formData.append('service_time', $('#service_time').val());
    formData.append('service_category_id', $('#service_category_id').val());
    formData.append('description', $('#description').val());
    formData.append('description_ar', $('#description_ar').val());
    formData.append('status', $('#status').val());
    formData.append('image', (typeof $('#image')[0].files[0] == 'undefined') ? '' : $('#image')[0].files[0]);
    formData.append('other_service', $('#other_service').prop('checked') == true ? 1 : 0);
    formData.append('value_added_service', $('#value_added_service').prop('checked') == true ? 1 : 0);
             var data = $("select[name='brand[]']").length;
            let variant_options = $('.block').map((e,i)=> {
                var newdata = [];
                // var stockdata = [];
                var mrpdata = [];
                var discountdata = [];
                var pricedata = [];
                for(i=1;i<=data;i++){
                    newdata.push($("input[name='brandmodel"+i+"[]']:checked").map(function(){return $(this).val();}).get());
                    // stockdata.push($("input[name='stock"+i+"[]']").map(function(){return $(this).val();}).get());
                    mrpdata.push($("input[name='mrp"+i+"[]']").map(function(){return $(this).val();}).get());
                    discountdata.push($("input[name='discount_percentage"+i+"[]']").map(function(){return $(this).val();}).get());
                    pricedata.push($("input[name='price"+i+"[]']").map(function(){return $(this).val();}).get());
                    }
                return {
                    brand: $("select[name='brand[]']").map(function(){return $(this).val();}).get(),
                    brandmodel:newdata,
                    category: $("select[name='category[]']").map(function(){return $(this).val();}).get(),
                    // stock: stockdata,
                    mrp: mrpdata,
                    discount_percentage: discountdata,
                    price: pricedata,
                }
                data--;
            }).toArray();
            formData.append('variant_options', JSON.stringify(variant_options));
            formData.append('description', $('#description').val());
            let product_id = $(this).attr('product_id');
            $.ajax({
                url: `{{ URL::to('admin/manage-services/${product_id}') }}`,
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
                            $("#validation-err").html("Fill all required fields");
                        } else {
                            console.log(result);
                        }
                    }
                }
            });
        });
    });


function deleteVariantOption(id) {
      Swal.fire({
            title: 'Are you sure?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
            $.ajax({
               type: 'DELETE',
              url: `{{ URL::to('admin/product-variant-option/${id}') }}`,
               dataType: 'json',
               data: {id:id,"_token": "{{ csrf_token() }}"},
           success: function(result) {
                        if (result.success) {
                            Swal.fire(
                                'Deleted!',
                                'success'
                            );
                            setTimeout(function() {
                                location.reload();
                            }, 400);
                        } else {
                            Swal.fire(result.msgText);
                        }
                    }
                });

            }
        })
    };

    
        //new code for adding - begin
        var count =1;
        $("body").on("click",".add-more",function(){
            count++;
            $(".after-add-more").last().find("input[type=checkbox]").attr("disabled", true );
            var html = $(".after-add-more").first().clone();
            $(html).find("input[type=text]").val('');
            $(html).find("input[type=number]").val('');
            $(html).find("#brandmodel").html(" ");
            $(html).find("#contentall").html(" ");
            $(html).find("#brand").attr("disabled", false );
            $(html).find("input[type=checkbox]").attr("disabled", false );
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
    $(".block").on("change", "#brand", function() {
            var brandid = $(this).val();
            var brandmodel = $(".brandmodel:checked").map(function(){return $(this).val();}).get()
            console.log(brandmodel)
	        let formData = new FormData();
	        formData.append('brandid', brandid);
            $(".after-add-more").last().find("#brandmodel").html("");
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
                            console.log(6)
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
                    <div class="col-sm-1" >
                        <label class="label-control">MRP</label>
                        <input type="number" placeholder="MRP" class="form-control mrp" min="1" name="mrp${count}[]" value="1">
                        <div class="text-danger validation-err" id="mrp-err"></div>
                    </div>
                    <div class="col-sm-1" >
                        <label class="label-control">Discount(%)</label>
                        <input type="number" class="form-control discount_percentage" min="1" max="100" name="discount_percentage${count}[]" value="0">
                        <div class="text-danger validation-err" id="discount_percentage-err"></div>
                    </div>
                    <div class="col-sm-1" >
                        <label class="label-control">Price</label>
                        <input type="number" placeholder="Price" class="form-control price" readonly min="1" name="price${count}[]" value="1">
                        <div class="text-danger validation-err" id="price-err"></div>
                    </div>
                    </div>
                    <br></br>
                    <br></br>
                        `);
                        }
                        if(count !=1){
                            if(!(brandmodel.indexOf(result[i]['id'].toString()) !== -1)){
                                $(".after-add-more").last().find("#contentall").append(`
                                <div class="contentprice${result[i]['id']}" style="display:none" id="contentp">
                    <div class="col-sm-1">
                        <label class="label-control">MRP</label>
                        <input type="number" placeholder="MRP" class="form-control mrp" min="1" name="mrp${count}[]" value="1">
                        <div class="text-danger validation-err" id="mrp-err"></div>
                    </div>
                    <div class="col-sm-1">
                        <label class="label-control">Discount(%)</label>
                        <input type="number" class="form-control discount_percentage" min="1" max="100" name="discount_percentage${count}[]" value="0">
                        <div class="text-danger validation-err" id="discount_percentage-err"></div>
                    </div>
                    <div class="col-sm-1">
                        <label class="label-control">Price</label>
                        <input type="number" placeholder="Price" class="form-control price" readonly min="1" name="price${count}[]" value="1">
                        <div class="text-danger validation-err" id="price-err"></div>
                    </div>
                    
                        `);
                          
                           
                        }
                        }
                        
                        
                    }
                   }
                }
        });
    });
    
    $(document).ready(function(){
        $(".block").on("click", "#ckbCheckAll", function() { 
            
            $(".after-add-more").last().find("#brandmodel .brandmodel").prop('checked', $(this).prop('checked'));
            
        });
        
         $(document).on("click",".brandmodel",function(){
            var id = $(this).val();
            $(".contentprice"+id).css('display','block');
        });
    })
</script>

@include('admin.header')
<div class="app-content content container-fluid">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-xs-12 mb-2">
                <h3 class="content-header-title mb-0">DISCOUNTS</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-xs-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.manage-coupon.index') }}">Manage Coupon</a></li>
                            <li class="breadcrumb-item active">Add Coupon</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">ADD COUPON</h4>
                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i> Refresh </a></li>
                            <li><a href="javascript:history.go(-1)"><i class="fa fa-backward"></i> Go Back</a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body collapse in">
                    <div class="card-block">
                        <form class="form form-horizontal">
                            <div class="form-body">
                                <div class="form-group row">
                                    <label class="col-md-2 label-control">Coupon code*</label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder="Enter Coupon code" name="coupon_code" id="coupon_code">
                                        <div class="text-danger validation-err" id="coupon_code-err"></div>
                                    </div>
                                    <label class="col-md-2 label-control">Description</label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder="Enter " name="description" id="description">
                                        <div class="text-danger validation-err" id="description-err"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 label-control">Discount type* </label>
                                    <div class="col-md-4">
                                        <select class="form-control" name="discount_type" id="discount_type">
                                            <option value="percentage" selected>Percent (%)</option>
                                            <option value="amount">Rupee (INR)</option>
                                        </select>
                                        <div class="text-danger validation-err" id="discount_type-err"></div>
                                    </div>
                                    <label class="col-md-2 label-control">Discount amount*</label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder="Enter Discount" name="discount_amount" id="discount_amount">
                                        <div class="text-danger validation-err" id="discount_amount-err"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 label-control">Max Discount*</label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder="Enter Max Discount" name="maximum_discount" id="maximum_discount">
                                        <div class="text-danger validation-err" id="maximum_discount-err"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 label-control">Start Date*</label>
                                    <div class="col-md-4">
                                        <input type="date" class="form-control" onchange="TDate()" placeholder="Enter Start Date" name="start_date" id="start_date">
                                        <div class="text-danger validation-err" id="start_date-err"></div>
                                    </div>
                                    <label class="col-md-2 label-control">End Date*</label>
                                    <div class="col-md-4">
                                        <input type="date" class="form-control" onchange="ETDate()" placeholder="Enter End Date" name="end_date" id="end_date">
                                        <div class="text-danger validation-err" id="end_date-err"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 label-control">Subtotal start*</label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder="Enter Amount" name="subtotal_start" id="subtotal_start">
                                        <div class="text-danger validation-err" id="subtotal_start-err"></div>
                                    </div>
                                    <label class="col-md-2 label-control">Subtotal end*</label>
                                    <div class="col-md-4">
                                        <input type="number" class="form-control" placeholder="Enter Amount" name="subtotal_end"  id="subtotal_end">
                                        <div class="text-danger validation-err" id="subtotal_end-err"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 label-control">Status* </label>
                                    <div class="col-md-4">
                                        <select class="form-control" name="status" id="status">
                                            <option value="active" selected>Active</option>
                                            <option value="block">Block</option>
                                        </select>
                                        <div class="text-danger validation-err" id="status-err"></div>
                                    </div>
                                    <label class="col-md-2 label-control">Limit use* </label>
                                    <div class="col-md-4">
                                        <select class="form-control" name="limit_use" id="limit_use">
                                            <option value="yes" selected>Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                        <div class="text-danger validation-err" id="limit_use-err"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 label-control">Number of use </label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" placeholder="Enter No. of uses" name="number_of_use" min="1" value="1" id="number_of_use">
                                        <div class="text-danger validation-err" id="number_of_use-err"></div>
                                    </div>
                                    <label class="col-md-2 label-control">Categories*</label>
                                    <div class="col-md-4">
                                        <select class="form-control" name="categories" id="categories" multiple style="height:250px;">
                                            <option value="">Select</option>
                                            @if (isset($categories) && count($categories) > 0)
                                                @foreach ($categories as $category)
                                                    <option value='{{ $category->id }}'>{{ $category->name }}</option>
                                                    @if (isset($category->all_childs) && count($category->all_childs) > 0)
                                                        @foreach ($category->all_childs as $all_child)
                                                            @include('admin.coupons.category-tree', ['child_Children' => $all_child])
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                        <div class="text-danger validation-err" id="categories-err"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-12 text-center mt-3">
                                        <button type="button" class="btn btn-primary" id="add-coupon-btn">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.footer')
<script>
 function TDate() {
    var UserDate = document.getElementById("start_date").value;
    var ToDate = new Date();

    if (new Date(UserDate).getTime() < ToDate.getTime()) {
          alert("The Date must be Bigger than today date");
          document.getElementById("start_date").value=""
          return false;
     }
    return true;
}
function ETDate() {
    var UserDate1 = document.getElementById("start_date").value;
    var UserDate = document.getElementById("end_date").value;
    var ToDate = new Date();

    if (new Date(UserDate).getTime() < new Date(UserDate1).getTime()) {
          alert("The Date must be Bigger than Start Date");
          document.getElementById("end_date").value=""
          return false;
     }
    return true;
}
    $(document).ready(function() {
        $(document).on("click", "#add-coupon-btn", function(event) {
            $(this).attr('disabled', true);
            $(".validation-err").html("");
            let formData = new FormData();
            formData.append('coupon_code', $('#coupon_code').val());
            formData.append('description', $('#description').val());
            formData.append('discount_type', $('#discount_type').val());
            formData.append('discount_amount', $('#discount_amount').val());
            formData.append('maximum_discount', $('#maximum_discount').val());
            formData.append('start_date', $('#start_date').val());
            formData.append('end_date', $('#end_date').val());
            formData.append('subtotal_start', $('#subtotal_start').val());
            formData.append('subtotal_end', $('#subtotal_end').val());
            formData.append('limit_use', $('#limit_use').val());
            formData.append('number_of_use', $('#number_of_use').val());
            formData.append('categories', $("#categories").map(function() {
                return $(this).val();
            }).toArray());
            formData.append('status', $('#status').val());
            $.ajax({
                url: "{{ URL::to('admin/manage-coupon') }}",
                type: 'POST',
                processData: false,
                contentType: false,
                dataType: 'json',
                data: formData,
                context: this,
                success: function(result) {
                    if (result.success) {
                        window.location = "{{ URL::to('admin/manage-coupon') }}";
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
    });
</script>

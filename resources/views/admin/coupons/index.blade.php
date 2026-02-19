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
                            <li class="breadcrumb-item">Discounts</li>
                            <li class="breadcrumb-item active">Manage Coupon
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">MANAGE - COUPON</h4>
                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <a href="{{ route('admin.manage-coupon.create') }}"><i class="fa fa-plus"></i> Add Coupon </a></li>
                            <li><a href="javascript:history.go(-1)"><i class="fa fa-backward"></i> Go Back</a></li>
                        </ul>
                    </div>
                </div>
                <section>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="card-body collapse in">
                                <div class="card-block card-dashboard">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered" id="example">
                                            <thead>
                                                <tr>
                                                    <th>Date &amp; Time</th>
                                                    <th>Coupon code</th>
                                                    <th>Discount type</th>
                                                    <th>Discount amount</th>
                                                    <th>Maximum discount</th>
                                                    <th>Start date</th>
                                                    <th>End date</th>
                                                    <th>Subtotal start</th>
                                                    <th>Subtotal end</th>
                                                    <th>Limit use</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (isset($coupons) && count($coupons) > 0)
                                                    @foreach ($coupons as $coupon)
                                                        <tr>
                                                            <td>{{ $coupon->created_at }}</td>
                                                            <td>{{ $coupon->coupon_code }}</td>
                                                            <td>{{ $coupon->discount_type }}</td>
                                                            <td>{{ $coupon->discount_amount }}</td>
                                                            <td>{{ $coupon->maximum_discount }}</td>
                                                            <td>{{ $coupon->start_date }}</td>
                                                            <td>{{ $coupon->end_date }}</td>
                                                            <td>{{ $coupon->subtotal_start }}</td>
                                                            <td>{{ $coupon->subtotal_end }}</td>
                                                            <td>
                                                                {{ $coupon->limit_use }}
                                                                @if ($coupon->limit_use == 'yes')
                                                                    - {{ $coupon->number_of_use }}
                                                                @endif
                                                            </td>
                                                            <td>{{ $coupon->status }}</td>
                                                            <td class="text-truncate">
                                                                <ul class="actions">
                                                                    <li><a href="{{ route('admin.manage-coupon.edit', $coupon->id) }}" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                                    <li><a href="javascript:void(0)" onclick="deleteConfirmation({{ $coupon->id }})" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
<div id="coupon-modal" class="modal fade" role="dialog">
</div>
@include('admin.footer')
<script>
    function deleteConfirmation(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `{{ URL::to('admin/manage-coupon/${id}') }}`,
                    type: "DELETE",
                    dataType: "json",
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
</script>

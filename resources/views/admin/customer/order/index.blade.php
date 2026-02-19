@include('admin.header')
<div class="app-content content container-fluid">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-xs-12 mb-2">
                <h3 class="content-header-title mb-0">CATALOG</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-xs-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item">Catalog</li>
                            <li class="breadcrumb-item active">Manage CUstomer Orders</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">MANAGE - ORDERS</h4>
                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                          <!--   <li><a href="javascript:void(0)" class="add-brand"><i class="fa fa-plus"></i> Add </a></li> -->
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
                                        <table class="table table-striped table-bordered" id="for_all">
                                            <thead>
                                                <tr>
                                                   
                                                    <th>Order Number #</th>
                                                    <th>Name </th>
                                                    <th>Phone</th>
                                                    <th>Total Amount</th>
                                                    <th>Payment Status</th>
                                                     <th>Order Status</th>
                                                       <th>Order Date</th>
               									      <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (isset($orders) && count($orders) > 0)
                                                    @foreach ($orders as $cust)
                                                        <tr>
                                                       
                                                            <td>#{{ $cust->order_number }}</td>
                                                            <td>{{ $cust->name }}</td>
                                                            <td>{{ $cust->mobile_number }}</td>
                                                              <td>{{ $cust->order_amount_with_shipping }}</td>
                                                                <td>{{ ucfirst($cust->payment_status) }}</td>
                                                                  <td>{{ $cust->order_status }}</td>
                                                                    <td>{{ $cust->created_at }}</td>
                                                                    
                                                             <td class="text-truncate">
                                                                <ul class="actions">
                                                                    <li><a href="#" class="view-orders" brand_id="{{ $cust->id }}" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                                                 
                                                                </ul>
                                                            </td>
                                                           
                                                           
                                                        </tr>
                                                    @endforeach
                                                    @else 
                                                     <td>  No order found !</td>
                                                  
                                                @endif
                                            </tbody>
                                        </table>

                                         {!! $orders->links() !!}
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
<div id="brand-modal" class="modal fade" role="dialog">
</div>
@include('admin.footer')
<script>
  
    $(document).ready(function(event) {     
        $(document).on("click", ".edit-brand", function(event) {
            let id = $(this).attr('brand_id');
            $.ajax({
                url: `{{ URL::to('admin/manage-customer/${id}') }}`,
                type: "get",
                dataType: "json",
                success: function(result) {
                    if (result.success) {
                        $("#brand-modal").html(result.html);
                        $("#brand-modal").modal('show');
                    } else {
                        toastr.error('error encountered ' + result.msgText);
                    }
                },
                error: function(error) {
                    toastr.error('error encountered ' + error.statusText);
                }
            });
        });


    });
</script>

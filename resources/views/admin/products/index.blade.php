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
                            <li class="breadcrumb-item active">Manage Products
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">MANAGE - PRODUCTS</h4>
                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a href="{{ route('admin.manage-product.create') }}"><i class="fa fa-plus"></i> Add
                                    Product </a></li>
                            <li><a href="javascript:history.go(-1)"><i class="fa fa-backward"></i> Go Back</a></li>
                        </ul>
                    </div>
                </div>
                <section>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="card-body collapse in">
                                <div class="card-block card-dashboard" id="data-container">
                                    @include('admin.products.ajax.index')
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
<div id="product-modal" class="modal fade" role="dialog">
</div>
@include('admin.footer')
<script>

    $(document).on("click", ".show-product", function (event) {
        let id = $(this).attr('product_id');
        $.ajax({
            url: `{{ url('admin/manage-product/${id}') }}`,
            type: "get",
            dataType: "json",
            success: function (result) {
                if (result.success) {
                    $("#product-modal").html(result.html);
                    $("#product-modal").modal('show');
                } else {
                    toastr.error('error encountered ' + result.msgText);
                }
            },
            error: function (error) {
                toastr.error('error encountered ' + error.statusText);
            }
        });
    });
    function updateStatus(id) {
        Swal.fire({
            title: 'Are you sure?',
            icon: 'success',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, update it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `{{ URL::to('admin/manage-product/change-status/${id}') }}`,
                    type: "POST",
                    brandType: "json",
                    success: function (result) {
                        if (result.success) {
                            Swal.fire(
                                "Status changed Succesfully"
                            );
                            setTimeout(function () {
                                location.reload();
                            }, 40);
                        } else {
                            Swal.fire(result.msgText);
                        }
                    }
                });

            }
        })
    }
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
                    url: `{{ URL::to('admin/manage-product/${id}') }}`,
                    type: "DELETE",
                    dataType: "json",
                    success: function (result) {
                        if (result.success) {
                            Swal.fire(
                                'Deleted!',
                                'success'
                            );
                            setTimeout(function () {
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

    function deleteOptionImageConfirmation(id) {
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
                    url: `{{ URL::to('admin/product-option-image/${id}') }}`,
                    type: "DELETE",
                    dataType: "json",
                    success: function (result) {
                        if (result.success) {
                            Swal.fire(
                                'Deleted!',
                                'success'
                            );
                            setTimeout(function () {
                                $(`div [product_option_image_id="${result.product_option_image_id}"]`).remove();
                            }, 400);
                        } else {
                            Swal.fire(result.msgText);
                        }
                    }
                });

            }
        })
    }

    $(document).ready(function () {
        $(document).on('click', '.pagination a', function (event) {
            event.preventDefault();
            $('li').removeClass('active');
            $(this).parent('li').addClass('active');
            let page = $(this).attr('href').split('page=')[1];
            getData(page);
        });

        function getData(page) {
            $.ajax({
                url: '?page=' + page,
                type: "get",
                datatype: "json",
                success: function (result) {
                    $("#data-container").empty().html(result.html);
                }
            });
        }

        $(document).on("click", ".upload-image", function (event) {
            let id = $(this).attr('product_id');
            $.ajax({
                url: `{{ URL::to('admin/product-option-image/${id}') }}`,
                type: "GET",
                dataType: "json",
                success: function (result) {
                    console.log(result)
                    if (result.success) {
                        $("#product-modal").html(result.html);
                        $("#product-modal").modal('show');
                    } else {

                    }
                }
            });
        });

        $(document).on('click', '.delete-product-option-image', function (event) {
            let id = $(this).attr('product_option_image_id');
            $.ajax({
                url: `{{ URL::to('admin/product-option-image/${id}') }}`,
                type: "GET",
                dataType: "json",
                success: function (result) {
                    if (result.success) {
                        $("#product-modal").html(result.html);
                        $("#product-modal").modal('show');
                    } else {

                    }
                }
            });
        });
    });
</script>
<script>
    Dropzone.options.dropzone =
    {
        maxFilesize: 10,
        renameFile: function (file) {
            var dt = new Date();
            var time = dt.getTime();
            return time + file.name;
        },
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        addRemoveLinks: true,
        timeout: 60000,
        success: function (file, response) {
            console.log(response);
        },
        error: function (file, response) {
            return false;
        }
    };
</script>

<script>
function toggleDeal(id) {

    Swal.fire({
        title: 'Enter deal duration',
        input: 'number',
        inputLabel: 'Deal duration in hours',
        inputPlaceholder: 'Example: 12',
        showCancelButton: true,
        confirmButtonText: 'Set Deal',
        inputValidator: (value) => {
            if (!value || value <= 0) {
                return 'Please enter valid hours';
            }
        }
    }).then((result) => {

        if (result.isConfirmed) {

            fetch("{{ route('admin.product.toggleDeal') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    id: id,
                    hours: result.value
                })
            })
            .then(res => res.json())
            .then(() => location.reload());
        }

    });
}
</script>
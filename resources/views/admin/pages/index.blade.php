@include('admin.header')
<style>
    /* Important part */
.modal-dialog{
    overflow-y: initial !important
}
.modal-body{
    height: 80vh;
    overflow-y: auto;
}
</style>
<div class="app-content content container-fluid">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-xs-12 mb-2">
                <h3 class="content-header-title mb-0">CATALOG</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-xs-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item">Content Management</li>
                            <li class="breadcrumb-item active">Manage page
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">MANAGE - Page</h4>
                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a href="javascript:void(0)" class="add-blog"><i class="fa fa-plus"></i> Add </a></li>
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
                                                    <th>Date &amp; Time</th>
                                                    <th>Title</th>
                                                    <th>URL</th>
                                                    <th>Image</th>
                                                    <th>Author</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (isset($pages) && count($pages) > 0)
                                                    @foreach ($pages as $page)
                                                        <tr>
                                                            <td>{{ $page->created_at }}</td>
                                                            <td>{{ $page->title }}</td>
                                                            <td>{{ $page->url }}</td>
                                                            <td>
                                                                @if (isset($page->image) && Storage::exists($page->image))
                                                                    <img src="{{ URL::asset('storage/' . $page->image) }}" class="img-fluid" style="height:50px;">
                                                                @else
                                                                    NA
                                                                @endif
                                                            </td>
                                                            <td>{{ $page->author }}</td>
                                                            <td>{{ $page->status }}</td>
                                                            <td class="text-truncate">
                                                                <ul class="actions">
                                                                    <li><a href="javascript:void(0)" class="edit-blog" blog_id="{{ $page->id }}" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                                    <!-- <li><a href="javascript:void(0)" onclick="deleteConfirmation({{ $page->id }})" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li> -->
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
<div id="blog-modal" class="modal fade" role="dialog">
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
                    url: `{{ URL::to('admin/manage-pages/${id}') }}`,
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
    $(document).ready(function() {
        $(document).on('keyup', "#title", function(event) {
            let title = $(this).val();
            let url = title.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
            $("#url").val(url);
        })

        $(document).on("click", ".add-blog", function(event) {
            $.ajax({
                url: "{{ URL::to('admin/manage-pages/create') }}",
                type: "GET",
                dataType: "json",
                success: function(result) {
                    if (result.success) {
                        $("#blog-modal").html(result.html);
                        $("#blog-modal").modal('show');
                    } else {

                    }
                }
            });
        });

        $(document).on("click", "#add-blog-btn", function(event) {
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
            $(this).attr('disabled', true);
            $('#title-err').html('');
            $('#title_ar-err').html('');
            $('#url-err').html('');
            $('#image-err').html('');
            $('#content-err').html('');
            $('#content_arr-err').html('');
            $('#author-err').html('');
            $('#status-err').html('');
            let formData = new FormData();
            formData.append('title', $('#title').val());
            formData.append('title_ar', $('#title_ar').val());
            formData.append('url', $('#url').val());
            formData.append('content', $('#content').val());
            formData.append('content_ar', $('#content_ar').val());
            formData.append('author', $('#author').val());
            formData.append('status', $('#status').val());
            formData.append('meta_title', $('#meta_title').val());
            formData.append('meta_description', $('#meta_description').val());
            formData.append('meta_keywords', $('#meta_keywords').val());
            formData.append('canonical_tags', $('#canonical_tags').val());
            formData.append('twitter_cards', $('#twitter_cards').val());
            formData.append('og_tags', $('#og_tags').val());
            formData.append('image', (typeof $('#image')[0].files[0] == 'undefined') ? '' : $('#image')[0].files[0]);
            $.ajax({
                url: "{{ URL::to('admin/manage-pages') }}",
                type: 'POST',
                processData: false,
                contentType: false,
                dataType: 'json',
                data: formData,
                context: this,
                success: function(result) {
                    if (result.success) {
                        location.reload();
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

        $(document).on("click", ".edit-blog", function(event) {
            let id = $(this).attr('blog_id');
            $.ajax({
                url: `{{ URL::to('admin/manage-pages/${id}/edit') }}`,
                type: "get",
                dataType: "json",
                success: function(result) {
                    if (result.success) {
                        $("#blog-modal").html(result.html);
                        $("#blog-modal").modal('show');
                    } else {
                        toastr.error('error encountered ' + result.msgText);
                    }
                },
                error: function(error) {
                    toastr.error('error encountered ' + error.statusText);
                }
            });
        });

        $(document).on("click", "#update-blog-btn", function(event) {
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
            $(this).attr('disabled', true);
            $('#title-err').html('');
            $('#title_ar-err').html('');
            $('#url-err').html('');
            $('#image-err').html('');
            $('#content-err').html('');
            $('#content_arr-err').html('');
            $('#author-err').html('');
            $('#status-err').html('');
            let formData = new FormData();
            formData.append('_method', 'PUT');
            formData.append('title', $('#title').val());
            formData.append('title_ar', $('#title_ar').val());
            formData.append('url', $('#url').val());
            formData.append('content', $('#content').val());
            formData.append('content_ar', $('#content_ar').val());
            formData.append('author', $('#author').val());
            formData.append('status', $('#status').val());
            formData.append('meta_title', $('#meta_title').val());
            formData.append('meta_description', $('#meta_description').val());
            formData.append('meta_keywords', $('#meta_keywords').val());
            formData.append('canonical_tags', $('#canonical_tags').val());
            formData.append('twitter_cards', $('#twitter_cards').val());
            formData.append('og_tags', $('#og_tags').val());
            formData.append('image', (typeof $('#image')[0].files[0] == 'undefined') ? '' : $('#image')[0].files[0]);
            let blog_id = $(this).attr('blog_id');
            $.ajax({
                url: `{{ URL::to('admin/manage-pages/${blog_id}') }}`,
                type: 'POST',
                processData: false,
                contentType: false,
                dataType: 'json',
                data: formData,
                context: this,
                success: function(result) {
                    if (result.success) {
                        location.reload();
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

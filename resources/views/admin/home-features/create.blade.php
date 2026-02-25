@include('admin.header')

<div class="app-content content container-fluid">
    <div class="content-wrapper">

        <div class="content-header row">
            <div class="content-header-left col-md-6 mb-2">
                <h3 class="content-header-title mb-0">HOME FEATURE</h3>
                <div class="breadcrumbs-top">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.home-features.index') }}">Home Features</a>
                        </li>
                        <li class="breadcrumb-item active">Add Feature</li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="content-body">
            <section>
                <div class="row">
                    <div class="col-md-12">

                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">ADD FEATURE</h4>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a href="javascript:location.reload()"><i class="fa fa-refresh"></i></a>
                                        </li>
                                        <li><a href="{{ route('admin.home-features.index') }}"><i
                                                    class="fa fa-arrow-left"></i></a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="card-body collapse in">
                                <div class="card-block">

                                    <form action="{{ route('admin.home-features.store') }}" method="POST">
                                        @csrf

                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label>Icon Class</label>
                                                <input type="text" name="icon" class="form-control"
                                                    placeholder="flaticon-fast-delivery" required>
                                            </div>

                                            <div class="col-sm-6">
                                                <label>Position</label>
                                                <input type="number" name="position" class="form-control" value="0">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label>Title</label>
                                                <input type="text" name="title" class="form-control" required>
                                            </div>

                                            <div class="col-sm-6">
                                                <label>Description</label>
                                                <input type="text" name="description" class="form-control" required>
                                            </div>
                                        </div>

                                        <div class="form-group text-center">
                                            <button type="submit" class="btn btn-primary">Save Feature</button>
                                        </div>

                                    </form>

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
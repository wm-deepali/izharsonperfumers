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
                        <li class="breadcrumb-item active">Edit Feature</li>
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
                                <h4 class="card-title">EDIT FEATURE</h4>
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

                                    <form action="{{ route('admin.home-features.update', $feature->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label>Icon Class</label>
                                                <input type="text" name="icon" value="{{ $feature->icon }}"
                                                    class="form-control" required>

                                                <small>Preview:</small><br>
                                                <i class="{{ $feature->icon }}" style="font-size:26px"></i>
                                            </div>

                                            <div class="col-sm-6">
                                                <label>Position</label>
                                                <input type="number" name="position" value="{{ $feature->position }}"
                                                    class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label>Title</label>
                                                <input type="text" name="title" value="{{ $feature->title }}"
                                                    class="form-control" required>
                                            </div>

                                            <div class="col-sm-6">
                                                <label>Description</label>
                                                <input type="text" name="description"
                                                    value="{{ $feature->description }}" class="form-control" required>
                                            </div>
                                        </div>

                                        <div class="form-group text-center">
                                            <button type="submit" class="btn btn-primary">Update Feature</button>
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
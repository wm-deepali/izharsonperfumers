@include('admin.header')

<div class="app-content content container-fluid">
<div class="content-wrapper">

    <!-- Page Header -->
    <div class="content-header row mb-2">
        <div class="content-header-left col-md-6">
            <h3 class="content-header-title mb-0">HOME FEATURES</h3>

            <div class="breadcrumbs-top">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Home Features</li>
                </ol>
            </div>
        </div>

        <div class="col-md-6" style="text-align:right;">
            <a href="{{ route('admin.home-features.create') }}" class="btn btn-primary">
                <i class="fa fa-plus"></i> Add Feature
            </a>
        </div>
    </div>

    <!-- Content -->
    <div class="content-body">
        <div class="card">

            <div class="card-header">
                <h4 class="card-title">FEATURE LIST</h4>

                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li>
                            <a href="javascript:location.reload()">
                                <i class="fa fa-refresh"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.dashboard') }}">
                                <i class="fa fa-arrow-left"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="card-body collapse in">
                <div class="card-block">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th width="60">#</th>
                                    <th width="90">Icon</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th width="120">Status</th>
                                    <th width="120">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($features as $feature)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>

                                        <td class="text-center">
                                            <i class="{{ $feature->icon }}" style="font-size:22px"></i>
                                        </td>

                                        <td>{{ $feature->title }}</td>

                                        <td>{{ \Illuminate\Support\Str::limit($feature->description, 60) }}</td>

                                        <td>
                                            @if($feature->status)
                                                <span class="badge badge-success">Active</span>
                                            @else
                                                <span class="badge badge-secondary">Inactive</span>
                                            @endif
                                        </td>

                                        <td>
                                            <a href="{{ route('admin.home-features.edit', $feature->id) }}"
                                               class="btn btn-sm btn-outline-primary"
                                               title="Edit">
                                                <i class="fa fa-pencil"></i>
                                            </a>

                                            <form action="{{ route('admin.home-features.destroy',$feature->id) }}"
                                                  method="POST"
                                                  style="display:inline-block"
                                                  onsubmit="return confirm('Delete this feature?')">
                                                @csrf
                                                @method('DELETE')

                                                <button class="btn btn-sm btn-outline-danger">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">
                                            No features added yet.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>

                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>

</div>
</div>

@include('admin.footer')
<div class="table-responsive">
    <table class="table table-striped table-bordered" id="example7">

        <thead>
            <tr>
                <th>Date & Time</th>
                <th>Image</th>
                <th>Product</th>
                <th>Fragrance</th>
                <th>Category</th>
                <th>Code</th>
                <th>COD</th>
                <th>Stock</th>
                <th>Deal</th>
                <th>Deal Time Left</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @if(isset($products) && count($products) > 0)
                @foreach ($products as $product)
                    <tr>

                        <td>{{ $product->created_at->format('d M Y h:i A') }}</td>

                        <td>
                            @if($product->image && Storage::exists($product->image))
                                <img src="{{ asset('storage/' . $product->image) }}" height="60" width="60">
                            @endif
                        </td>

                        <td>{{ $product->name }}</td>

                        {{-- FRAGRANCE --}}
                        <td>
                            @if($product->fragrance)
                                @php
                                    $fragrances = App\Models\OilGrade::whereIn('id', json_decode($product->fragrance))->pluck('title')->toArray();
                                @endphp
                                {{ implode(', ', $fragrances) }}
                            @else
                                NA
                            @endif
                        </td>

                        <td>{{ $product->categories->name ?? '-' }}</td>

                        <td>{{ $product->product_code }}</td>

                        {{-- COD --}}
                        <td>
                            @if($product->has_cash_on_delivery)
                                <span class="badge bg-success">Yes</span>
                            @else
                                <span class="badge bg-danger">No</span>
                            @endif
                        </td>

                        {{-- STOCK --}}
                        <td>
                            @if($product->stock == 0)
                                <span class="text-danger">Out</span>
                            @else
                                <span class="text-success">Available</span>
                            @endif
                        </td>

                        {{-- DEAL STATUS --}}
                        <td>
                            @if($product->is_deal_active)
                                <span class="badge bg-success">Active</span>
                            @elseif($product->is_deal)
                                <span class="badge bg-warning text-dark">Expired</span>
                            @else
                                <span class="badge bg-secondary">No</span>
                            @endif
                        </td>

                        {{-- DEAL TIME LEFT --}}
                        <td>
                            @if($product->is_deal_active && $product->deal_end)
                                <span class="text-success">
                                    {{ $product->deal_time_left_human }}
                                </span>
                            @else
                                -
                            @endif
                        </td>

                        {{-- STATUS --}}
                        <td>
                            @if($product->status == "active")
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td>

                        {{-- ACTIONS --}}
                        <td class="text-truncate">
                            <ul class="actions">

                                <li>
                                    <a href="{{ url('admin/manage-product/' . $product->id) }}" title="View">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('admin.manage-product.edit', $product->id) }}" title="Edit">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                </li>

                                {{-- TOGGLE DEAL --}}
                                <li>
                                    <a href="javascript:void(0)" onclick="toggleDeal({{ $product->id }})" title="Toggle Deal">
                                        <i class="fa fa-tags text-primary"></i>
                                    </a>
                                </li>

                                <li>
                                    <a href="javascript:void(0)" onclick="deleteConfirmation({{ $product->id }})"
                                        title="Delete">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </li>

                                <li>
                                    <a href="javascript:void(0)" onclick="updateStatus({{ $product->id }})" title="Status">
                                        @if($product->status == "active")
                                            <i class="fa fa-check text-success"></i>
                                        @else
                                            <i class="fa fa-times text-danger"></i>
                                        @endif
                                    </a>
                                </li>

                            </ul>
                        </td>

                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

</div>
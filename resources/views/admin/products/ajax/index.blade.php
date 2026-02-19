<div class="table-responsive">
    <table class="table table-striped table-bordered" id="example7">
        <thead>
            <tr>
                <th>Date &amp; Time</th>
                <th>Product Image</th>
                <th> Product Name</th>
                <th> Fragrance</th>
                <th> Category </th>
                <th> Product Code </th>
                <th> COD  </th>
                <th> Availability</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if (isset($products) && count($products) > 0)
                @foreach ($products as $product)
                    <tr>
                        
                        <td>{{ $product->created_at }}</td>
                        <td> @if (Storage::exists($product->image))
                            <img src="{{ URL::asset('storage/' . $product->image) }}" alt="{{ $product->name }}" height="75" width="75">
                        @endif</td>
                        <td>{{ $product->name }}</td>
                        <td>
                           
                        @if(isset($product->fragrance))
                        @foreach(json_decode($product->fragrance) as $fragrance)
                         @php  $brand= App\Models\OilGrade::where('id',$fragrance)->first(); @endphp
                      {{$brand->title.","}}
                        @endforeach
                        @else
                        NA
                        @endif
                        </td>
                        <td>{{ $product->categories->name ?? '-' }}</td>
                        
                        <td>{{ $product->product_code }}</td>
                        <td>{{ $product->has_cash_on_delivery }}</td>
                        <td>{{$product->stock==0 ? "Out of Stock":"Available"}}</td>
                        <td>{{ $product->status=="active" ? "Active":"De-Active" }}</td>
                        <td class="text-truncate">
                            <ul class="actions">
                            <li><a href="{{ url('admin/manage-product/'.$product->id) }}"  product_id="{{ $product->id }}" title="View"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                <!--<li><a href="javascript:void(0)" title="Upload Image" class="upload-image" product_id="{{ $product->id }}"><i class="fa fa-upload" aria-hidden="true"></i></a></li>-->
                                <li><a href="{{ route('admin.manage-product.edit', $product->id) }}" title="Edit Product"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                <li><a href="javascript:void(0)" onclick="deleteConfirmation({{ $product->id }})" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                <li><a href="javascript:void(0)" onclick="updateStatus({{ $product->id }})" title="Status">@if($product->status =="active")<i style="color:green" class="fa fa-check" aria-hidden="true"></i>@else <i style="color:red" class="fa fa-times" aria-hidden="true"></i> @endif</a></li>
                            </ul>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
   
</div>

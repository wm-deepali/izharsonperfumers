@include('admin.header')
<div class="app-content content container-fluid">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-xs-12 mb-2">
                <h3 class="content-header-title mb-0">Catalog</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-xs-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.manage-product.index') }}">Manage
                                    Products</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
       
             <div class="content-body">
             <section id="horizontal-form-layouts">
            <!-- Modal content-->
            <form class="form form-horizontal card_content">

                <div class="row">
                    <div class="col-sm-3">
                        <b class="label-control label"> Date &amp; Time:-</b><p>{{$product->created_at}}</p>
                    </div>
                    <div class="col-sm-3">
                        <b class="label-control label">Product Image:-</b><p>@if (Storage::exists($product->image))
                            <img src="{{ URL::asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                height="75" width="75">
                            @else
                            NA

                            @endif
                        </p>
                    </div>
                    <div class="col-sm-3">
                        <b class="label-control label">Product Name:-</b><p>{{ $product->name}}</p>
                    </div>
                    <div class="col-sm-3">
                        <b
                            class="label-control label">Category:-</b><p>{{ $product->categories->name ?? '-' }}</p>
                    </div>
                    </div>
                     <div class="row">
                    <div class="col-sm-3">
                        <b class="label-control label">Sub
                            Category:-</b><p>{{ $product->subcategories->name ?? '-' }}</p>
                    </div>
                  
                    <div class="col-sm-3">
                        <b class="label-control label">Part Number:-</b><p>{{$product->part_number}}</p>
                    </div>
                    <div class="col-sm-3">
                        <b class="label-control label">COD:-</b><p>{{$product->has_cash_on_delivery}}</p>
                    </div>
                    <div class="col-sm-3">
                        <b
                            class="label-control label">Availability:-</b><p>{{$product->stock==0 ? "Out of Stock":"Available"}}</p>
                    </div>
                    </div>
                     <div class="row">
                    <div class="col-sm-3">
                        <b class="label-control label">Replacement
                            Warranty:-</b><p>{{$product->replacement_waranty}}</p>
                    </div>
                   
                    <div class="col-sm-3">
                        <b class="label-control label">Cancellation
                            Allowed:-</b><p>{{$product->cancellation_allowed}}</p>
                    </div>
                    <div class="col-sm-3">
                        <b class="label-control label">Express Shipping:-</b><p>{{$product->express_sheeping}}</p>
                    </div>
                    <div class="col-sm-3">
                        <b class="label-control label">Featured Product (Home)
                            :-</b><span>{{$product->is_featured}}</span>
                    </div>
                    </div>
                     <div class="row">
                    <div class="col-sm-3">
                        <b class="label-control label">Best Deal (Home) :-</b><p>{{$product->is_bestSales}}</p>
                    </div>
                    <div class="col-sm-3">
                        <b class="label-control label">Total Item In Stock :-</b><p>{{$product->stock}}</p>
                    </div>

                    <div class="col-sm-3">
                        <b class="label-control label">URL Slug:-</b><p>{{$product->slug}}</p>
                    </div>

                    <div class="col-sm-3">
                        <b
                            class="label-control label">Status:-</b><p>{{$product->status=="active" ? "Active" : "De-Active"}}</p>
                    </div>
                    </div>
                     <div class="row">
                    <div class="col-sm-3">
                        <b class="label-control label">Alert Quantity:-</b><p>{{$product->alert_quantity}}</p>
                    </div>
                    <div class="col-sm-3">
                        <b class="label-control label">Default
                            Price:-</b><p>{{$product->product_options[0]->default_price}}</p>
                    </div>

                    <div class="col-sm-3">
                        <b class="label-control label">Short Description:-</b><p>{!! $product->short_description
                            !!}</p>
                    </div>
                    <div class="col-sm-3">
                        <b class="label-control label">Description:-</b><p>{!! $product->description !!}</p>
                    </div>
                     </div>
                      <div class="row">
                    <div class="col-sm-3">
                        <b class="label-control label">Additional Information:-</b><p>{!!
                            $product->additional_information !!}</p>
                    </div>
                    <div class="col-sm-3">
                        <b class="label-control label">Shipping Information:-</b><p>{!!
                            $product->shipping_information !!}</p>
                    </div>
                    <div class="col-sm-3">
                        <b class="label-control label">Terms & Conditions:-</b><p>{!! $product->terms_condition
                            !!}</p>
                    </div>
                    <div class="col-sm-3">
                        <b class="label-control label">Meta Title:-</b><p>{{$product->meta->meta_title}}</p>
                    </div>
                    </div>
                     <div class="row">
                    <div class="col-sm-3">
                        <b class="label-control label">Meta
                            Keywords:-</b><p>{{$product->meta->meta_description}}</p>
                    </div>
                    <div class="col-sm-3">
                        <b class="label-control label">Meta
                            Description:-</b><p>{{$product->meta->meta_keyword}}</p>
                    </div>
                    <div class="col-sm-3">
                        <b class="label-control label">Canonical
                            Tag:-</b><p>{{$product->meta->canonical_tags}}</p>
                    </div>
                    <div class="col-sm-3">
                        <b class="label-control label">Twitter Cards:-</b><p>{{$product->meta->twitter_cards}}</p>
                    </div>
                    </div>
                     <div class="row">
                    <div class="col-sm-3">
                        <b class="label-control label">OG Tags:-</b><p>{{$product->meta->og_tags}}</p>
                    </div>
                    </div>
                     <div class="row">
                          <div class="col-lg-12">
                    <div class="mt-3 table-responsive" style="margin-top:30px">
                        <table class="table table-striped table-bordered mt-3">
                            <thead>
                                <tr>
                                    <th>Quantity</th>
                                    <th>Stock</th>
                                    <th>MRP</th>
                                    <th>Discount(%)</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($productoption as $variant)

                                <tr>
                                    <td>{{$variant->carmake->quantity.$variant->carmake->quantity_in}}</td>
                                    <td>{{$variant->stock}}</td>
                                    <td>{{$variant->mrp}}</td>
                                    <td>{{$variant->discount_percentage}}</td>
                                    <td>{{$variant->price}}</td>
                                </tr>


                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
               </div>
               </div>
            </form>
         </section>
        </div>
    </div>
</div>
@include('admin.footer')
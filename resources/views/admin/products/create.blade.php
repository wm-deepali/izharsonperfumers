@include('admin.header')
<style type="text/css">
  span.select2.select2-container.select2-container--default.select2-container--above {
    width: 250px !important;
  }

  span.select2.select2-container.select2-container--default {
    width: 250px !important;
  }
  
  
input[type="file"] {
	position: absolute;
	right: -9999px;
	visibility: hidden;
	opacity: 0;
}
.filelabel {
	position: relative;
	padding: 1rem 3rem;
	background: #eee;
	display: inline-block;
	text-align: center;
	overflow: hidden;
	border-radius: 10px;
}
.filelabel:hover {
		background: #d86021;
		color: #fff;
		cursor: pointer;
		transition: 0.2s all;
	}
</style>
<div class="app-content content container-fluid">
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-6 col-xs-12 mb-2">
        <h3 class="content-header-title mb-0">Catalog</h3>
        <div class="row breadcrumbs-top">
          <div class="breadcrumb-wrapper col-xs-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
              </li>
              <li class="breadcrumb-item">
                <a href="{{ route('admin.manage-product.index') }}">Manage Products</a>
              </li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <div class="content-body">
      <!-- Basic form layout section start -->
      <section id="horizontal-form-layouts">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">ADD</h4>
                <a class="heading-elements-toggle">
                  <i class="fa fa-ellipsis-v font-medium-3"></i>
                </a>
                <div class="heading-elements">
                  <ul class="list-inline mb-0">
                    <li>
                      <a data-action="reload" href="javascript:location.reload()"><i class="fa fa-refresh"></i> Refresh</a>
                    </li>
                    <li>
                      <a href="javascript:history.go(-1)">
                        <i class="fa fa-backward"></i> Go Back </a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="card-body collapse in">
                <div class="card">
                  <div class="card-body">
                    <div class="card-block">
                      <div class="col-xl-8 col-lg-8">
                        <form id="addproduct" enctype="multipart/form-data" method="POST">
                            @csrf
                          <!--<ul class="nav nav-tabs nav-top-border no-hover-bg nav-justified">-->
                          <!--  <li class="nav-item">-->
                          <!--    <a class="nav-link active general-tab" id="active-tab1" data-toggle="tab" href="#active1" aria-controls="active1" aria-expanded="true">General</a>-->
                          <!--  </li>-->
                          <!--  <li class="nav-item">-->
                          <!--    <a class="nav-link option-tab" id="link-tab3" data-toggle="tab" href="#link3" aria-controls="link3" aria-expanded="false">Add Variants</a>-->
                          <!--  </li>-->
                          <!--  <li class="nav-item">-->
                          <!--    <a class="nav-link seo-tab" id="link-tab2" data-toggle="tab" href="#link2" aria-controls="link2" aria-expanded="false">SEO</a>-->
                          <!--  </li>-->
                          <!--</ul>-->
                          <div class="tab-content px-1 pt-1">
                            <div role="tabpanel" class="tab-pane fade active in">
                              <div class="form-body">
                                <div class="form-group row">
                                  <div class="col-md-6 col-sm-12 col-lg-6">
                                    <label class="label label-control" for="color_1">
                                      <span class="subcatname1"> Category</span>
                                      <span class="mandatory-red subcat1req"></span>
                                    </label>
                                    <select id="category" class="form-control category" name="category[]"  width="100%">
                                      <option value="">Select</option>
                                      <!-- <option value="all">All</option> --> @if (isset($categories) && count($categories) > 0) @foreach ($categories as $category) <option value='{{ $category->id }}'>
                                        {{ $category->name }}
                                      </option>
                                      @endforeach @endif
                                    </select>
                                    <div class="text-danger validation-err" id="category-err"></div>
                                  </div>
                                  <!-- category and brand removed from here -->
                                  <div class="col-md-6 col-sm-12 col-lg-6" style="display:none" id="subcategory">
                                    <label class="label-control">Sub Category* </label>
                                    <select class="form-control" placeholder="Enter Sub Category" name="subcategory_id" id="subcategory_id"></select>
                                    <div class="text-danger validation-err" id="subcategory_id-err"></div>
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <div class="col-md-6 col-sm-6 col-lg-6">
                                    <label class="label-control">Product Code* </label>
                                    <input type="text" class="form-control" placeholder="Enter Product Code" name="product_code" id="product_code">
                                    <div class="text-danger validation-err" id="product_code-err"></div>
                                  </div>
                                  <div class="col-md-6 col-sm-6 col-lg-6">
                                    <label class="label-control">Product Name* </label>
                                    <input type="text" class="form-control" placeholder="Enter Product name" name="name" id="name">
                                    <div class="text-danger validation-err" id="name-err"></div>
                                  </div>
                                  </div>
                                   <div class="form-group row">
                                  <div class="col-md-6 col-sm-12 col-lg-6">
                                    <label class="label-control">URL Slug* </label>
                                    <input type="text" class="form-control" placeholder="Enter URL Slug" name="slug" id="slug">
                                    <div class="text-danger validation-err" id="slug-err"></div>
                                  </div>
                                  <div class="col-md-6 col-sm-12 col-lg-6">
                                    <label class="label-control">Default Price </label>
                                    <input type="number" class="form-control" placeholder="Enter Default Price" name="default_price" id="default_price">
                                    <div class="text-danger validation-err" id="default_price-err"></div>
                                  </div>
                                  </div>
                                   <div class="form-group row">
                                  <div class="col-md-6 col-sm-12 col-lg-6">
                                    <label class="label-control">Alert Quantity*</label>
                                    <input type="text" class="form-control" placeholder="Enter quantity" name="alert_quantity" id="alert_quantity">
                                    <div class="text-danger validation-err" id="alert_quantity-err"></div>
                                  </div>
                                 
                                   <div class="col-md-6 col-sm-12 col-lg-6">
                                    <label class="label-control">Status*</label>
                                    <select class="form-control" name="status" id="status">
                                      <option value="active" selected>Active </option>
                                      <option value="block">De-Active</option>
                                    </select>
                                    <div class="text-danger validation-err" id="status-err"></div>
                                  </div>
                                 
                                 </div>
                                  
                                <div class="form-group row">
                                    
                                    
                                    
                                  <div class="col-md-12">
                                    <label class="label-control"> Short Description* </label>
                                    <textarea class="form-control" cols="4" rows="2" placeholder="Enter Detail" name="short_description" id="short_description"></textarea>
                                    <div class="text-danger validation-err" id="short_description-err"></div>
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <div class="col-md-12">
                                    <label class="label-control"> Description* </label>
                                    <textarea class="form-control" cols="4" rows="3" placeholder="Enter Detail" name="description" id="description"></textarea>
                                    <div class="text-danger validation-err" id="description-err"></div>
                                  </div>
                                </div>
                               
                                <div class="form-group row">
                                  <div class="col-md-12">
                                    <label class="label-control"> Additional Information* </label>
                                    <textarea class="form-control" cols="4" rows="3" placeholder="Enter Detail" name="additional_information" id="additional_information"></textarea>
                                    <div class="text-danger validation-err" id="additional_information-err"></div>
                                  </div>
                                </div>
                                
                                <div class="form-group row">
                                  <div class="col-md-12">
                                    <label class="label-control"> Shipping Information* </label>
                                    <textarea class="form-control" cols="4" rows="5" placeholder="Enter Detail" name="shipping_information" id="shipping_information"></textarea>
                                    <div class="text-danger validation-err" id="shipping_information-err"></div>
                                  </div>
                                </div>
                                <div class="form-group row">
                                  <div class="col-md-12">
                                    <label class="label-control"> Terms & Conditions* </label>
                                    <textarea class="form-control" cols="4" rows="2" placeholder="Enter Detail" name="terms_condition" id="terms_condition"></textarea>
                                    <div class="text-danger validation-err" id="terms_condition-err"></div>
                                  </div>
                                </div>
                               
                              </div>
                            </div>
                            <!--<div role="tabpanel" class="tab-pane fade" id="link3" aria-labelledby="active-tab3" aria-expanded="true">-->
                              
                            <!--</div>-->
                            <!--<div role="tabpanel" class="tab-pane fade" id="link2" aria-labelledby="active-tab1" aria-expanded="true">-->
                            <!--  <div class="div-form">-->
                            <!--    <form class="form form-horizontal">-->
                            <!--      <div class="form-body">-->
                            <!--        <h4 class="form-section">-->
                            <!--          <i class="icon-clipboard4"></i> SEO/Meta Data (Optional)-->
                            <!--        </h4>-->
                            <!--        <div class="form-group row"></div>-->
                            <!--        <div class="text-danger validation-err pull-right" id="validation-err"></div>-->
                            <!--        <div class="form-actions">-->
                            <!--          <button type="button" class="btn btn-primary pull-right" id="add-product-btn">-->
                            <!--            <i class="fa fa-check-square-o"></i>Submit </button>-->
                            <!--        </div>-->
                            <!--      </div>-->
                            <!--    </form>-->
                            <!--  </div>-->
                            <!--</div>-->
                          </div>
                        
                      </div>
                     
                      <div class="col-xl-4 col-lg-4 mt-1">
                          
                        <div class="form-group row">
                             	
                            <div class="col-md-4 col-sm-4 col-lg-4">
                                <label>Product Image (400*350)</label>
                    		<label for="upload" class="filelabel">
                    			<input type="file" id="upload" name="image">
                    			 <span class="close" style="display:none">&times;</span>
                    		    <img style="height:100px;width:100px;display:none" id="blah1" src="#" alt="your image"  />
                    	            <i class="fa fa-plus" id="icon1"></i>
                    		</label>
                    		 <div class="text-danger validation-err"
                                                                            id="image-err"></div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-lg-4">
                                 <label>Product Image (400*350)</label>
                    		<label for="upload2" class="filelabel">
                    			<input type="file" id="upload2" name="image2">
                    			 <span class="close2" style="display:none">&times;</span>
                    	            <img style="height:100px;width:100px;display:none" id="blah2" src="#" alt="your image"  />
                    	            <i class="fa fa-plus" id="icon2"></i>
                    		</label>
                    		 <div class="text-danger validation-err" id="image2-err"></div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-lg-4">
                                 <label>Product Image (400*350)</label>
                    		<label for="upload3" class="filelabel">
                    			<input type="file" id="upload3"  name="image3" >
                    			 <span class="close3" style="display:none">&times;</span>
                    	           <img style="height:100px;width:100px;display:none" id="blah3" src="#" alt="your image"  />
                    	            <i class="fa fa-plus" id="icon3"></i>
                    		</label>
                    		 <div class="text-danger validation-err"
                                                                            id="image3-err"></div>
                            </div>
                            </div>
                            <div class="form-group row">
                            <div class="col-md-4 col-sm-4 col-lg-4">
                                <label>Product Image (400*350)</label>
                    		<label for="upload4" class="filelabel">
                    			<input type="file" id="upload4"  name="image4" >
                    			 <span class="close4" style="display:none">&times;</span>
                    	            <img style="height:100px;width:100px;display:none" id="blah4" src="#" alt="your image"  />
                    	            <i class="fa fa-plus" id="icon4"></i>
                    		</label>
                    		 <div class="text-danger validation-err"
                                                                            id="image4-err"></div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-lg-4">
                                 <label>Product Image (400*350)</label>
                    		<label for="upload5" class="filelabel">
                    			<input type="file" id="upload5"  name="image5" >
                    			 <span class="close5" style="display:none">&times;</span>
                    	            <img style="height:100px;width:100px;display:none" id="blah5" src="#" alt="your image"  />
                    	            <i class="fa fa-plus" id="icon5"></i>
                    		</label>
                    		 <div class="text-danger validation-err"
                                                                            id="image5-err"></div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-lg-4">
                                 <label>Product Image (400*350)</label>
                    		<label for="upload6" class="filelabel">
                    			<input type="file" id="upload6"  name="image6" >
                    			 <span class="close6" style="display:none">&times;</span>
                    	            <img style="height:100px;width:100px;display:none" id="blah6" src="#" alt="your image"  />
                    	            <i class="fa fa-plus" id="icon6"></i>
                    		</label>
                            </div>
                             <div class="text-danger validation-err"
                                                                            id="image6-err"></div>
                            </div>
                            <!--<div  class="form-group row gallery"></div>-->
                          <!--<div class="col-md-12 col-sm-12 col-lg-12">-->
                          <!--  <label class="label-control">Product Image*</label>-->
                          <!--  <input type="file" class="form-control" name="image" id="image">-->
                          <!--  <div class="text-danger validation-err" id="image-err"></div>-->
                          <!--</div>-->
                          
                          <div class="form-group row">
                          <div class="col-md-12 col-sm-12 col-lg-12">
                            <label class="label-control">Youtube URL</label>
                            <input type="text" placeholder="Enter Youtube URL" class="form-control" name="youtube_code" id="youtube_code">
                            <div class="text-danger validation-err" id="youtube_code-err"></div>
                          </div>
                          </div>
                          <div class="form-group row">
                                  <div class="col-md-3">
                                    <label class="label-control">Fragrance</label>
                                    @foreach($fragrances as $key=>$fragrance)
                                    <div class="form-check">
                                      <input type="checkbox" class="form-check-input1" id="fragrance{{$key}}" name="fragrance[]" value="{{$fragrance->id}}" >
                                      <label class="form-check-label" for="fragrance{{$key}}">{{$fragrance->title}}</label>
                                    </div>
                                    @endforeach
            
                                    <div class="text-danger" id="fragrance-err"></div>
                                </div>
                               </div>
                          <div class="form-group row">
                          <div class="col-md-6 col-sm-6 col-lg-6">
                            <label class="label-control">Replacement Warranty </label><br/>
                            <label class="switch">
                              <input type="checkbox" name="replacement_waranty" id="replacement_waranty" value="yes">
                              <span class="slider round"></span>
                            </label>
                            <div class="text-danger validation-err" id="replacement_waranty-err"></div>
                          </div>
                          <div class="col-md-6 col-sm-6 col-lg-6">
                            <label class="label-control">New Arrivals (Home)</label><br/>
                            <label class="switch">
                              <input type="checkbox" name="new_arrivals" id="new_arrivals" value="yes">
                              <span class="slider round"></span>
                            </label>
                            <div class="text-danger validation-err" id="new_arrivals-err"></div>
                          </div>
                           </div>
                           <div class="form-group row">
                          <div class="col-md-6 col-sm-6 col-lg-6">
                            <label class="label-control">COD</label><br/>
                            <label class="switch">
                              <input type="checkbox" name="has_cash_on_delivery" id="has_cash_on_delivery" value="yes">
                              <span class="slider round"></span>
                            </label>
                            <div class="text-danger validation-err" id="has_cash_on_delivery-err"></div>
                          </div>
                          <div class="col-md-6 col-sm-6 col-lg-6">
                            <label class="label-control">Express Shipping </label><br/>
                            <label class="switch">
                              <input type="checkbox" name="express_sheeping" id="express_sheeping" value="yes">
                              <span class="slider round"></span>
                            </label>
                            <div class="text-danger validation-err" id="express_sheeping-err"></div>
                          </div>
                          
                         </div>
                         <div class="form-group row">
                          <div class="col-md-6 col-sm-6 col-lg-6">
                            <label class="label-control">Cancellation Allowed </label><br/>
                            <label class="switch">
                              <input type="checkbox" name="cancellation_allowed" id="cancellation_allowed" value="yes">
                              <span class="slider round"></span>
                            </label>
                            <div class="text-danger validation-err" id="cancellation_allowed-err"></div>
                          </div>
                          <div class="col-md-6 col-sm-6 col-lg-6">
                            <label class="label-control">Premium Products (Home) </label><br/>
                            <label class="switch">
                              <input type="checkbox" name="is_premium" id="is_premium" value="yes">
                              <span class="slider round"></span>
                            </label>
                            <div class="text-danger validation-err" id="is_premium-err"></div>
                          </div>
                          </div>
                          <!-- <div class="form-group row">-->
                          <!--<div class="col-md-12 col-sm-12 col-lg-12">-->
                          <!--  <label class="label-control">Top Categories (Home) </label><br/>-->
                          <!--  <label class="switch">-->
                          <!--    <input type="checkbox" name="is_top" id="is_top" value="yes">-->
                          <!--    <span class="slider round"></span>-->
                          <!--  </label>-->
                          <!--  <div class="text-danger validation-err" id="is_top-err"></div>-->
                          <!--</div>-->
                          <!--</div>-->
                           <div class="form-group row">
                          <div class="col-md-12 col-sm-12 col-lg-12">
                            <label class="label-control">Meta Title* </label>
                            <input type="text" class="form-control" placeholder="Meta Tag Title" name="meta_title" id="meta_title">
                            <span class="note-span" id="meta-title-limit">We recommend title between 50–60 characters.(0 character)</span>
                            <div class="text-danger validation-err" id="meta_title-err"></div>
                          </div>
                          </div>
                           <div class="form-group row">
                          <div class="col-md-12 col-sm-12 col-lg-12">
                            <label class="label-control">Meta Tag Description</label>
                            <textarea class="form-control" name="meta_description" id="meta_description" placeholder="Meta Tag Description"></textarea>
                            <span class="note-span" id="meta-description-limit">We recommend descriptions between 50–160 characters.(0 character)</span>
                            <div class="text-danger validation-err" id="meta_description-err"></div>
                          </div> 
                          </div>
                           <div class="form-group row">
                          <div class="col-md-12 col-sm-12 col-lg-12">
                            <label class="label-control">Meta Tag Keywords</label>
                            <textarea class="form-control" name="meta_keyword" id="meta_keyword" placeholder="Meta Tag Keywords"></textarea>
                            <div class="text-danger validation-err" id="meta_keyword-err"></div>
                          </div>
                          </div>
                           <div class="form-group row">
                          <div class="col-md-12 col-sm-12 col-lg-12">
                            <label class="label-control label">Canonical Tag 
                            </label>
                            <input type="text" class="form-control" placeholder="Enter Canonical Tag" name="canonical_tags" id="canonical_tags"/>
                            <div class="text-danger" id="canonical_tags-err"></div>
                          </div>
                          </div>
                           <div class="form-group row">
                          <div class="col-md-12 col-sm-12 col-lg-12">
                            <label class="label-control label">Twitter Cards 
                            </label>
                            <input type="text" class="form-control" placeholder="Enter Twitter Cards" name="twitter_cards" id="twitter_cards"/>
                            <div class="text-danger" id="twitter_cards-err"></div>
                          </div>
                          </div>
                           <div class="form-group row">
                          <div class="col-md-12 col-sm-12 col-lg-12">
                            <label class="label-control label">OG Tags 
                            </label>
                            <input type="text" class="form-control" placeholder="Enter OG Tags" name="og_tags" id="og_tags"/>
                            <div class="text-danger" id="og_tags-err"></div>
                          </div>
                        </div>
                        
                        </div>
                      </div>
                      <div class="col-xl-12 mt-1">
                          <h3><strong>Add Variants</strong></h3>
                          <div class="div-form">
                                <!-- <div class="form-group row"><div class="col-sm-3"><h4><i class="ft-user"></i>Attribute Option</h4></div><div class="col-sm-9"><label class="label-control">Choose Attributes (Upto 2)</label><div class="d-block"><ul class="inline-units">
                                                                                @if (isset($attributes) && count($attributes) > 0)
                                                                                    @foreach ($attributes as $attribute)
                                                                                        <li><label><input type="checkbox" class="attribute_options" value="{{ $attribute->id }}"> {{ $attribute->name }}</label></li>
                                                                                    @endforeach
                                                                                @endif
                                                                            </ul></div><div class="text-danger validation-err" id="attribute_options-err"></div></div></div> -->
                                <div class="optionBox">
                                  <div class="block">
                                    <div class="form-group row after-add-more">
                                      <div class="col-sm-2">
                                        <label class="label label-control">Select Quantity </label>
                                        <select class="form-control brand" name="brand[]" id="brand">
                                          <option value="">Select</option> @if (isset($brands) && count($brands) > 0) @foreach ($brands as $brand) <option value="{{ $brand->id }}">
                                            {{ $brand->quantity.$brand->quantity_in }}
                                          </option> @endforeach @endif
                                        </select>
                                        <div class="text-danger validation-err" id="brand-err"></div>
                                      </div>
                                       <div class="row">
                                        <div class="col-sm-1">
                                          <label class="label-control">Stock</label>
                                          <input type="number" class="form-control stock" min="1" name="stock[]" >
                                          <div class="text-danger validation-err" id="stock-err"></div>
                                        </div>
                                        <div class="col-sm-1">
                                          <label class="label-control">MRP</label>
                                          <input type="number" placeholder="MRP" class="form-control mrp" min="1" name="mrp[]" >
                                          <div class="text-danger validation-err" id="mrp-err"></div>
                                        </div>
                                        <div class="col-sm-1">
                                          <label class="label-control">Discount(%)</label>
                                          <input type="number" class="form-control discount_percentage" min="1" max="100" name="discount_percentage[]" >
                                          <div class="text-danger validation-err" id="discount_percentage-err"></div>
                                        </div>
                                        <div class="col-sm-1">
                                          <label class="label-control">Price</label>
                                          <input type="number" placeholder="Price" class="form-control price" readonly min="1" name="price[]" >
                                          <div class="text-danger validation-err" id="price-err"></div>
                                        </div>
                                         <div class="col-sm-2">
                                 <label>Product Image (400*350)</label>
                    		    <label  class="filelabel">
                    			<input type="file" class="imageInput" name="images[]" multiple>
                    			 <div class="imagePreviewContainer"></div>
                    			 <span class="closes2" style="display:none">&times;</span>
                    	            <img style="height:100px;width:100px;display:none" id="blash" src="#" alt="your image"  />
                    	            <i class="fa fa-plus" id="icon"></i>
                    		</label>
                    		 <div class="text-danger validation-err" id="image2-err"></div>
                            </div>
                                       <div class="col-sm-2">
                                      
                                      <div class="row">
                                          <div class="col-sm-2 change">
                                        <label for="">&nbsp;</label>
                                        <br />
                                        <span class="btn btn-success add-more">+ Add</span>
                                      </div>
                                      </div>
                                      </div> 
                                      </div>
                                      
                                      
                                      
                                    </div>
                                    <div class="form-actions">
                                      <button type="submit" class="btn btn-primary pull-right" id="add-product-btn">
                                        <i class="fa fa-check-square-o"></i>Submit </button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                      </div>
                    </div>
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
<script>
$(document).on('click', '.close', function() {
    $(this).css('display','none');
    $('#upload').val('');
    $('#blah1').css('display','none');
    $('#icon1').css('display','block');
    // $(this).parent().parent().remove();
  });
  $(document).on('click', '.close2', function() {
    $(this).css('display','none');
    $('#upload2').val('');
    $('#blah2').css('display','none');
    $('#icon2').css('display','block');
    // $(this).parent().parent().remove();
  });
  $(document).on('click', '.close3', function() {
    $(this).css('display','none');
    $('#upload3').val('');
    $('#blah3').css('display','none');
    $('#icon3').css('display','block');
    // $(this).parent().parent().remove();
  });
  $(document).on('click', '.close4', function() {
    $(this).css('display','none');
    $('#upload4').val('');
    $('#blah4').css('display','none');
    $('#icon4').css('display','block');
    // $(this).parent().parent().remove();
  });
  $(document).on('click', '.close5', function() {
    $(this).css('display','none');
    $('#upload5').val('');
    $('#blah5').css('display','none');
    $('#icon5').css('display','block');
    // $(this).parent().parent().remove();
  });
   $(document).on('click', '.close6', function() {
    $(this).css('display','none');
    $('#upload6').val('');
    $('#blah6').css('display','none');
    $('#icon6').css('display','block');
    // $(this).parent().parent().remove();
  });
  
$(document).ready(()=>{
      $('#upload').change(function(){
        const file = this.files[0];
        console.log(file);
         $('#blah1').css('display','block');
         $('.close').first().css('display','block');
         $('#icon1').css('display','none');
        if (file){
          let reader = new FileReader();
          reader.onload = function(event){
            console.log(event.target.result);
            $('body #blah1').attr('src', event.target.result);
          }
          reader.readAsDataURL(file);
        }
      });
     $('#upload2').change(function(){
        const file = this.files[0];
        console.log(file);
         $('#blah2').css('display','block');
         $('#icon2').css('display','none');
          $('.close2').first().css('display','block');
        if (file){
          let reader = new FileReader();
          reader.onload = function(event){
            console.log(event.target.result);
            $('#blah2').attr('src', event.target.result);
          }
          reader.readAsDataURL(file);
        }
      });
      $('#upload3').change(function(){
        const file = this.files[0];
        console.log(file);
         $('#blah3').css('display','block');
         $('#icon3').css('display','none');
          $('.close3').first().css('display','block');
        if (file){
          let reader = new FileReader();
          reader.onload = function(event){
            console.log(event.target.result);
            $('#blah3').attr('src', event.target.result);
          }
          reader.readAsDataURL(file);
        }
      });
      $('#upload4').change(function(){
        const file = this.files[0];
        console.log(file);
         $('#blah4').css('display','block');
         $('#icon4').css('display','none');
          $('.close4').first().css('display','block');
        if (file){
          let reader = new FileReader();
          reader.onload = function(event){
            console.log(event.target.result);
            $('#blah4').attr('src', event.target.result);
          }
          reader.readAsDataURL(file);
        }
      });
      $('#upload5').change(function(){
        const file = this.files[0];
        console.log(file);
         $('#blah5').css('display','block');
         $('#icon5').css('display','none');
          $('.close5').first().css('display','block');
        if (file){
          let reader = new FileReader();
          reader.onload = function(event){
            console.log(event.target.result);
            $('#blah5').attr('src', event.target.result);
          }
          reader.readAsDataURL(file);
        }
      });
      $('#upload6').change(function(){
        const file = this.files[0];
        console.log(file);
         $('#blah6').css('display','block');
         $('#icon6').css('display','none');
          $('.close6').first().css('display','block');
        if (file){
          let reader = new FileReader();
          reader.onload = function(event){
            console.log(event.target.result);
            $('#blah6').attr('src', event.target.result);
          }
          reader.readAsDataURL(file);
        }
      });
      
      
    });
   
    $(document).ready(function() {
       
        CKEDITOR.replace('description', {
            filebrowserUploadUrl: "{{ route('admin.image-upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form'
        });

        CKEDITOR.replace('additional_information', {
            filebrowserUploadUrl: "{{ route('admin.image-upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form'
        });

        CKEDITOR.replace('shipping_information', {
            filebrowserUploadUrl: "{{ route('admin.image-upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form'
        });

        CKEDITOR.replace('content');

        $(document).on("keyup change", ".mrp", function(event) {
        let mrp = $(this).val();
        $(this).closest('.form-group').find('.discount_percentage').val('0');
        $(this).closest('.form-group').find('.price').val(mrp);
    });
    
    $(document).on('keyup', "#name", function(event) {
    let name = $(this).val();
    let slug = name.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
    $("#slug").val(slug);
})

    $(document).on("keyup change", ".discount_percentage", function(event) {
        let discount = $(this).val();
        let mrp = $(this).closest('.form-group').find('.mrp').val();
        if (discount > 0 && discount < 100) {
            let discountedprice = parseFloat(mrp) - (mrp * discount / 100);
            $(this).closest('.form-group').find('.price').val(discountedprice);
        } else {
            $(this).val('0');
            $(this).closest('.form-group').find('.price').val(mrp);
        }
    });
    

    
$(document).ready(function(){
    $("#category").change(function(){
        var data = $(this).val();
        let formData = new FormData();
        formData.append('id',data);
        $("#subcategory_id").html("");
        $.ajax({
            url: `{{ URL::to('admin/fetch-subcategory-by-category') }}`,
                type: 'POST',
                processData: false,
                contentType: false,
                dataType: 'json',
                data: formData,
                context: this,
                success: function(result) {
                    console.log(result);
                    var data = result.length
                    var html="";
                    if(result.length > 0){
                        $("#subcategory").removeAttr("style")
                        for(let x=0;x<data;x++){
                            $("#subcategory_id").append(`<option value="${result[x]['id']}">${result[x]['name']}</option>`);
                    } 
                    }else{
                        $("#subcategory").css("display","none")
                    }
                   
                }

        })
    })
})
        $(document).on("keyup", "#meta_title", function(event) {
            let title = $(this).val();
            $('#meta-title-limit').html(`We recommend title between 50–60 characters.(${title.length} character)`);
        });

        $(document).on("keyup", "#meta_description", function(event) {
            let title = $(this).val();
            $('#meta-description-limit').html(`We recommend descriptions between 50–160 characters.(${title.length} character)`);
        });

        // $('#brand').select2();
        // $('#category').select2();

     $(document).ready(function() {
  // Function to generate the image previews for a specific input field
  function readURL(input, previewContainer) {
    if (input.files && input.files.length > 0) {
      $(previewContainer).empty(); // Clear previous previews

      for (let i = 0; i < input.files.length; i++) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
          const imagePreview = `<span class="close1" data-id="">&times;</span>
                			     <img src="${e.target.result}" style="height: 50px; width: 50px;" />`;
          $(previewContainer).append(imagePreview);
        }
        
        reader.readAsDataURL(input.files[i]);
      }
    }
  }

  // Trigger the function for each input field when a file is selected
  $("body").on("change",'.imageInput',function() {
    const previewContainer = $(this).next('.imagePreviewContainer');
    readURL(this, previewContainer);
  });
});
$(document).ready(function() {
  $(document).on('click', '.close1' ,function(e) {
    e.preventDefault();
      var pid = $(this).data("id"); 
      $(this).parent().parent().find('img:first','span:first').remove()
        $(this).remove();
  });
});

        $(document).on("submit", "#addproduct", function(event) {
             event.preventDefault();
            $(this).attr('disabled', true);
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
            $(".validation-err").html("");
                  let formData = new FormData();
      // formData.append('brand', $('#brand').val());
      formData.append('name', $('#name').val());
      formData.append('category', $('#category').val());
      formData.append('default_price', $('#default_price').val());
      formData.append('name_ar', $('#name_ar').val());
      formData.append('slug', $('#slug').val());
      formData.append('product_code', $('#product_code').val());
      formData.append('alert_quantity', $('#alert_quantity').val());
      formData.append('youtube_code', $('#youtube_code').val());
      formData.append('fabric', $('#fabric').val());
    //   $('.imageInput').each(function(index, element) {
    //   const imageFiles = $(element)[0].files;
    //   for (let i = 0; i < imageFiles.length; i++) {
    //     formData.append('images[]', imageFiles[i]);
    //   }
    // });
//       var totalfiles = document.getElementsByName('image').files.length;
//   for (var index = 0; index < totalfiles; index++) {
//       formData.append("image[]", document.getElementsByName('image').files[index]);
//   }
      formData.append('image', (typeof $('#upload')[0].files[0] == 'undefined') ? '' : $('#upload')[0].files[0]);
      formData.append('image2', (typeof $('#upload2')[0].files[0] == 'undefined') ? '' : $('#upload2')[0].files[0]);
      formData.append('image3', (typeof $('#upload3')[0].files[0] == 'undefined') ? '' : $('#upload3')[0].files[0]);
      formData.append('image4', (typeof $('#upload4')[0].files[0] == 'undefined') ? '' : $('#upload4')[0].files[0]);
      formData.append('image5', (typeof $('#upload5')[0].files[0] == 'undefined') ? '' : $('#upload5')[0].files[0]);
      formData.append('image6', (typeof $('#upload6')[0].files[0] == 'undefined') ? '' : $('#upload6')[0].files[0]);
      formData.append('status', $('#status').val());
      formData.append('is_premium', $('#is_premium:checked').val() ? 'yes' : 'no');
      formData.append('is_top', "no");
      formData.append('is_hotDeals', $('#is_hotDeals:checked').val() ? 'yes' : 'no');
      formData.append('is_popular', $('#is_popular:checked').val() ? 'yes' : 'no');
      formData.append('has_cash_on_delivery', $('#has_cash_on_delivery:checked').val() ? 'yes' : 'no');
      formData.append('allow_rating', $('#allow_rating:checked').val() ? 'yes' : 'no');
      formData.append('short_description', $('#short_description').val());
      formData.append('short_description_ar', $('#short_description_ar').val());
      formData.append('description', $('#description').val());
      formData.append('description_ar', $('#description_ar').val());
      formData.append('additional_information', $('#additional_information').val());
      formData.append('additional_information_ar', $('#additional_information_ar').val());
      formData.append('default_price', $('#default_price').val());
      formData.append('shipping_information', $('#shipping_information').val());
      formData.append('shipping_information_ar', $('#shipping_information_ar').val());
      formData.append('subcategory_id', $('#subcategory_id').val());
      formData.append('replacement_waranty', $('#replacement_waranty:checked').val() ? "yes" : "no");
      formData.append('new_arrivals', $('#new_arrivals:checked').val() ? "yes" : "no");
      formData.append('cancellation_allowed', $('#cancellation_allowed:checked').val() ? "yes" : "no");
      formData.append('express_sheeping', $('#express_sheeping:checked').val() ? "yes" : "no");
      formData.append('terms_condition', $('#terms_condition').val());
      formData.append('canonical_tags', $('#canonical_tags').val());
      formData.append('twitter_cards', $('#twitter_cards').val());
      formData.append('og_tags', $('#og_tags').val());
      formData.append('part_number', $('#part_number').val());
      
      var fragrance = [];
            $.each($("input[name='fragrance[]']:checked"), function(){            
                fragrance.push($(this).val());
            });
            
      formData.append('fragrance', fragrance);
     let count1 = 0;
      // formData.append('attribute_options', attribute_options);
      var data = $("select[name='brand[]']").length;
      let variant_options = $('.block').map((e, i) => {
    //      $('.imageInput').each(function(index, element) {
    //   const imageFiles = $(element)[0].files;
    //   for (let i = 0; i < imageFiles.length; i++) {
    //     formData.append('images[]', imageFiles[i]);
    //   }
    // });
        // var newdata = [];
        // var stockdata = [];
        // var mrpdata = [];
        // var discountdata = [];
        // var pricedata = [];
        // for (i = 1; i <= data; i++) {
        //   newdata.push($("input[name='brandmodel" + i + "[]']:checked").map(function() {
        //     return $(this).val();
        //   }).get());
        //   stockdata.push($("input[name='stock" + i + "[]']").map(function() {
        //     return $(this).val();
        //   }).get());
        //   mrpdata.push($("input[name='mrp" + i + "[]']").map(function() {
        //     return $(this).val();
        //   }).get());
        //   discountdata.push($("input[name='discount_percentage" + i + "[]']").map(function() {
        //     return $(this).val();
        //   }).get());
        //   pricedata.push($("input[name='price" + i + "[]']").map(function() {
        //     return $(this).val();
        //   }).get());
        // }
        return {
            brand: $("select[name='brand[]']").map(function() {
                return $(this).val();
            }).get(),
            stock: $("input[name='stock[]']").map(function() {
                return $(this).val();
            }).get(),
            mrp: $("input[name='mrp[]']").map(function() {
                return $(this).val();
            }).get(),
            optionimage: $("input[name='images[]']").map(function(index, element) {
                 const imageFiles = $(element)[0].files;
                  for (let i = 0; i < imageFiles.length; i++) {
                    formData.append('images[]', imageFiles[i]);
                  }
                  console.log(imageFiles.length)
                return imageFiles.length;
            }).get(),
            discount_percentage: $("input[name='discount_percentage[]']").map(function() {
                return $(this).val();
            }).get(),
            price: $("input[name='price[]']").map(function() {
                return $(this).val();
            }).get(),
        }
        
        data--;
      }).toArray();
      formData.append('variant_options', JSON.stringify(variant_options));
      formData.append('meta_title', $('#meta_title').val());
      formData.append('meta_title_ar', $('#meta_title_ar').val());
      formData.append('meta_description', $('#meta_description').val());
      formData.append('meta_description_ar', $('#meta_description_ar').val());
      formData.append('meta_keyword', $('#meta_keyword').val());
      formData.append('meta_keyword_ar', $('#meta_keyword_ar').val());
            $.ajax({
                url: "{{ URL::to('admin/manage-product') }}",
                type: 'POST',
                processData: false,
                contentType: false,
                dataType: 'json',
                data: formData,
                context: this,
                success: function(result) {
                    if (result.success) {
                      window.location = "{{ URL::to('admin/manage-product') }}";
                    } else {
                        $(this).attr('disabled', false);
                        if (result.code == 422) {
                            for (const key in result.errors) {
                                $(`#${key}-err`).html(result.errors[key][0]);
                            }
                            $("#validation-err").html("Fill all required fields");
                        } else {
                            console.log(result);
                        }
                    }
                }
            });
        });
    });
    //new code for adding - begin
    var count =1;
        $("body").on("click",".add-more",function(){
            count++;
            // $().find("input[type=checkbox]").attr("disabled", true );
            $(".after-add-more").last().find("input[type=checkbox]").attr("disabled", true );
            $(".after-add-more").last().find("#brand").attr("disabled", true );
            var html = $(".after-add-more").first().clone();
            $(html).find("input[type=text]").val('');
            $(html).find("input[type=number]").val('');
            $(html).find("#brandmodel").html(" ");
            $(html).find("#contentall").html(" ");
            $(html).find(".imagePreviewContainer").html(" ");
            $(html).find("input[type=checkbox]").attr("disabled", false );
            $(html).find("#brand").attr("disabled", false );
            $(html).find("input[type=checkbox]").prop("checked", false );
            //  $(html).find(".change").prepend("<label for=''>&nbsp;</label><br/><a class='btn btn-danger remove'>- Remove</a>");
              $(html).find(".change").html("<label for=''>&nbsp;</label><br/><a class='btn btn-danger remove'>- Remove</a>");
            $(".after-add-more").last().after(html);
        });
        $("body").on("click",".remove",function(){
            count--;
            $(this).parents(".after-add-more").remove();
        });
        //end
    
 
    $(document).ready(function(){
        $(".block").on("click", "#ckbCheckAll", function() { 
            // $(this).closest().find("#brandmodel .brandmodel").prop('checked', $(this).prop('checked'));
            // $(".block .after-add-more #ckbCheckAll").find("#brandmodel brandmodel").prop('checked', $(this).prop('checked'));
            $(".after-add-more").last().find("#brandmodel .brandmodel").prop('checked', $(this).prop('checked'));
            // $(".brandmodel").prop('checked', $(this).prop('checked'));
        });
        
        $(document).on("click",".brandmodel",function(){
            var id = $(this).val();
            $(".contentprice"+id).css('display','block');
        });
        
         $(document).on("click", "#samepriceall", function(){ 
        //      $(".after-add-more").last().find("#brandmodel .brandmodel").prop('checked', $(this).prop('checked'));
        //   var id =   $(this).find('#contentp ').find('.price').val();
        //     console.log(id);
         });
    })
</script>
 <script>
//   $(document).ready(function() {
//     CKEDITOR.replace('description', {
//       filebrowserUploadUrl: "{{ route('admin.image-upload', ['_token' => csrf_token()]) }}",
//       filebrowserUploadMethod: 'form'
//     });
//     CKEDITOR.replace('additional_information', {
//       filebrowserUploadUrl: "{{ route('admin.image-upload', ['_token' => csrf_token()]) }}",
//       filebrowserUploadMethod: 'form'
//     });
//     CKEDITOR.replace('shipping_information', {
//       filebrowserUploadUrl: "{{ route('admin.image-upload', ['_token' => csrf_token()]) }}",
//       filebrowserUploadMethod: 'form'
//     });
//     CKEDITOR.replace('terms_condition', {
//       filebrowserUploadUrl: "{{ route('admin.image-upload', ['_token' => csrf_token()]) }}",
//       filebrowserUploadMethod: 'form'
//     });
//     CKEDITOR.replace('content');
//     $(document).on("keyup change", ".mrp", function(event) {
//       let mrp = $(this).val();
//       $(this).closest('.form-group #contentall #contentp').find('.discount_percentage').val('0');
//       $(this).closest('.form-group #contentall #contentp').find('.price').val(mrp);
//     });
//     $(document).on("keyup change", ".discount_percentage", function(event) {
//       let discount = $(this).val();
//       let mrp = $(this).closest('.form-group #contentall #contentp').find('.mrp').val();
//       if (discount > 0 && discount < 100) {
//         let discountedprice = parseFloat(mrp) - (mrp * discount / 100);
//         $(this).closest('.form-group #contentall #contentp').find('.price').val(discountedprice);
//       } else {
//         $(this).val('0');
//         $(this).closest('.form-group #contentall #contentp').find('.price').val(mrp);
//       }
//     });
//     $(document).ready(function() {
//       $("#category").change(function() {
//         var data = $(this).val();
//         let formData = new FormData();
//         formData.append('id', data);
//         $("#subcategory_id").html("");
//         $.ajax({
//           url: `{{ URL::to('admin/fetch-subcategory-by-category') }}`,
//           type: 'POST',
//           processData: false,
//           contentType: false,
//           dataType: 'json',
//           data: formData,
//           context: this,
//           success: function(result) {
//             console.log(result);
//             var data = result.length
//             var html = "";
//             for (let x = 0; x < data; x++) {
//               $("#subcategory_id").append(`
// 																					<option value="${result[x]['id']}">${result[x]['name']}</option>`);
//             }
//           }
//         })
//       })
//     })
//     $(document).on("keyup", "#meta_title", function(event) {
//       let title = $(this).val();
//       $('#meta-title-limit').html(`We recommend title between 50–60 characters.(${title.length} character)`);
//     });
//     $(document).on("keyup", "#meta_description", function(event) {
//       let title = $(this).val();
//       $('#meta-description-limit').html(`We recommend descriptions between 50–160 characters.(${title.length} character)`);
//     });
//     // $('#brand').select2();
//     // $('#category').select2();
//     $(document).on('click', '.attribute_options', function(event) {
//       $('#attribute_options-err').html('');
//       let attribute_options = $(".attribute_options:checked").map(function() {
//         return $(this).val();
//       }).toArray();
//       let formData = new FormData();
//       formData.append('attribute_options', attribute_options);
//       $.ajax({
//         url: `{{ URL::to('admin/fetch-childs-by-attributes') }}`,
//         type: 'POST',
//         processData: false,
//         contentType: false,
//         dataType: 'json',
//         data: formData,
//         context: this,
//         success: function(result) {
//           if (result.success) {
//             $(".attribute_name_1").html(`Choose ${result.attribute_name_1}`);
//             $(".attribute_1").html(result.attribute_1_childs);
//             $(".attribute_name_2").html(`Choose ${result.attribute_name_2}`);
//             $(".attribute_2").html(result.attribute_2_childs);
//           } else {
//             if (result.code == 422) {
//               for (const key in result.errors) {
//                 $(`#${key}-err`).html(result.errors[key][0]);
//               }
//             } else {}
//           }
//         }
//       })
//     });
//     $(document).on('keyup', "#name", function(event) {
//       let name = $(this).val();
//       let url = name.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
//       $("#slug").val(url);
//     })
//     // $(document).on("click", ".add", function(event) {
//     //     $('#attribute_options-err').html('');
//     //     let attribute_options = $(".attribute_options:checked").map(function() {
//     //         return $(this).val();
//     //     }).toArray();
//     //     let formData = new FormData();
//     //     formData.append('attribute_options', attribute_options);
//     //     $.ajax({
//     //         url: "{{ URL::to('admin/generate-product-row-by-attributes') }}",
//     //         type: 'POST',
//     //         processData: false,
//     //         contentType: false,
//     //         dataType: 'json',
//     //         data: formData,
//     //         context: this,
//     //         success: function(result) {
//     //             if (result.success) {
//     //                 $('.block:last').after(result.html);
//     //             }
//     //         }
//     //     })
//     // });
//     // // add
//     // $(".add").click(function () {
//     //     $('.optionBox').clone().insertAfter(this);
//     // });
//     // // remove
//     // $('.optionBox').on('click', '.remove', function() {
//     //     $(this).parent().parent().remove();
//     // });
//     $(document).on("click", "#add-product-btn", function(event) {
//       $(this).attr('disabled', true);
//       for (instance in CKEDITOR.instances) {
//         CKEDITOR.instances[instance].updateElement();
//       }
//       $(".validation-err").html("");
//       let formData = new FormData();
//       // formData.append('category', $(".category").map(function() {
//       //     return $(this).val();
//       // }).toArray());
//       // let attribute_options = $(".attribute_options:checked").map(function() {
//       //     return $(this).val();
//       // }).toArray();
//       // formData.append('brand', $('#brand').val());
//       formData.append('name', $('#name').val());
//       formData.append('category', $('#category').val());
//       formData.append('default_price', $('#default_price').val());
//       formData.append('name_ar', $('#name_ar').val());
//       formData.append('slug', $('#slug').val());
//       formData.append('alert_quantity', $('#alert_quantity').val());
//       formData.append('youtube_code', $('#youtube_code').val());
//       formData.append('fabric', $('#fabric').val());
//       formData.append('image', (typeof $('#image')[0].files[0] == 'undefined') ? '' : $('#image')[0].files[0]);
//       formData.append('status', $('#status').val());
//       formData.append('is_featured', $('#is_featured:checked').val() ? 'yes' : 'no');
//       formData.append('is_premium', $('#is_premium:checked').val() ? 'yes' : 'no');
//       formData.append('is_bestSales', $('#is_bestSales:checked').val() ? 'yes' : 'no');
//       formData.append('is_hotDeals', $('#is_hotDeals:checked').val() ? 'yes' : 'no');
//       formData.append('is_popular', $('#is_popular:checked').val() ? 'yes' : 'no');
//       formData.append('has_cash_on_delivery', $('#has_cash_on_delivery:checked').val() ? 'yes' : 'no');
//       formData.append('allow_rating', $('#allow_rating:checked').val() ? 'yes' : 'no');
//       formData.append('short_description', $('#short_description').val());
//       formData.append('short_description_ar', $('#short_description_ar').val());
//       formData.append('description', $('#description').val());
//       formData.append('description_ar', $('#description_ar').val());
//       formData.append('additional_information', $('#additional_information').val());
//       formData.append('additional_information_ar', $('#additional_information_ar').val());
//       formData.append('default_price', $('#default_price').val());
//       formData.append('shipping_information', $('#shipping_information').val());
//       formData.append('shipping_information_ar', $('#shipping_information_ar').val());
//       formData.append('subcategory_id', $('#subcategory_id').val());
//       formData.append('replacement_waranty', $('#replacement_waranty:checked').val() ? "yes" : "no");
//       formData.append('top_selling', $('#top_selling:checked').val() ? "yes" : "no");
//       formData.append('cancellation_allowed', $('#cancellation_allowed:checked').val() ? "yes" : "no");
//       formData.append('express_sheeping', $('#express_sheeping:checked').val() ? "yes" : "no");
//       formData.append('terms_condition', $('#terms_condition').val());
//       formData.append('canonical_tags', $('#canonical_tags').val());
//       formData.append('twitter_cards', $('#twitter_cards').val());
//       formData.append('og_tags', $('#og_tags').val());
//       formData.append('part_number', $('#part_number').val());
//       // formData.append('attribute_options', attribute_options);
//       var data = $("select[name='brand[]']").length;
//       let variant_options = $('.block').map((e, i) => {
//         var newdata = [];
//         var stockdata = [];
//         var mrpdata = [];
//         var discountdata = [];
//         var pricedata = [];
//         for (i = 1; i <= data; i++) {
//           newdata.push($("input[name='brandmodel" + i + "[]']:checked").map(function() {
//             return $(this).val();
//           }).get());
//           stockdata.push($("input[name='stock" + i + "[]']").map(function() {
//             return $(this).val();
//           }).get());
//           mrpdata.push($("input[name='mrp" + i + "[]']").map(function() {
//             return $(this).val();
//           }).get());
//           discountdata.push($("input[name='discount_percentage" + i + "[]']").map(function() {
//             return $(this).val();
//           }).get());
//           pricedata.push($("input[name='price" + i + "[]']").map(function() {
//             return $(this).val();
//           }).get());
//         }
//         return {
//           brand: $("select[name='brand[]']").map(function() {
//             return $(this).val();
//           }).get(),
//           brandmodel: newdata,
//           category: $("select[name='category[]']").map(function() {
//             return $(this).val();
//           }).get(),
//           stock: stockdata,
//           mrp: mrpdata,
//           discount_percentage: discountdata,
//           price: pricedata,
//         }
//         data--;
//       }).toArray();
//       formData.append('variant_options', JSON.stringify(variant_options));
//       formData.append('meta_title', $('#meta_title').val());
//       formData.append('meta_title_ar', $('#meta_title_ar').val());
//       formData.append('meta_description', $('#meta_description').val());
//       formData.append('meta_description_ar', $('#meta_description_ar').val());
//       formData.append('meta_keyword', $('#meta_keyword').val());
//       formData.append('meta_keyword_ar', $('#meta_keyword_ar').val());
//       $.ajax({
//         url: "{{ URL::to('admin/manage-product') }}",
//         type: 'POST',
//         processData: false,
//         contentType: false,
//         dataType: 'json',
//         data: formData,
//         context: this,
//         success: function(result) {
//           if (result.success) {
//             window.location = "{{ URL::to('admin/manage-product') }}";
//           } else {
//             $(this).attr('disabled', false);
//             if (result.code == 422) {
//               for (const key in result.errors) {
//                 $(`#${key}-err`).html(result.errors[key][0]);
//               }
//               $("#validation-err").html("Fill all required fields");
//             } else {
//               console.log(result);
//             }
//           }
//         }
//       });
//     });
//   });
//   //new code for adding - begin
//   var count = 1;
//   $("body").on("click", ".add-more", function() {
//         count++;
//         // $().find("input[type=checkbox]").attr("disabled", true );
//         $(".after-add-more").last().find("input[type=checkbox]").attr("disabled", true);
//         $(".after-add-more").last().find("#brand").attr("disabled", true);
//         var html = $(".after-add-more").first().clone();
//         $(html).find("input[type=text]").val('');
//         $(html).find("input[type=number]").val('');
//         $(html).find("#brandmodel").html(" ");
//         $(html).find("#contentall").html(" ");
//         $(html).find("input[type=checkbox]").attr("disabled", false);
//         $(html).find("#brand").attr("disabled", false);
//         $(html).find("input[type=checkbox]").prop("checked", false);
//         //  $(html).find(".change").prepend("
//         < label
//         for = '' > & nbsp; < /label> < br / > < a class = 'btn btn-danger remove' > -Remove < /a>");
//         $(html).find(".change").html(" < label
//           for = '' > & nbsp; < /label> < br / > < a class = 'btn btn-danger remove' > -Remove < /a>");
//           $(".after-add-more").last().after(html);
//         }); $("body").on("click", ".remove", function() {
//         count--;
//         $(this).parents(".after-add-more").remove();
//       });
//       //end
//       $(".block").on("change", "#brand", function() {
//         var brandid = $(this).val();
//         var brandmodel = $(".brandmodel:checked").map(function() {
//           return $(this).val();
//         }).get()
//         console.log(brandmodel)
//         let formData = new FormData();
//         formData.append('brandid', brandid);
//         $(".after-add-more").last().find("#brandmodel").html("");
//         $(".after-add-more").last().find("#contentall").html("");
//         $.ajax({
//           url: "{{ URL::to('admin/getbrandmodel') }}",
//           type: 'POST',
//           processData: false,
//           contentType: false,
//           dataType: 'json',
//           data: formData,
//           success: function(result) {
//             if (result.length > 0) {
//               for (let i = 0; i < result.length; i++) {
//                 console.log(brandmodel.indexOf(result[i]['id'].toString()) !== -1)
//                 if (count == 1) {
//                   // document.getElementById("brandmodel").innerHTML  +=  `
//                   < option value = "${result[i]['id']}" > $ {
//                     result[i]['name']
//                   } < /option` ; 
//                   $(".after-add-more").last().find("#brandmodel").append(`
                        
// 																					<input class="form-control brandmodel" name="brandmodel${count}[]" type="checkbox" value="${result[i]['id']}" />${result[i]['name']}
//                         `);
//                 }
//                 if (count != 1) {
//                   if (!(brandmodel.indexOf(result[i]['id'].toString()) !== -1)) {
//                     $(".after-add-more").last().find("#brandmodel").append(`
                        
// 																					<input class="form-control brandmodel" name="brandmodel${count}[]" type="checkbox" value="${result[i]['id']}" />${result[i]['name']}
//                         `);
//                   }
//                 }
//               }
//               for (let i = 0; i < result.length; i++) {
//                 if (count == 1) {
//                   // document.getElementById("brandmodel").innerHTML  +=  `
//                   < option value = "${result[i]['id']}" > $ {
//                     result[i]['name']
//                   } < /option` ; 
//                   $(".after-add-more").last().find("#contentall").append(`
                         
// 																					<div class="contentprice${result[i]['id']}" style="display:none" id="contentp">
// 																						<div class="col-sm-1 stock" >
// 																							<label class="label-control">Stock</label>
// 																							<input type="number" class="form-control stock" min="1" name="stock${count}[]" value="1">
// 																								<div class="text-danger validation-err" id="stock-err"></div>
// 																							</div>
// 																							<div class="col-sm-1" >
// 																								<label class="label-control">MRP</label>
// 																								<input type="number" placeholder="MRP" class="form-control mrp" min="1" name="mrp${count}[]" value="1">
// 																									<div class="text-danger validation-err" id="mrp-err"></div>
// 																								</div>
// 																								<div class="col-sm-1" >
// 																									<label class="label-control">Discount(%)</label>
// 																									<input type="number" class="form-control discount_percentage" min="1" max="100" name="discount_percentage${count}[]" value="0">
// 																										<div class="text-danger validation-err" id="discount_percentage-err"></div>
// 																									</div>
// 																									<div class="col-sm-1" >
// 																										<label class="label-control">Price</label>
// 																										<input type="number" placeholder="Price" class="form-control price" readonly min="1" name="price${count}[]" value="1">
// 																											<div class="text-danger validation-err" id="price-err"></div>
// 																										</div>
// 																									</div>
// 																									<br></br>
// 																									<br></br>
//                         `);
//                 }
//                 if (count != 1) {
//                   if (!(brandmodel.indexOf(result[i]['id'].toString()) !== -1)) {
//                     $(".after-add-more").last().find("#contentall").append(`
                                
// 																									<div class="contentprice${result[i]['id']}" style="display:none" id="contentp">
// 																										<div class="col-sm-1">
// 																											<label class="label-control">Stock</label>
// 																											<input type="number" class="form-control stock" min="1" name="stock${count}[]" value="1">
// 																												<div class="text-danger validation-err" id="stock-err"></div>
// 																											</div>
// 																											<div class="col-sm-1">
// 																												<label class="label-control">MRP</label>
// 																												<input type="number" placeholder="MRP" class="form-control mrp" min="1" name="mrp${count}[]" value="1">
// 																													<div class="text-danger validation-err" id="mrp-err"></div>
// 																												</div>
// 																												<div class="col-sm-1">
// 																													<label class="label-control">Discount(%)</label>
// 																													<input type="number" class="form-control discount_percentage" min="1" max="100" name="discount_percentage${count}[]" value="0">
// 																														<div class="text-danger validation-err" id="discount_percentage-err"></div>
// 																													</div>
// 																													<div class="col-sm-1">
// 																														<label class="label-control">Price</label>
// 																														<input type="number" placeholder="Price" class="form-control price" readonly min="1" name="price${count}[]" value="1">
// 																															<div class="text-danger validation-err" id="price-err"></div>
// 																														</div>
                    
//                         `);
//                   }
//                 }
//               }
//             }
//           }
//         });
//       }); $(document).ready(function() {
//         $(".block").on("click", "#ckbCheckAll", function() {
//           // $(this).closest().find("#brandmodel .brandmodel").prop('checked', $(this).prop('checked'));
//           // $(".block .after-add-more #ckbCheckAll").find("#brandmodel brandmodel").prop('checked', $(this).prop('checked'));
//           $(".after-add-more").last().find("#brandmodel .brandmodel").prop('checked', $(this).prop('checked'));
//           // $(".brandmodel").prop('checked', $(this).prop('checked'));
//         });
//         $(document).on("click", ".brandmodel", function() {
//           var id = $(this).val();
//           $(".contentprice" + id).css('display', 'block');
//         });
//         $(document).on("click", "#samepriceall", function() {
//           //      $(".after-add-more").last().find("#brandmodel .brandmodel").prop('checked', $(this).prop('checked'));
//           //   var id =   $(this).find('#contentp ').find('.price').val();
//           //     console.log(id);
//         });
//       })
</script>
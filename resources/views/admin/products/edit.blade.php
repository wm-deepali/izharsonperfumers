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
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.manage-product.index') }}">Manage
                                    Products</a></li>
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
                                <h4 class="card-title">Edit</h4>
                                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                         <li><a data-action="reload" href="javascript:location.reload()"><i class="fa fa-refresh"></i> Refresh</a></li>
                                        <li><a href="javascript:history.go(-1)"><i class="fa fa-backward"></i> Go
                                                Back</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body collapse in">
                                 <div class="card">
                                        <div class="card-body">
                                            <div class="card-block">
                                                <form>
                                               <div class="col-xl-8 col-lg-8">
                                   
                                                
                                                    <!--<ul class="nav nav-tabs nav-top-border no-hover-bg nav-justified">-->
                                                    <!--    <li class="nav-item">-->
                                                    <!--        <a class="nav-link active general-tab" id="active-tab1"-->
                                                    <!--            data-toggle="tab" href="#active1"-->
                                                    <!--            aria-controls="active1" aria-expanded="true">General</a>-->
                                                    <!--    </li>-->
                                                    <!--    <li class="nav-item">-->
                                                    <!--        <a class="nav-link option-tab" id="link-tab3"-->
                                                    <!--            data-toggle="tab" href="#link3" aria-controls="link3"-->
                                                    <!--            aria-expanded="false">Edit Variants</a>-->
                                                    <!--    </li>-->

                                                    <!--    <li class="nav-item">-->
                                                    <!--        <a class="nav-link seo-tab" id="link-tab2" data-toggle="tab"-->
                                                    <!--            href="#link2" aria-controls="link2"-->
                                                    <!--            aria-expanded="false">SEO</a>-->
                                                    <!--    </li>-->
                                                    <!--</ul>-->
                                                    <div class="tab-content pt-1">
                                                        <div id="active1">
                                                            <div class="form-body">
                                                                <div class="form-group row">
                                                                    <div class="col-md-4 col-sm-4 col-lg-6">
                                                                        <label class="label-control">Category </label>
                                                                        <select class="form-control category"
                                                                            name="category[]" id="category" required>
                                                                            <option>Select</option>
                                                                            <!-- <option value="all">All</option> -->
                                                                            @if (isset($categories) &&
                                                                            count($categories) > 0)
                                                                            @foreach ($categories as $category)
                                                                            <option value='{{ $category->id }}'
                                                                                @if(isset($product->category_id))
                                                                                @if($category->id ==
                                                                                $product->category_id)
                                                                                selected @endif @endif
                                                                                >{{ $category->name }}</option>
                                                                            
                                                                            @endforeach
                                                                            @endif
                                                                        </select>
                                                                        <div class="text-danger validation-err"
                                                                            id="category-err"></div>
                                                                    </div>

                                                                    <div class="col-md-4 col-sm-3 col-lg-6" id="subcategory"  <?php if($product->subcategory_id){ echo "style='display:none'"; } ?>>
                                                                        <label class="label-control">Sub Category*
                                                                        </label>
                                                                        <select class="form-control"
                                                                            placeholder="Enter Sub Category"
                                                                            name="subcategory_id" id="subcategory_id">
                                                                            <option>Select</option>
                                                                            @foreach($subcategory as $subcategory)
                                                                            <option value="{{ $subcategory->id }}"
                                                                                @if($subcategory->id ==
                                                                                $product->subcategory_id) selected
                                                                                @endif>{{ $subcategory->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        <div class="text-danger validation-err"
                                                                            id="subcategory_id-err"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-md-4 col-sm-4 col-lg-6">
                                                                        <label class="label-control">Product Name*
                                                                        </label>
                                                                        <input type="text" class="form-control"
                                                                            placeholder="Enter Product name" name="name"
                                                                            id="name" value="{{ $product->name }}">
                                                                        <div class="text-danger validation-err"
                                                                            id="name-err"></div>
                                                                    </div>
                                                                    <div class="col-md-6 col-sm-6 col-lg-6">
                                                                        <label class="label-control">Product Code*
                                                                        </label>
                                                                        <input type="text" class="form-control"
                                                                            placeholder="Enter Product Code" value="{{ $product->product_code }}" name="product_code"
                                                                            id="product_code">
                                                                        <div class="text-danger validation-err"
                                                                            id="product_code-err"></div>
                                                                   </div>
                                                                   
                                                                </div>

                                                                <div class="form-group row">
                                                                    <div class="col-md-6 col-sm-6 col-lg-6">
                                                                        <label class="label-control">URL Slug*
                                                                        </label>
                                                                        <input type="text" class="form-control"
                                                                            placeholder="Enter URL Slug" name="slug"
                                                                            id="slug" value="{{ $product->slug }}">
                                                                        <div class="text-danger validation-err"
                                                                            id="slug-err"></div>
                                                                    </div>
                                                                    <div class="col-md-6 col-sm-6 col-lg-6">
                                                                        <label class="label-control">Alert
                                                                            Quantity*</label>
                                                                        <input type="text" class="form-control"
                                                                            placeholder="Enter quantity"
                                                                            name="alert_quantity" id="alert_quantity"
                                                                            value="{{ $product->alert_quantity }}">
                                                                        <div class="text-danger validation-err"
                                                                            id="alert_quantity-err"></div>
                                                                    </div>
                                                                    
                                                                </div>
                                                                        

                                                                <div class="form-group row">
                                                                    <!-- <div class="col-md-4 col-sm-4 col-lg-4">
                                                                        <label class="label-control">Fabric </label>
                                                                        <input type="text" placeholder="Enter Fabric" class="form-control" name="fabric" id="fabric" value="{{ $product->fabric }}">
                                                                        <div class="text-danger validation-err" id="fabric-err"></div>
                                                                    </div> -->
                                                                    
                                                                     <div class="col-md-6 col-sm-6 col-lg-6">
                                                                        <label class="label-control">Status*</label>
                                                                        <select class="form-control" name="status"
                                                                            id="status">
                                                                            <option value="active" @if ($product->status
                                                                                == 'active') selected @endif>Active
                                                                            </option>
                                                                            <option value="block" @if ($product->status
                                                                                == 'block') selected @endif>De-Active
                                                                            </option>
                                                                        </select>
                                                                        <div class="text-danger validation-err"
                                                                            id="status-err"></div>
                                                                    </div>
                                                                    <div class="col-md-6 col-sm-6 col-lg-6">
                                                                        <label class="label-control">Default Price
                                                                        </label>
                                                                        <input type="number" class="form-control"
                                                                            placeholder="Enter Default Price"
                                                                            name="default_price" id="default_price"
                                                                            value="{{ $product->product_options[0]->default_price }}">
                                                                        <div class="text-danger validation-err"
                                                                            id="default_price-err"></div>
                                                                    </div>
                                                                </div>

                                                                
                                                                <div class="form-group row">
                                                                    <div class="col-md-12">
                                                                        <label class="label-control"> Short Description*
                                                                        </label>
                                                                        <textarea class="form-control" cols="4" rows="2"
                                                                            placeholder="Enter Detail"
                                                                            name="short_description"
                                                                            id="short_description">{{ $product->short_description }}</textarea>
                                                                        <div class="text-danger validation-err"
                                                                            id="short_description-err"></div>
                                                                    </div>
                                                                </div>
                                                               
                                                                <div class="form-group row">
                                                                    <div class="col-md-12">
                                                                        <label class="label-control"> Description*
                                                                        </label>
                                                                        <textarea class="form-control" cols="4" rows="2"
                                                                            placeholder="Enter Detail"
                                                                            name="description"
                                                                            id="description">{{ $product->description }}</textarea>
                                                                        <div class="text-danger validation-err"
                                                                            id="description-err"></div>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="form-group row">
                                                                    <div class="col-md-12">
                                                                        <label class="label-control"> Additional
                                                                            Information* </label>
                                                                        <textarea class="form-control" cols="4" rows="2"
                                                                            placeholder="Enter Detail"
                                                                            name="additional_information"
                                                                            id="additional_information">{{ $product->additional_information }}</textarea>
                                                                        <div class="text-danger validation-err"
                                                                            id="additional_information-err"></div>
                                                                    </div>
                                                                </div>
                                                               
                                                                <div class="form-group row">
                                                                    <div class="col-md-12">
                                                                        <label class="label-control"> Shipping
                                                                            Information* </label>
                                                                        <textarea class="form-control" cols="4" rows="2"
                                                                            placeholder="Enter Detail"
                                                                            name="shipping_information"
                                                                            id="shipping_information">{{ $product->shipping_information }}</textarea>
                                                                        <div class="text-danger validation-err"
                                                                            id="shipping_information-err"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-md-12">
                                                                        <label class="label-control"> Terms &
                                                                            Conditions* </label>
                                                                        <textarea class="form-control" cols="4" rows="2"
                                                                            placeholder="Enter Detail"
                                                                            name="terms_condition"
                                                                            id="terms_condition">{{ $product->terms_condition }}</textarea>
                                                                        <div class="text-danger validation-err"
                                                                            id="terms_condition-err"></div>
                                                                    </div>
                                                                </div>
                                                               
                                                            </div>
                                                        </div>


                                                       
                                    </div>
                                   
                                
                                    </div>
                                <div class="col-lg-4">
                                    
                                     <div class="form-group row">
                             	
                                                <div class="col-md-4 col-sm-4 col-lg-4">
                                                    <label>Product Image (400*350)</label>
                                        		<label for="upload" class="filelabel">
                                        			<input type="file"  id="upload" name="image">
                                        			
                                        			@if(isset($product->product_option_images[0]))
                                        		    @if (Storage::exists($product->product_option_images[0]->image))
                                        		    <span class="close" data-id="{{$product->product_option_images[0]->id}}">&times;</span>
                                                <img id="blash1" src="{{ URL::asset('storage/' . $product->product_option_images[0]->image) }}"
                                                    alt="{{ $product->name }}" height="75"
                                                    width="75">
                                                    
                                                @endif
                                                @else
                                                <img style="height:100px;width:100px;display:none" id="blah1" src="#" alt="your image"  />
                                                <i class="fa fa-plus" id="icon1"></i>
                                                   @endif
                                        		</label>
                                        		<div class="text-danger validation-err"
                                                                            id="image-err"></div>
                                                </div>
                                                <div class="col-md-4 col-sm-4 col-lg-4">
                                                     <label>Product Image (400*350)</label>
                                        		<label for="upload2" class="filelabel">
                                        			<input type="file" id="upload2" name="image2">
                                        				@if(isset($product->product_option_images[1]))
                                        	            @if (Storage::exists($product->product_option_images[1]->image))
                                        	             <span class="close" data-id="{{$product->product_option_images[1]->id}}">&times;</span>
                                                <img id="blash2" src="{{ URL::asset('storage/' . $product->product_option_images[1]->image) }}"
                                                    alt="{{ $product->name }}" height="75"
                                                    width="75">
                                                @endif
                                                 @else
                                                <img style="height:100px;width:100px;display:none" id="blah2" src="#" alt="your image"  />
                                                <i class="fa fa-plus" id="icon1"></i>
                                                   @endif
                                                
                                        		</label>
                                        		<div class="text-danger validation-err"
                                                                            id="image2-err"></div>
                                                </div>
                                                <div class="col-md-4 col-sm-4 col-lg-4">
                                                     <label>Product Image (400*350)</label>
                                        		<label for="upload3" class="filelabel">
                                        			<input type="file" id="upload3"  name="image3" >
                                        				@if(isset($product->product_option_images[2]))
                                        	           @if (Storage::exists($product->product_option_images[2]->image))
                                        	           
                                        	            <span class="close" data-id="{{$product->product_option_images[2]->id}}">&times;</span>
                                                <img id="blash3" src="{{ URL::asset('storage/' . $product->product_option_images[2]->image) }}"
                                                    alt="{{ $product->name }}" height="75"
                                                    width="75">
                                                @endif
                                                 @else
                                                <img style="height:100px;width:100px;display:none" id="blah3" src="#" alt="your image"  />
                                                <i class="fa fa-plus" id="icon1"></i>
                                                   @endif
                                                
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
                                				@if(isset($product->product_option_images[3]))
                                	            @if (Storage::exists($product->product_option_images[3]->image))
                                	             <span class="close" data-id="{{$product->product_option_images[3]->id}}">&times;</span>
                                        <img id="blash4" src="{{ URL::asset('storage/' . $product->product_option_images[3]->image) }}"
                                            alt="{{ $product->name }}" height="75"
                                            width="75">
                                        @endif
                                         @else
                                        <img style="height:100px;width:100px;display:none" id="blah4" src="#" alt="your image"  />
                                        <i class="fa fa-plus" id="icon1"></i>
                                           @endif
                                         
                                		</label>
                                		<div class="text-danger validation-err"
                                                                            id="image4-err"></div>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-lg-4">
                                             <label>Product Image (400*350)</label>
                                		<label for="upload5" class="filelabel">
                                			<input type="file" id="upload5"  name="image5" >
                                			@if(isset($product->product_option_images[4]))
                                	             @if (Storage::exists($product->product_option_images[4]->image))
                                	              <span class="close" data-id="{{$product->product_option_images[4]->id}}">&times;</span>
                                        <img id="blash5" src="{{ URL::asset('storage/' . $product->product_option_images[4]->image) }}"
                                            alt="{{ $product->name }}" height="75"
                                            width="75">
                                        @endif
                                         @else
                                        <img style="height:100px;width:100px;display:none" id="blah5" src="#" alt="your image"  />
                                        <i class="fa fa-plus" id="icon1"></i>
                                           @endif
                                       
                                		</label>
                                		<div class="text-danger validation-err"
                                                                            id="image5-err"></div>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-lg-4">
                                             <label>Product Image (400*350)</label>
                                		<label for="upload6" class="filelabel">
                                			<input type="file" id="upload6"  name="image6" >
                                		
                                				@if(isset($product->product_option_images[5]))
                                	           @if (Storage::exists($product->product_option_images[5]->image))
                                	            <span class="close" data-id="{{$product->product_option_images[5]->id}}">&times;</span>
                                        <img id="blash6" src="{{ URL::asset('storage/' . $product->product_option_images[5]->image) }}"
                                            alt="{{ $product->name }}" height="75"
                                            width="75">
                                        @endif
                                         @else
                                        <img style="height:100px;width:100px;display:none" id="blah6" src="#" alt="your image"  />
                                        <i class="fa fa-plus" id="icon1"></i>
                                           @endif
                                		</label>
                                        </div>
                                        <div class="text-danger validation-err"
                                                                            id="image6-err"></div>
                                        </div>
                                        
                                         <div class="form-group row">
                                        <div class="col-md-12 col-sm-12 col-lg-12">
                                                <label class="label-control">Youtube URL
                                                </label>
                                                <input type="text"
                                                    placeholder="Enter Youtube URL"
                                                    class="form-control" name="youtube_code"
                                                    id="youtube_code"
                                                    value="{{ $product->youtube_code }}">
                                                <div class="text-danger validation-err"
                                                    id="youtube_code-err"></div>
                                            </div>
                                        </div>
                                        <div class="row">

                                                                    <div class="col-md-6 col-sm-6 col-lg-6 form-group">
                                                                        <label class="label-control">Replacement
                                                                            Warranty </label><br/>
                                                                        <label class="switch">
                                                                            <input type="checkbox"
                                                                                name="replacement_waranty"
                                                                                @if($product->replacement_waranty =='yes') checked @endif
                                                                            id="replacement_waranty" value="yes"
                                                                                id="replacement_waranty" value="yes">
                                                                            <span class="slider round"></span>
                                                                        </label>
                                                                        <div class="text-danger validation-err"
                                                                            id="replacement_waranty-err"></div>
                                                                    </div>
                                                                    <div class="col-md-6 col-sm-6 col-lg-6 form-group">
                                                                        <label class="label-control">New Arrivals (Home)</label><br/>
                                                                        <label class="switch">
                                                                            <input type="checkbox"
                                                                                name="replacement_waranty"
                                                                                @if($product->new_arrivals =='yes') checked @endif
                                                                            id="new_arrivals" value="yes"
                                                                                id="new_arrivals" value="yes">
                                                                            <span class="slider round"></span>
                                                                        </label>
                                                                        <div class="text-danger validation-err"
                                                                            id="new_arrivals-err"></div>
                                                                    </div>
                                                                    
                                                                   <div class="col-md-6 col-sm-6 col-lg-6 form-group">
                                                                        <label class="label-control">COD</label><br/>
                                                                        <label class="switch">
                                                                            <input type="checkbox"
                                                                                name="has_cash_on_delivery" @if($product->has_cash_on_delivery =='yes') checked @endif
                                                                            id="has_cash_on_delivery" value="yes">
                                                                            <span class="slider round"></span>
                                                                        </label>
                                                                        <div class="text-danger validation-err"
                                                                            id="has_cash_on_delivery-err"></div>
                                                                    </div>

                                                                  <div class="col-md-6 col-sm-6 col-lg-6 form-group">
                                                                        <label class="label-control">Cancellation
                                                                            Allowed </label><br/>
                                                                        <label class="switch">
                                                                            <input type="checkbox"
                                                                            @if($product->cancellation_allowed =='yes') checked @endif
                                                                                name="cancellation_allowed"
                                                                                id="cancellation_allowed" value="yes">
                                                                            <span class="slider round"></span>
                                                                        </label>
                                                                        <div class="text-danger validation-err"
                                                                            id="cancellation_allowed-err"></div>
                                                                    </div>
                                                                    <div class="col-md-6 col-sm-6 col-lg-6 form-group">
                                                                        <label class="label-control">Express Shipping
                                                                        </label><br/>
                                                                        <label class="switch">
                                                                            <input type="checkbox"
                                                                            @if($product->express_sheeping =='yes') checked @endif
                                                                                name="express_sheeping"
                                                                                id="express_sheeping" value="yes">
                                                                            <span class="slider round"></span>
                                                                        </label>
                                                                        <div class="text-danger validation-err"
                                                                            id="express_sheeping-err"></div>
                                                                    </div>
                                                                   <div class="col-md-6 col-sm-6 col-lg-6 form-group">
                                                                        <label class="label-control">Premium Products (Home)</label><br/>
                                                                        <label class="switch">
                                                                            <input type="checkbox"
                                                                                @if($product->is_premium == 'yes')
                                                                            checked @endif name="is_premium"
                                                                            id="is_premium" value="yes">
                                                                            <span class="slider round"></span>
                                                                        </label>
                                                                        <div class="text-danger validation-err"
                                                                            id="is_premium-err"></div>
                                                                    </div>
                                                                   
                                                                </div>
                                                                <div class=" row">
                                                                      <div class="col-md-3 form-group">
                                                                        <label class="label-control">Fragrance</label>
                                                                        @foreach($fragrances as $key=>$fragrance)
                                                                        <div class="form-check">
                                                                          <input type="checkbox" class="form-check-input1" <?php if(isset($product->fragrance) && in_array($fragrance->id, json_decode($product->fragrance))){ echo 'checked';}  ?> id="fragrance{{$key}}" name="fragrance[]" value="{{$fragrance->id}}" >
                                                                          <label class="form-check-label" for="fragrance{{$key}}">{{$fragrance->title}}</label>
                                                                        </div>
                                                                        @endforeach
                                                
                                                                        <div class="text-danger validation-err" id="fragrance-err"></div>
                                                                    </div>
                                                                   </div>
                                                                   
                                                              <div class="div-form">
                                                                  <form class="form form-horizontal">
                                                                    <div class="form-body">
                                                                        <div class="row">
                                                                            <div class="col-md-12 col-sm-12 col-lg-12 form-group">
                                                                                <label class="label-control">Meta Title</label>
                                                                                <input type="text" class="form-control"
                                                                                    placeholder="Meta Tag Title"
                                                                                    name="meta_title" id="meta_title"
                                                                                    value="{{ $product->meta->meta_title }}">
                                                                                <span class="note-span"
                                                                                    id="meta-title-limit">We recommend
                                                                                    title between 50–60 characters.(0
                                                                                    character)</span>
                                                                                <div class="text-danger validation-err"
                                                                                    id="meta_title-err"></div>
                                                                            </div>



                                                                            <div class="col-md-12 col-sm-12 col-lg-12 form-group">
                                                                                <label class="label-control">Meta
                                                                                    Description</label>
                                                                                <textarea class="form-control"
                                                                                    name="meta_description"
                                                                                    id="meta_description"
                                                                                    placeholder="Meta Description">{{ $product->meta->meta_description }}</textarea>
                                                                                <span class="note-span"
                                                                                    id="meta-description-limit">We
                                                                                    recommend
                                                                                    descriptions between 50–160
                                                                                    characters.(0 character)</span>
                                                                                <div class="text-danger validation-err"
                                                                                    id="meta_description-err"></div>
                                                                            </div>



                                                                            <div class="col-md-12 col-sm-12 col-lg-12 form-group">
                                                                                <label class="label-control">Meta
                                                                                    Keywords</label>
                                                                                <textarea class="form-control"
                                                                                    name="meta_keyword"
                                                                                    id="meta_keyword"
                                                                                    placeholder="Meta Keywords">{{ $product->meta->meta_keyword }}</textarea>
                                                                                <div class="text-danger validation-err"
                                                                                    id="meta_keyword-err"></div>
                                                                            </div>
                                                                           <div class="col-md-12 col-sm-12 col-lg-12 form-group">
                                                                                <label
                                                                                    class="label-control label">Canonical
                                                                                    Tag</label>
                                                                                <textarea class="form-control" rows="4"
                                                                                    cols="7"
                                                                                    placeholder="Enter Canonical Tag"
                                                                                    name="canonical_tags"
                                                                                    id="canonical_tags">{{$product->meta->canonical_tags}}</textarea>

                                                                                <div class="text-danger"
                                                                                    id="canonical_tags-err"></div>
                                                                            </div>
                                                                             <div class="col-md-12 col-sm-12 col-lg-12 form-group">
                                                                                <label
                                                                                    class="label-control label">Twitter
                                                                                    Cards</label>
                                                                                <textarea class="form-control" rows="4"
                                                                                    cols="7"
                                                                                    placeholder="Enter Twitter Cards"
                                                                                    name="twitter_cards"
                                                                                    id="twitter_cards">{{$product->meta->twitter_cards}}</textarea>

                                                                                <div class="text-danger"
                                                                                    id="twitter_cards-err"></div>
                                                                            </div>
                                                                            <div class="col-md-12 col-sm-12 col-lg-12 form-group">
                                                                                <label class="label-control label">OG
                                                                                    Tags</label>
                                                                                <textarea class="form-control" rows="4"
                                                                                    cols="7" placeholder="Enter OG Tags"
                                                                                    name="og_tags"
                                                                                    id="og_tags">{{$product->meta->og_tags}}</textarea>

                                                                                <div class="text-danger"
                                                                                    id="og_tags-err"></div>
                                                                            </div>

                                                                    </div>
                                                                    <div class="text-danger validation-err pull-right"
                                                                        id="validation-err"></div>
                                                                    
                                                            </div>
                                                </form>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-12">
                                              <div class="div-form">
                                                  <h3><strong>Edit Variants</strong></h3>
                                                                <!-- <div class="form-group row">
                                                                    <div class="col-sm-3">
                                                                        <h4><i class="ft-user"></i>Attribute Option</h4>
                                                                    </div>
                                                                    <div class="col-sm-7">
                                                                        <label class="label-control">Choose Attributes (Upto 2)</label>
                                                                        <div class="d-block">
                                                                            <ul class="inline-units">
                                                                                @if (isset($attributes) && count($attributes) > 0)
                                                                                    @foreach ($attributes as $attribute)
                                                                                        <li><label><input type="checkbox" class="attribute_options" value="{{ $attribute->id }}" @if ($attribute->id == $product->attribute_1_id || $attribute->id == $product->atrribute_2_id) checked @endif> {{ $attribute->name }}</label></li>
                                                                                    @endforeach
                                                                                @endif
                                                                            </ul>
                                                                        </div>
                                                                        <div class="text-danger validation-err" id="attribute_options-err"></div>
                                                                    </div>


                                                                </div> -->
                                                                <div class="optionBox">

                                                                    <!--       <form method="post" action="{{url('deletemultiplevariants')}}"> -->


                                                                    <!--  <input class="btn btn-danger" type="submit" name="submit" value="Delete Selected Variants"/> -->
                                                                    <!--   <input type="checkbox" id="checkAll"> Select All -->



                                                                    @if (isset($product->product_options) &&
                                                                    count($product->product_options) > 0)
                                                                    @foreach ($product->product_options as $key=>
                                                                    $product_option)

                                                                    <div class="block">
                                                                        <input type="hidden" name="variantId[]" id="variantId"
                                                                            value="{{$product_option->id}}">
                                                                        <div class="form-group row  after-add-more">

                                                                            <div class="col-md-2">
                                                                                <label class="label-control">Select Quantity </label>
                                                                                <select class="form-control brand"
                                                                                    name="brand[]" id="brand" >
                                                                                    <option value="" selected>Select
                                                                                    </option>
                                                                                    @if (isset($brands) &&
                                                                                    count($brands) > 0)
                                                                                    @foreach ($brands as $brand)
                                                                                    <option value="{{ $brand->id }}"
                                                                                        @if($brand->id ==
                                                                                        $product_option->brand_id)
                                                                                        selected
                                                                                        @endif>{{ $brand->quantity.$brand->quantity_in }}
                                                                                    </option>
                                                                                    @endforeach
                                                                                    @endif
                                                                                </select>
                                                                                <div class="text-danger validation-err"
                                                                                    id="brand-err"></div>
                                                                            </div>
                                                                            <div class="col-sm-1">
                                                                                        <label
                                                                                            class="label-control">Stock</label>
                                                                                        <input type="number"
                                                                                            class="form-control stock"
                                                                                            min="1"
                                                                                            name="stock[]"
                                                                                            value="{{ $product_option->stock }}">
                                                                                        <div class="text-danger validation-err"
                                                                                            id="stock-err"></div>
                                                                                    </div>
                                                                                    <div class="col-sm-1">
                                                                                        <label
                                                                                            class="label-control">MRP</label>
                                                                                        <input type="number"
                                                                                            placeholder="MRP"
                                                                                            class="form-control mrp"
                                                                                            min="1" name="mrp[]"
                                                                                            value="{{ $product_option->mrp }}">
                                                                                        <div class="text-danger validation-err"
                                                                                            id="mrp-err"></div>
                                                                                    </div>
                                                                                    <div class="col-sm-1">
                                                                                        <label
                                                                                            class="label-control">Discount(%)</label>
                                                                                        <input type="number"
                                                                                            class="form-control discount_percentage"
                                                                                            min="1" max="100"
                                                                                            name="discount_percentage[]"
                                                                                            value="{{ $product_option->discount_percentage }}">
                                                                                        <div class="text-danger validation-err"
                                                                                            id="discount_percentage-err">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-sm-1">
                                                                                        <label
                                                                                            class="label-control">Price</label>
                                                                                        <input type="number"
                                                                                            placeholder="Price"
                                                                                            class="form-control price"
                                                                                            readonly min="1"
                                                                                            name="price[]"
                                                                                            value="{{ $product_option->price }}">
                                                                                        <div class="text-danger validation-err"
                                                                                            id="price-err"></div>
                                                                                    </div>


                                                                             <div class="col-sm-2">
                                                                             <label>Product Image (400*350)</label>
                                                                		    <label  class="filelabel">
                                                                			<input type="file" class="imageInput" name="images[]" multiple>
                                                                			<div class="imagePreviewContainer1">
                                                                			      </div>
                                                                			 <div class="imagePreviewContainer">
                                                                			     @foreach($product_option->product_variant_images as $image)
                                                                			     <span class="close1" data-id="{{$image->id}}">&times;</span>
                                                                			     <img src="{{ URL::asset('storage/' . $image->image) }}" style="height: 50px; width: 50px;" />
                                                                			     
                                                                			     @endforeach
                                                                			 </div>
                                                                			  
                                                                	            <i class="fa fa-plus" id="icon"></i>
                                                                		</label>
                                                                		 <div class="text-danger validation-err" id="image2-err"></div>
                                                                        </div>

                                                                            @if($loop->iteration == 1)
                                                                            <div class="col-sm-1 change">
                                                                                <label for="">&nbsp;</label><br />
                                                                                <span class="btn btn-success add-more">+
                                                                                    Add</span>
                                                                            </div>
                                                                            @else
                                                                            <div class="col-sm-1 change">
                                                                                <label for=''>&nbsp;</label><br /><a onclick="deleteVariantOption({{$product_option->id}})"
                                                                                    class='btn btn-danger remove'>-
                                                                                    Remove</a>
                                                                            </div>
                                                                            @endif

                                                                            <!--     <div class="col-sm-1">-->
                                                                            <!--           <span class="checkbox">-->
                                                                            <!--     <input name='id[]' type="checkbox" id="checkItem" value="{{$product_option->id}}">-->
                                                                            <!--</span>-->


                                                                            <!--     </div>-->


                                                                        </div>
                                                                    </div>
                                                                    @endforeach
                                                                    @endif

                                                                    <!--   </form>
 -->

                                                                </div>
                                                            </div>
                                        </div>
                                        <div class="form-actions">
                                                <button type="button"
                                                    class="btn adminbtn-blue btn-lg pull-right"
                                                    id="update-product-btn"
                                                    product_id="{{ $product->id }}"><i
                                                        class="fa fa-check-square-o"></i> Submit</button>
                                            </div>
                                         </form>
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
$(document).on('click', '.close' ,function(e) {
    e.preventDefault();
  var pid = $(this).data("id");
    //  $(this).parent().parent('img').remove();
    $(this).parent().parent().find('img','span').remove()
    $(this).remove();
          $.ajax({
                type: "GET",
                url:"{{route('admin.gallery.delete')}}",
                data:{id:pid}
              });
});

$(document).ready(()=>{
      $('#upload').change(function(){
        const file = this.files[0];
        console.log(file);
         $('#blah1').css('display','block');
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
  // Function to generate the image previews for a specific input field
  function readURL(input, previewContainer) {
    if (input.files && input.files.length > 0) {
      $(previewContainer).empty(); // Clear previous previews
    const imagesArray = $('.imagePreviewContainer1').find('img').toArray();
    console.log(imagesArray)
      for (let i = 0; i < input.files.length; i++) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
        //   const imagePreview = $('<img>').css("height","50px").css("width","50px").attr('src', e.target.result);
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
    const previewContainer = $(this).next('.imagePreviewContainer1');
    readURL(this, previewContainer);
  });
});

$(document).ready(function() {
  $(document).on('click', '.close1' ,function(e) {
    e.preventDefault();
      var pid = $(this).data("id"); 
      $(this).parent().parent().find('img:first','span:first').remove()
        $(this).remove();
        if(pid){
            $.ajax({
                type: "GET",
                url:"{{route('admin.delete-variant-image')}}",
                data:{id:pid}
              });
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
    CKEDITOR.replace('terms_condition', {
        filebrowserUploadUrl: "{{ route('admin.image-upload', ['_token' => csrf_token()]) }}",
        filebrowserUploadMethod: 'form'
    });

    CKEDITOR.replace('content');

    $(document).on('keyup', "#name", function(event) {
            let name = $(this).val();
            let url = name.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
            $("#slug").val(url);
        })

    // $(document).on("keyup change", ".mrp", function(event) {
    //     let mrp = $(this).val();
    //     $(this).closest('.form-group').find('.discount_percentage').val('0');
    //     $(this).closest('.form-group').find('.price').val(mrp);
    // });

    // $(document).on("keyup change", ".discount_percentage", function(event) {
    //     let discount = $(this).val();
    //     let mrp = $(this).closest('.form-group').find('.mrp').val();
    //     if (discount > 0 && discount < 100) {
    //         let discountedprice = parseFloat(mrp) - (mrp * discount / 100);
    //         $(this).closest('.form-group').find('.price').val(discountedprice);
    //     } else {
    //         $(this).val('0');
    //         $(this).closest('.form-group').find('.price').val(mrp);
    //     }
    // });

    $(document).on('keyup', "#name", function(event) {
    let name = $(this).val();
    let slug = name.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
    $("#slug").val(slug);
});
$(document).on("keyup change", ".mrp", function(event) {
        let mrp = $(this).val();
        $(this).closest('.form-group').find('.discount_percentage').val('0');
        $(this).closest('.form-group').find('.price').val(mrp);
    });
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

    $(document).on("keyup", "#meta_title", function(event) {
        let title = $(this).val();
        $('#meta-title-limit').html(
            `We recommend title between 50–60 characters.(${title.length} character)`);
    });

    $(document).on("keyup", "#meta_description", function(event) {
        let title = $(this).val();
        $('#meta-description-limit').html(
            `We recommend descriptions between 50–160 characters.(${title.length} character)`);
    });
    $(document).ready(function() {
        $("#category").change(function() {
            var data = $(this).val();
            let formData = new FormData();
            formData.append('id', data);
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
                    var html = "";
                    if(result.length > 0){
                         $("#subcategory").removeAttr("style")
                    for (let x = 0; x < data; x++) {
                        $("#subcategory_id").append(
                            `<option value="${result[x]['id']}">${result[x]['name']}</option>`
                        );
                    }
                    }else{
                        $("#subcategory").css("display","none")
                    }
                   
                }

            })
        })
    })
    // $('#brand').select2();
    // $('#category').select2();

    $(document).on('click', '.attribute_options', function(event) {
        $('#attribute_options-err').html('');
        let attribute_options = $(".attribute_options:checked").map(function() {
            return $(this).val();
        }).toArray();
        let formData = new FormData();
        formData.append('attribute_options', attribute_options);
        $.ajax({
            url: `{{ URL::to('admin/fetch-childs-by-attributes') }}`,
            type: 'POST',
            processData: false,
            contentType: false,
            dataType: 'json',
            data: formData,
            context: this,
            success: function(result) {
                if (result.success) {
                    $(".attribute_name_1").html(`Choose ${result.attribute_name_1}`);
                    $(".attribute_1").html(result.attribute_1_childs);
                    $(".attribute_name_2").html(`Choose ${result.attribute_name_2}`);
                    $(".attribute_2").html(result.attribute_2_childs);
                } else {
                    if (result.code == 422) {
                        for (const key in result.errors) {
                            $(`#${key}-err`).html(result.errors[key][0]);
                        }
                    } else {

                    }
                }
            }
        })
    });

    // $(document).on("click", ".add", function(event) {
    //     $('#attribute_options-err').html('');
    //     let attribute_options = $(".attribute_options:checked").map(function() {
    //         return $(this).val();
    //     }).toArray();
    //     let formData = new FormData();
    //     formData.append('attribute_options', attribute_options);
    //     $.ajax({
    //         url: "{{ URL::to('admin/generate-product-row-by-attributes') }}",
    //         type: 'POST',
    //         processData: false,
    //         contentType: false,
    //         dataType: 'json',
    //         data: formData,
    //         context: this,
    //         success: function(result) {
    //             if (result.success) {
    //                 $('.block:last').after(result.html);
    //             }
    //         }
    //     })
    // });

    // $('.optionBox').on('click', '.remove', function() {
    //     $(this).parent().parent().remove();
    // });

    //new code for adding - begin
    //    $("body").on("click",".add-more",function(){
    //         var html = $(".after-add-more").first().clone();
    //         $(html).find("input[type=text]").val('');
    //         $(html).find("input[type=number]").val('');
    //         $(html).find("select").val('');
    //         //  $(html).find(".change").prepend("<label for=''>&nbsp;</label><br/><a class='btn btn-danger remove'>- Remove</a>");
    //           $(html).find(".change").html("<label for=''>&nbsp;</label><br/><a class='btn btn-danger remove'>- Remove</a>");
    //         $(".after-add-more").last().after(html);
    //     });
    //     $("body").on("click",".remove",function(){
    //         $(this).parents(".after-add-more").remove();
    //     });
    //     //end


    $(document).on("click", "#update-product-btn", function(event) {
        $(this).attr('disabled', true);
        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].updateElement();
        }
        $(".validation-err").html("");
        let formData = new FormData();
        formData.append('_method', 'PUT');
        formData.append('category', $(".category").map(function() {
            return $(this).val();
        }).toArray());
        let attribute_options = $(".attribute_options:checked").map(function() {
            return $(this).val();
        }).toArray();
        formData.append('brand', $('#brand').val());
        formData.append('name', $('#name').val());
        formData.append('name_ar', $('#name_ar').val());
        formData.append('slug', $('#slug').val());
        formData.append('alert_quantity', $('#alert_quantity').val());
        formData.append('youtube_code', $('#youtube_code').val());
        formData.append('fabric', $('#fabric').val());
        formData.append('image', (typeof $('#upload')[0].files[0] == 'undefined') ? '' : $('#upload')[0].files[0]);
      formData.append('image2', (typeof $('#upload2')[0].files[0] == 'undefined') ? '' : $('#upload2')[0].files[0]);
      formData.append('image3', (typeof $('#upload3')[0].files[0] == 'undefined') ? '' : $('#upload3')[0].files[0]);
      formData.append('image4', (typeof $('#upload4')[0].files[0] == 'undefined') ? '' : $('#upload4')[0].files[0]);
      formData.append('image5', (typeof $('#upload5')[0].files[0] == 'undefined') ? '' : $('#upload5')[0].files[0]);
      formData.append('image6', (typeof $('#upload6')[0].files[0] == 'undefined') ? '' : $('#upload6')[0].files[0]);
        formData.append('status', $('#status').val());
        formData.append('is_featured', $('#is_featured:checked').val() ? 'yes' : 'no');
        formData.append('is_premium', $('#is_premium:checked').val() ? 'yes' : 'no');
        formData.append('is_top', "no");
        formData.append('is_hotDeals', $('#is_hotDeals:checked').val() ? 'yes' : 'no');
        formData.append('is_popular', $('#is_popular:checked').val() ? 'yes' : 'no');
        formData.append('new_arrivals', $('#new_arrivals:checked').val() ? 'yes' : 'no');
        formData.append('has_cash_on_delivery', $('#has_cash_on_delivery:checked').val() ? 'yes' :
            'no');
        formData.append('allow_rating', $('#allow_rating:checked').val() ? 'yes' : 'no');
        formData.append('short_description', $('#short_description').val());
        formData.append('short_description_ar', $('#short_description_ar').val());
        formData.append('description', $('#description').val());
        formData.append('description_ar', $('#description_ar').val());
        formData.append('additional_information', $('#additional_information').val());
        formData.append('additional_information_ar', $('#additional_information_ar').val());
        formData.append('shipping_information', $('#shipping_information').val());
        formData.append('shipping_information_ar', $('#shipping_information_ar').val());
        formData.append('default_price', $('#default_price').val());
        formData.append('subcategory_id', $('#subcategory_id').val());
        formData.append('replacement_waranty', $('#replacement_waranty:checked').val() ? "yes" : "no");
        formData.append('cancellation_allowed', $('#cancellation_allowed:checked').val() ? "yes" : "no");
        formData.append('express_sheeping', $('#express_sheeping:checked').val() ? "yes" : "no");
        formData.append('top_selling', $('#top_selling:checked').val() ? "yes" : "no");
        formData.append('terms_condition', $('#terms_condition').val());
        formData.append('attribute_options', attribute_options);
        formData.append('canonical_tags', $('#canonical_tags').val());
        formData.append('twitter_cards', $('#twitter_cards').val());
        formData.append('og_tags', $('#og_tags').val());
        formData.append('product_code', $('#product_code').val());
        var fragrance = [];
            $.each($("input[name='fragrance[]']:checked"), function(){            
                fragrance.push($(this).val());
            });
      formData.append('fragrance', fragrance);
        var data = $("select[name='brand[]']").length;
        let variant_options = $('.block').map(function() {
             return {
            brand: $("select[name='brand[]']").map(function() {
                return $(this).val();
            }).get(),
            variantid: $("input[name='variantId[]']").map(function() {
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
            stock: $("input[name='stock[]']").map(function() {
                return $(this).val();
            }).get(),
            mrp: $("input[name='mrp[]']").map(function() {
                return $(this).val();
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
        let product_id = $(this).attr('product_id');
        $.ajax({
            url: `{{ URL::to('admin/manage-product/${product_id}') }}`,
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


function deleteVariantOption(id) {
    $.ajax({
                type: 'DELETE',
                url: `{{ URL::to('admin/product-variant-option/${id}') }}`,
                dataType: 'json',
                data: {
                    id: id,
                    "_token": "{{ csrf_token() }}"
                },
                success: function(result) {
                    if (result.success) {
                        
                    } else {
                        
                    }
                }
            });
};


//new code for adding - begin
var count = 1;
$("body").on("click", ".add-more", function() {
    count++;
    $(".after-add-more").last().find("input[type=checkbox]").attr("disabled", true);
    var html = $(".after-add-more").first().clone();
    $(html).find("input[type=text]").val('');
    $(html).find("input[type=number]").val('');
    $(html).find("#brandmodel").html(" ");
    $(html).find("#contentall").html(" ");
    $(html).find("#brand").attr("disabled", false);
    $(html).find("input[type=checkbox]").attr("disabled", false);
    $(html).find("input[type=checkbox]").prop("checked", false);
    //  $(html).find(".change").prepend("<label for=''>&nbsp;</label><br/><a class='btn btn-danger remove'>- Remove</a>");
    $(html).find(".change").html(
        "<label for=''>&nbsp;</label><br/><a class='btn btn-danger remove'>- Remove</a>");
    $(".after-add-more").last().after(html);
});
$("body").on("click", ".remove", function() {
    count--;
    $(this).parents(".after-add-more").remove();
});
//end

$(document).ready(function() {
    $(".block").on("click", "#ckbCheckAll", function() {

        $(".after-add-more").last().find("#brandmodel .brandmodel").prop('checked', $(this).prop(
            'checked'));

    });

    $(document).on("click", ".brandmodel", function() {
        var id = $(this).val();
        $(".contentprice" + id).css('display', 'block');
    });
})
</script>
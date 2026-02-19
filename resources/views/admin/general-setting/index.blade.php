@include('admin.header')
<div class="app-content content container-fluid">

    <div class="content-wrapper">

        <div class="content-header row">

            <div class="content-header-left col-md-6 col-xs-12 mb-2">

                <h3 class="content-header-title mb-0">Manage Store Setup</h3>

                <div class="row breadcrumbs-top">

                    <div class="breadcrumb-wrapper col-xs-12">

                        <ol class="breadcrumb">

                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>

                            <li class="breadcrumb-item">Store Setting</li>

                            <li class="breadcrumb-item active">Manage General Setting

                            </li>

                        </ol>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-xl-12 col-lg-12">

            <div class="card">

                <div class="card-header">

                    <h4 class="card-title">Store Setting - General Setting</h4>

                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>

                </div>

                <section>
                    <div class="container-fluid">
                        <ul id="tabs" class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a id="tab-A" href="#pane-A" class="nav-link active" data-toggle="tab" role="tab">Header & Footer</a>
                            </li>
                            <!--<li class="nav-item">-->
                            <!--    <a id="tab-B" href="#pane-B" class="nav-link" data-toggle="tab" role="tab">Footer</a>-->
                            <!--</li>-->
                            <li class="nav-item">
                                <a id="tab-C" href="#pane-C" class="nav-link socialmediatab" data-toggle="tab" role="tab">Social Media </a>
                            </li>
                            <!--<li class="nav-item">-->
                            <!--    <a id="tab-D" href="#pane-D" class="nav-link" data-toggle="tab" role="tab">Contact Us (Home Page) </a>-->
                            <!--</li>-->
                            <!--<li class="nav-item">-->
                            <!--    <a id="tab-E" href="#pane-E" class="nav-link" data-toggle="tab" role="tab">GST </a>-->
                            <!--</li>-->
                            <li class="nav-item">
                                <a id="tab-F" href="#pane-F" class="nav-link" data-toggle="tab" role="tab">COD </a>
                            </li>
                            <!--<li class="nav-item">-->
                            <!--    <a id="tab-G" href="#pane-G" class="nav-link" data-toggle="tab" role="tab">Language </a>-->
                            <!--</li>-->
                        </ul>


    <div id="content" class="tab-content card_content" role="tablist">
        <!-- Header Data Start  -->
        
        <div id="pane-A" class="card tab-pane fade show active in" role="tabpanel" aria-labelledby="tab-A">
            <div class="card-header" role="tab" id="heading-A">

                <form method="post" action="{{route('admin.saveHeaderSetting')}}" id="headerform" enctype="multipart/form-data">
                    @csrf
                        <div class="row">
                            <div class="col-xl-4 col-lg-4 col-md-6 col-12">
                                <div class="wdinput form-group">
                                    <label class="d-block">Header Logo<span class="text-danger">(Image Size 150*100)</span></label>
                                    @if (isset($headerData->header_logo) && Storage::exists($headerData->header_logo))

                         <img src="{{ URL::asset('storage/' . $headerData->header_logo) }}" alt="" width="100" height="100" class="mb-2">

                                     @endif

                             <input type="file" class="form-control-file"  name="header_logo">
                             <div class="text-danger validation-err" id="header_logo-err"></div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-6 col-12">
                                <div class="wdinput form-group">
                                    <label class="d-block">Footer Logo<span class="text-danger">(Image Size 150*100)</span></label>
                                    @if (isset($headerData->footer_logo) && Storage::exists($headerData->footer_logo))

                         <img src="{{ URL::asset('storage/' . $headerData->footer_logo) }}" alt="" width="100" height="100" class="mb-2">

                                     @endif

                             <input type="file" class="form-control-file"  name="footer_logo">
                              <div class="text-danger validation-err" id="footer_logo-err"></div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-6 col-12">
                                <div class="wdinput form-group">
                                    <label class="d-block">Favicon<span class="text-danger">(Image Size 100*100)</span></label>
                                    @if (isset($headerData->favicon) && Storage::exists($headerData->favicon))

                         <img src="{{ URL::asset('storage/' . $headerData->favicon) }}" alt="" width="100" height="100" class="mb-2">

                                     @endif

                             <input type="file" class="form-control-file"  name="favicon">
                             <div class="text-danger validation-err" id="favicon-err"></div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-lg-4 col-md-6 col-12">
                                <div class="wdinput form-group">
                                    <label>Tollfree Number</label>
                                    <input type="text" class="form-control" placeholder="Enter Tollfree number" name="tollfree_number" value="{{ $headerData->tollfree_number ?? null }}" >
                                    <div class="text-danger validation-err" id="tollfree_number-err"></div>
                                    <div class="social-media-hf mt-2">
                              <label><input type="checkbox" name="show_in_header_tollfree_number" value="on" {{ $headerData->show_in_header_tollfree_number=="on" ? 'checked' : '' }} > Header</label>
                              <label class="ml-2"><input type="checkbox" name="show_in_footer_tollfree_number" value="on" {{ $headerData->show_in_footer_tollfree_number=="on" ? 'checked' : '' }} > Footer</label>
                            </div>
                            </div>
                            </div>
                             
                           

                            <div class="col-xl-4 col-lg-4 col-md-6 col-12">
                                <div class="wdinput form-group">
                                    <label>Whatsapp Number</label>
                                    <input type="text" class="form-control" placeholder="Enter Whatsapp number" name="whatsapp_number" value="{{ $headerData->whatsapp_number ?? null }}" >
                                    <div class="text-danger validation-err" id="whatsapp_number-err"></div>
                                    <div class="social-media-hf mt-2">
                              <label><input type="checkbox" name="show_in_header_whatsapp_number" value="on" {{ $headerData->show_in_header_whatsapp_number=="on" ? 'checked' : '' }} > Header</label>
                              <label class="ml-2"><input type="checkbox" name="show_in_footer_whatsapp_number" value="on" {{ $headerData->show_in_footer_whatsapp_number=="on" ? 'checked' : '' }} > Footer</label>
                            </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-6 col-12">
                                <div class="wdinput form-group">
                                    <label>Email ID</label>
                                <input type="email" class="form-control" placeholder="Enter name" name="email" value="{{ $headerData->email ?? null }}" >
                                <div class="text-danger validation-err" id="email-err"></div>
                                <div class="social-media-hf mt-2">
                              <label><input type="checkbox" name="show_in_header_email" value="on" {{ $headerData->show_in_header_email=="on" ? 'checked' : '' }} > Header</label>
                              <label class="ml-2"><input type="checkbox" name="show_in_footer_email" value="on" {{ $headerData->show_in_footer_email=="on" ? 'checked' : '' }} > Footer</label>
                            </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-6 col-12">
                                <div class="wdinput form-group">
                                    <label>Coupon Text</label>
                                    <input type="text" class="form-control" name="coupon_code" placeholder="Enter Discount coupon" value="{{ $headerData->coupon_code ?? null }}">
                                    <div class="text-danger validation-err" id="coupon_code-err"></div>
                                    <div class="social-media-hf mt-2">
                              <label><input type="checkbox" name="show_in_header_coupon_code" value="on" {{ $headerData->show_in_header_coupon_code=="on" ? 'checked' : '' }} > Header</label>
                              <label class="ml-2"><input type="checkbox" name="show_in_footer_coupon_code" value="on" {{ $headerData->show_in_footer_coupon_code=="on" ? 'checked' : '' }} > Footer</label>
                            </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-6 col-12">
                                <div class="wdinput form-group">
                                    <label class="d-block">Short Description</label>
                                    
                                    <textarea class="form-control" name="short_description" placeholder="Short Description"  rows="3">{{ $headerData->short_description ?? null }}</textarea>
                                    <div class="text-danger validation-err" id="short_description-err"></div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-6 col-12">
                                <div class="wdinput form-group">
                                    <label class="d-block">Footer Address</label>
                                    
                                    <textarea class="form-control" name="address" placeholder="Address"  rows="3">{{ $headerData->address ?? null }}</textarea>
                                    <div class="text-danger validation-err" id="address-err"></div>
                                </div>
                            </div>
                             <div class="form-group row">
                          <div class="col-md-12 col-sm-12 col-lg-12">
                            <label class="label-control">Meta Title</label>
                            <input type="text" class="form-control" placeholder="Meta Tag Title" name="meta_title" value="{{$headerData->meta->meta_title}}" id="meta_title">
                            <div class="text-danger validation-err" id="meta_title-err"></div>
                          </div>
                          </div>
                           <div class="form-group row">
                          <div class="col-md-12 col-sm-12 col-lg-12">
                            <label class="label-control">Meta Tag Description</label>
                            <textarea class="form-control" name="meta_description" id="meta_description" placeholder="Meta Tag Description">{{$headerData->meta->meta_description}}</textarea>
                            <div class="text-danger validation-err" id="meta_description-err"></div>
                          </div> 
                          </div>
                           <div class="form-group row">
                          <div class="col-md-12 col-sm-12 col-lg-12">
                            <label class="label-control">Meta Tag Keywords</label>
                            <textarea class="form-control" name="meta_keyword" id="meta_keyword" placeholder="Meta Tag Keywords">{{$headerData->meta->meta_keyword}}</textarea>
                            <div class="text-danger validation-err" id="meta_keyword-err"></div>
                          </div>
                          </div>
                           <div class="form-group row">
                          <div class="col-md-12 col-sm-12 col-lg-12">
                            <label class="label-control label">Canonical Tag
                            </label>
                            <input type="text" class="form-control" placeholder="Enter Canonical Tag" name="canonical_tags" value="{{$headerData->meta->canonical_tags}}" id="canonical_tags"/>
                            <div class="text-danger" id="canonical_tags-err"></div>
                          </div>
                          </div>
                           <div class="form-group row">
                          <div class="col-md-12 col-sm-12 col-lg-12">
                            <label class="label-control label">Twitter Cards
                            </label>
                            <input type="text" class="form-control" placeholder="Enter Twitter Cards" name="twitter_cards" value="{{$headerData->meta->twitter_cards}}" id="twitter_cards"/>
                            <div class="text-danger" id="twitter_cards-err"></div>
                          </div>
                          </div>
                           <div class="form-group row">
                          <div class="col-md-12 col-sm-12 col-lg-12">
                            <label class="label-control label">OG Tags
                            </label>
                            <input type="text" class="form-control" placeholder="Enter OG Tags" name="og_tags" value="{{$headerData->meta->og_tags}}" id="og_tags"/>
                            <div class="text-danger" id="og_tags-err"></div>
                          </div>
                        </div>

                            <div class="col-xl-12">
                                <div class="wdinput form-group">
                                    <button class="btn adminbtn-blue btn-lg add-header-btn">Submit</button>
                                </div>
                            </div>
                        </div>
                       </form>

            </div>

          
        </div>
        <!-- End header Data save  -->

<!-- Start Footer Data  -->
        <div id="pane-B" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-B">
            <div class="card-header" role="tab" id="heading-A">

                  <form method="post" action="{{route('admin.saveFooterSetting')}}" enctype="multipart/form-data">
                    @csrf
                        <div class="row">
                        <div class="col-xl-4 col-lg-4 col-md-6 col-12">
                                <div class="wdinput form-group">
                                    <label class="d-block">Footer Logo</label>
                                    @if (isset($footerData->footer_logo) && Storage::exists($footerData->footer_logo))

                         <img src="{{ URL::asset('storage/' . $footerData->footer_logo) }}" alt="" width="100" height="100" class="mb-2">

                                     @endif

                             <input type="file" class="form-control-file" name="footer_logo">
                                </div>
</div>
                            <div class="col-xl-4 col-lg-4 col-md-6 col-12">
                                <div class="wdinput form-group">
                                    <label class="d-block">Short Description</label>
                                    
                                    <textarea class="form-control" name="short_description" placeholder="Short Description"  rows="3">{{ $footerData->short_description ?? null }}</textarea>
                                </div>
                            </div>

@if($language)
                            <div class="col-xl-4 col-lg-4 col-md-6 col-12">
                                <div class="wdinput form-group">
                                    <label class="d-block">Short Description Arabic</label>
                                    
                                    <textarea class="form-control" name="short_desc_ar" placeholder="Short Description Arabic"  rows="3">{{ $footerData->short_desc_ar ?? null }}</textarea>
                                </div>
                            </div>
@endif

                            <div class="col-xl-4 col-lg-4 col-md-6 col-12">
                                <div class="wdinput form-group">
                                    <label>Mobile Number</label>
                                    <input type="number" class="form-control" placeholder="Enter Mobile number" name="mobile_number" value="{{ $footerData->mobile_number ?? null }}" required>
                                </div>
                            </div>

                            <div class="col-xl-4 col-lg-4 col-md-6 col-12">
                                <div class="wdinput form-group">
                                    <label>Whatsapp Number</label>
                                    <input type="number" class="form-control" placeholder="Enter Whatsapp number" name="whatsapp_number" value="{{ $footerData->whatsapp_number ?? null }}" required>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-6 col-12">
                                <div class="wdinput form-group">
                                    <label>Email ID</label>
                                    <input type="text" class="form-control" placeholder="Enter name" name="email" value="{{ $footerData->email ?? null }}" required>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-6 col-12">
                                <div class="wdinput form-group">
                                    <label>Coupon Text</label>
                                    <input type="text" class="form-control" value="{{ $footerData->coupon_code ?? null }}" name="coupon_code" placeholder="Enter Mobile Number">
                                </div>
                            </div>

                            <div class="col-xl-12">
                                <div class="wdinput form-group">
                                    <button class="btn adminbtn-blue btn-lg">Submit</button>
                                </div>
                            </div>
                        </div>
                       </form> 
            </div>
        </div>
        <!-- End Footer Data Save -->

        <!-- Start Social Media Links -->

        <div id="pane-C" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-C">
            <div class="card-header" role="tab" id="heading-A">
                <h5 class="mb-0">
                
                         <form method="post" id="socialform" action="{{ route('admin.saveSocialLinks')}}">
                            @csrf
                        <div class="row socialformn">
                            
                            <div class="col-xl-4 col-lg-4 col-md-6 col-12">
                                <div class="wdinput form-group bg-light">
                                    <label>Facebook URL</label>
                                    <input type="text" class="form-control" name="fb_name" value="{{$socialData->fb_name}}" placeholder="Enter Facebook URL">
                                    <div class="text-danger" id="fb_name-err"></div>
                              <div class="social-media-hf mt-2">
                           {{--   <label><input type="checkbox" name="show_in_header_fb" {{ !empty($socialData->show_in_header_fb) ? 'checked' : '' }} > Header</label> --}}
                              <label class="ml-2"><input type="checkbox" name="show_in_footer_fb" value="on" {{ $socialData->show_in_footer_fb=="on" ? 'checked' : '' }}  > Footer</label>
                            </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-6 col-12">
                                <div class="wdinput form-group bg-light">
                                    <label>Twitter URL</label>
                                    <input type="text" class="form-control" value="{{$socialData->twit_name}}" name="twit_name" placeholder="Enter Twitter URL">
                                    <div class="text-danger" id="twit_name-err"></div>
                              <div class="social-media-hf mt-2">
                            {{--   <label><input type="checkbox" name="show_in_header_twit" {{ !empty($socialData->show_in_header_twit) ? 'checked' : '' }}> Header</label> --}}
                              <label class="ml-2"><input type="checkbox" name="show_in_footer_twit" value="on" {{ $socialData->show_in_footer_twit=="on" ? 'checked' : '' }}> Footer</label>
                            </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-6 col-12">
                                <div class="wdinput form-group bg-light">
                                    <label>Instagram URL</label>
                                    <input type="text" class="form-control" name="insta_name" value="{{$socialData->insta_name}}" placeholder="Enter Instagram URL">
                                    <div class="text-danger" id="insta_name-err"></div>
                              <div class="social-media-hf mt-2">
                             {{--  <label><input type="checkbox" name="show_in_header_insta" {{ !empty($socialData->show_in_header_insta) ? 'checked' : '' }}> Header</label> --}}
                              <label class="ml-2"><input type="checkbox" name="show_in_footer_insta" value="on" {{ $socialData->show_in_footer_insta=="on" ? 'checked' : '' }} > Footer</label>
                            </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-6 col-12">
                                <div class="wdinput form-group bg-light">
                                    <label>Linkedin URL</label>
                                    <input type="text" class="form-control" name="linkedin_name" value="{{$socialData->linkedin_name}}" placeholder="Enter Linkedin URL">
                                    <div class="text-danger" id="linkedin_name-err"></div>
                              <div class="social-media-hf mt-2">
                             {{--  <label><input type="checkbox" name="show_in_header_linkedin" {{ !empty($socialData->show_in_header_linkedin) ? 'checked' : '' }}> Header</label> --}}
                              <label class="ml-2"><input type="checkbox" name="show_in_footer_linkedin" value="on" {{ $socialData->show_in_footer_linkedin=="on" ? 'checked' : '' }} > Footer</label>
                            </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-6 col-12">
                                <div class="wdinput form-group bg-light">
                                    <label>Youtube URL</label>
                                    <input type="text" class="form-control" name="youtube_name"  value="{{$socialData->youtube_name}}" placeholder="Enter Youtube URL">
                                    <div class="text-danger" id="youtube_name-err"></div>
                              <div class="social-media-hf mt-2">
                           {{--    <label><input type="checkbox" name="show_in_header_youtube" {{ !empty($socialData->show_in_header_youtube) ? 'checked' : '' }}> Header</label> --}}
                              <label class="ml-2"><input type="checkbox" name="show_in_footer_youtube" value="on" {{ $socialData->show_in_footer_youtube=="on" ? 'checked' : '' }} > Footer</label>
                            </div>
                                </div>
                            </div>

                            <div class="col-xl-12">
                                <div class="wdinput form-group">
                                    <button type="submit" class="btn adminbtn-blue btn-lg social-update-btn">Submit</button>
                                </div>
                            </div>
                        </div>
                       </form>
                   
                </h5>
            </div>
        </div>

        <!-- End social media links -->

<!-- Start Contact us Data  -->
        <div id="pane-D" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-D">
            <div class="card-header" role="tab" id="heading-A">
                       <form method="post" id="contactusform" action="{{route('admin.manage-general-setting.store')}}">
                        @csrf
                        <div class="add-address-remove" id="addaddress">
                        <div class="row">
                            
                          <div class="col-xl-4 col-lg-4 col-md-6 col-12">
                                <div class="wdinput form-group">
                                    <label>Heading</label>
                                    <input type="text" class="form-control" placeholder="Enter Heading" name="heading" value="{{ $general_setting->heading ?? null }}" >
                                    <div class="text-danger" id="heading-err"></div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-6 col-12">
                                <div class="wdinput form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" name="description" placeholder="Enter Description"> {{ $general_setting->description }}</textarea>
                                    <div class="text-danger" id="description-err"></div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-lg-4 col-md-6 col-12">
                                <div class="wdinput form-group">
                                    <label>Contact Number</label>
                                    <input type="text" class="form-control" placeholder="Enter Contact number" name="contact_number" value="{{ $general_setting->contact_number ?? null }}" >
                                    <div class="text-danger" id="contact_number-err"></div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-6 col-12">
                                <div class="wdinput form-group">
                                    <label>Whatsapp Number</label>
                                    <input type="text" class="form-control" placeholder="Enter Whatsapp number" name="whatsapp_number" value="{{ $general_setting->whatsapp_number ?? null }}" >
                                    <div class="text-danger" id="whatsapp_number-err"></div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-6 col-12">
                                <div class="wdinput form-group">
                                    <label>Email ID</label>
                                    <input type="email" class="form-control" placeholder="Enter Email" name="email" value="{{ $general_setting->email ?? null }}" >
                                    <div class="text-danger" id="email-err"></div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-6 col-12">
                                <div class="wdinput form-group">
                                    <label>Full Address</label>
                                    <textarea class="form-control" name="address" placeholder="Enter Full Address"> {{ $general_setting->address }}</textarea>
                                    <div class="text-danger" id="address-err"></div>
                                </div>
                            </div>
                            @if($language)
                            <div class="col-xl-4 col-lg-4 col-md-6 col-12">
                                <div class="wdinput form-group">
                                    <label>Full Address Arabic</label>
                                    <textarea class="form-control" name="address_ar" placeholder="Enter Full Address Arabic"> {{ $general_setting->address_ar }}</textarea>
                                    <div class="text-danger" id="address_ar-err"></div>
                                </div>
                            </div>
                            @endif
                            <div class="col-xl-4 col-lg-4 col-md-6 col-12">
                                <div class="wdinput form-group">
                                    <label>Google Map Location(Iframe) </label>
                                    <textarea class="form-control" placeholder="Enter Google Map Location URL " name="map_url"> {{ $general_setting->map_url  }} </textarea>
                                    <div class="text-danger" id="map_url-err"></div>
                                </div>
                            </div>
                            </div>

                      <!--     <div class="col-12">
                            <label><input type="checkbox" name=""> Show Footer</label>
                          </div> -->
                        </div>  
                            <div class="row">
                            <div class="col-xl-12">
                                <div class="wdinput form-group">
                                    <button class="btn adminbtn-blue btn-lg contactus-update-btn">Submit</button>
                              <!--<button class="btn adminbtn-blue btn-lg ml-1" id="addbutton">Add More Address</button>-->
                                </div>
                            </div>
                        </div>
                       </form>
 
            </div>
        </div>

        <!-- End Contact Us Data  -->

        <!-- GST Details Form Here -->

        <div id="pane-E" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-E">
            <div class="card-header" role="tab" id="heading-A">
                     <form method="post" action="{{route('admin.saveGSTDetails')}}">
                        @csrf
                        <div class="row">
                            
                            <div class="col-xl-4 col-lg-4 col-md-6 col-12">
                                <div class="wdinput form-group">
                                    <label>Company Name</label>
                                    <input type="text" class="form-control" value="{{ $gstData->company_name ?? null }}" name="company_name" placeholder="Enter Company Name">
                                </div>
                            </div>

                            <div class="col-xl-4 col-lg-4 col-md-6 col-12">
                                <div class="wdinput form-group">
                                    <label>PAN Number</label>
                                    <input type="text" class="form-control" value="{{ $gstData->pan_number ?? null }}" name="pan_number" placeholder="Enter PAN Number">
                                </div>
                            </div>
                            
                            <div class="col-xl-4 col-lg-4 col-md-6 col-12">
                                <div class="wdinput form-group">
                                    <label>State</label>
                                    <select class="form-control" name="state" id="state" required>
                                        <option value="">Select</option>

                                        @if (isset($states) && count($states) > 0)

                                            @foreach ($states as $state)

                                                <option value="{{ $state->id }}" @if (isset($gstData->state_id) && $gstData->state_id == $state->id) selected @endif>{{ $state->name }}</option>

                                            @endforeach

                                        @endif

                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-6 col-12">
                                <div class="wdinput form-group">
                                    <label>City</label>
                                    <select class="form-control" name="city" id="city" required>

                                        <option value="">Select</option>

                                        @if (isset($cities) && count($cities) > 0)

                                            @foreach ($cities as $city)

                                                <option value="{{ $city->id }}"  @if (isset($gstData->city_id) && $gstData->city_id == $city->id) selected @endif >{{ $city->name }}</option>

                                            @endforeach

                                        @endif

                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-6 col-12">
                                <div class="wdinput form-group">
                                    <label>Pincode</label>
                                    <input type="text" class="form-control" value="{{ $gstData->pin_code ?? null }}" name="pin_code" placeholder="Enter Pin Code">
                                </div>
                            </div>
                            
                            <div class="col-xl-4 col-lg-4 col-md-6 col-12">
                                <div class="wdinput form-group">
                                    <label>CGST (%)</label>
                                    <input type="text" class="form-control" value="{{ $gstData->cgst_percent ?? null }}" name="cgst_percent" placeholder="Enter CGST (%)">
                                </div>
                            </div>
                            </div>
                            <div class="row">
                             <div class="col-xl-4 col-lg-4 col-md-6 col-12">
                                <div class="wdinput form-group">
                                    <label>IGST (%)</label>
                                    <input type="text" class="form-control" value="{{ $gstData->igst_percent ?? null }}" name="igst_percent" placeholder="Enter IGST % Code">
                                </div>
                            </div>
                            
                             <div class="col-xl-4 col-lg-4 col-md-6 col-12">
                                <div class="wdinput form-group">
                                    <label>SGST (%)</label>
                                    <input type="text" class="form-control" value="{{ $gstData->sgst_percent ?? null }}" name="sgst_percent" placeholder="Enter SGST (%)">
                                </div>
                            </div>
                            
                            <div class="col-xl-4 col-lg-4 col-md-6 col-12">
                                <div class="wdinput form-group">
                                    <label>Invoice Address</label>
                                    <textarea class="form-control" placeholder="Invoice Address"  name="invoice_address">{{ $gstData->invoice_address ?? null }}</textarea>
                                </div>
                            </div>
                        </div>

                           

                        <div class="row">
                            <div class="col-xl-4 col-lg-4 col-md-6 col-12">
                                <div class="wdinput form-group">
                                    <label class="form-group">
                                    <input type="checkbox" class="invoicenumber" name="invoice_status"  placeholder="Enter IGST % Code"{{ !empty($gstData->invoice_status) ? 'checked' : '' }}> Invoice Number
                                </label>
                                <div class="invoic-number">
                                    <div class="wdinput form-group">
                                    <label>Invoice Number</label>
                                    <input type="text" class="form-control" name="invoice_number" value="{{ $gstData->invoice_number ?? null }}" placeholder="Enter Invoice Number">
                                </div>
                                </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-lg-4 col-md-6 col-12">
                                <div class="wdinput form-group">
                                    <label class="form-group"> 
                                    <input type="checkbox" class="serialnumber" name="financial_year_status" placeholder="Enter IGST % Code" {{ !empty($gstData->financial_year_status) ? 'checked' : '' }}> Financial year & Month Required 
                                        </label>

                                        <div class="serial-number">
                                    <div class="wdinput form-group">
                                    <label>Serial Number</label>
                                    <input type="text" class="form-control" name="financial_serial_number" value="{{ $gstData->financial_serial_number ?? null }}" placeholder="Enter Serial Number">
                                </div>
                                </div>
                                </div>
                            </div>
                        </div>
                            <div class="col-xl-12">
                                <div class="wdinput form-group">
                                    <button class="btn adminbtn-blue btn-lg">Submit</button>
                                </div>
                            </div>
                        
                       </form>
            </div>
        </div>

        <div id="pane-F" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-F">
            <div class="card-header" role="tab" id="heading-A">
                <form method="post" id="codform" action="{{route('admin.saveCODDetails')}}">
                    @csrf
                    <div class="row">
                        <div class="col-xl-4 col-lg-4 col-md-6 col-12">
                            <div class="wdinput form-group">
                                <label>Want to show COD option on checkout?</label>
                                <select class="form-control" name="cod" id="cod" required>
                                    <option value="yes" {{ ($general_setting->cod == 'yes') ? 'selected' : '' }}>Yes</option>
                                    <option value="no" {{ ($general_setting->cod == 'no') ? 'selected' : '' }}>No</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-xl-4">
                            <div class="wdinput form-group mt-2">
                                <button class="btn adminbtn-blue btn-lg cod-update-btn">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div id="pane-G" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-G">
            <div class="card-header" role="tab" id="heading-A">
                <form id="panef-G" method="post" action="{{route('admin.saveLangDetails')}}">
                    @csrf
                    <div class="row">
                        
                        <div class="col-xl-4 col-lg-4 col-md-6 col-12">
                            <div class="wdinput form-group">
                                <label>Language Arabic</label>
                                <label class="switch">
                                <input type="checkbox" onchange="form.submit()"  name="lan_ar"
                                    id="lan_ar" value="1" {{ ($general_setting->lan_ar == 1) ? 'checked' : '' }}>
                                <span class="slider round"></span>
                            </label>
                                <!-- <input value="1" {{ ($general_setting->lan_ar == 1) ? 'checked' : '' }} onclick="document.getElementById('panef-G').submit();" name="lan_ar" type="checkbox"  id="lan_arr"> -->
                            </div>
                        </div>

                        <div class="col-xl-12">
                            <div class="wdinput form-group">
                                <!-- <button class="btn btn-primary">Submit</button> -->
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- End GST Form -->

    </div>
                    </div>

<!-- End New form Data  -->
<!-- Old Data Form -->
<!--                     <div class="row d-none">

                        <div class="col-xs-12">

                            <div class="card-body collapse in">

                                <div class="card-block card-dashboard">

                                    <div class="table-responsive">

                                        <form method="post" action="{{ route('admin.manage-general-setting.store') }}" enctype="multipart/form-data">

                                            @csrf

                                            <div class="card-body collapse in">

                                                <div class="card-block">

                                                    <div class="form-body">

                                                        <div class="form-group row">

                                                            <label class="col-md-2 label-control">Name*</label>

                                                            <div class="col-md-4">

                                                                <input type="text" class="form-control" placeholder="Enter name" name="name" value="{{ $general_setting->email ?? null }}" required>

                                                            </div>

                                                            <label class="col-md-2 label-control">Email*</label>

                                                            <div class="col-md-4">

                                                                <input type="email" class="form-control" placeholder="Enter Email Address" name="email" value="{{ $general_setting->email ?? null }}" required>

                                                            </div>

                                                        </div>

                                                        <div class="form-group row">

                                                            <label class="col-md-2 label-control">Mobile Number</label>

                                                            <div class="col-md-4">

                                                                <input type="text" class="form-control" placeholder="Enter Mobile number" name="mobile_number" value="{{ $general_setting->mobile_number ?? null }}" required>

                                                            </div>

                                                            <label class="col-md-2 label-control">Whatsapp Number</label>

                                                            <div class="col-md-4">

                                                                <input type="text" class="form-control" placeholder="Enter Whatsapp number" name="whatsapp_number" value="{{ $general_setting->whatsapp_number ?? null }}" required>

                                                            </div>

                                                        </div>



                                                        <div class="form-group row">

                                                            <label class="col-md-2 label-control">Map</label>

                                                            <div class="col-md-4">

                                                                <textarea class="form-control" name="map" cols="30" rows="10" required>{{ $general_setting->map ?? null }}</textarea>

                                                            </div>

                                                            <label class="col-md-2 label-control">Address</label>

                                                            <div class="col-md-4">

                                                                <textarea class="form-control" name="address" cols="30" rows="10" required>{{ $general_setting->address ?? null }}</textarea>

                                                            </div>

                                                        </div>



                                                        <div class="form-group row">

                                                            <label class="col-md-2 label-control">State</label>

                                                            <div class="col-md-4">

                                                                <select class="form-control" name="state" id="state" required>

                                                                    <option value="">Select</option>

                                                                    @if (isset($states) && count($states) > 0)

                                                                        @foreach ($states as $state)

                                                                            <option value="{{ $state->id }}" @if (isset($general_setting->state_id) && $general_setting->state_id == $state->id) selected @endif>{{ $state->name }}</option>

                                                                        @endforeach

                                                                    @endif

                                                                </select>

                                                            </div>



                                                            <label class="col-md-2 label-control">City</label>

                                                            <div class="col-md-4">

                                                                <select class="form-control" name="city" id="city" required>

                                                                    <option value="">Select</option>

                                                                    @if (isset($cities) && count($cities) > 0)

                                                                        @foreach ($cities as $city)

                                                                            <option value="{{ $city->id }}" @if ($general_setting->city_id == $city->id) selected @endif>{{ $city->name }}</option>

                                                                        @endforeach

                                                                    @endif

                                                                </select>

                                                            </div>

                                                        </div>

                                                        <div class="form-group row">

                                                            <label class="col-md-2 label-control">Header Logo</label>

                                                            <div class="col-md-4">

                                                                @if (isset($general_setting->header_logo) && Storage::exists($general_setting->header_logo))

                                                                    <img src="{{ URL::asset('storage/' . $general_setting->header_logo) }}" alt="" width="100" height="100">

                                                                @endif

                                                                <input type="file" class="form-control-file" name="header_logo">

                                                            </div>

                                                            <label class="col-md-2 label-control">Footer Logo</label>

                                                            <div class="col-md-4">

                                                                @if (isset($general_setting->footer_logo) && Storage::exists($general_setting->footer_logo))

                                                                    <img src="{{ URL::asset('storage/' . $general_setting->footer_logo) }}" alt="" width="100" height="100">

                                                                @endif

                                                                <input type="file" class="form-control-file" name="footer_logo">

                                                            </div>

                                                        </div>



                                                        <div class="form-group row">

                                                            <label class="col-md-2 label-control">Footer Content</label>

                                                            <div class="col-md-10">

                                                                <textarea class="form-control" name="footer_content" cols="30" rows="10" required>{{ $general_setting->footer_content ?? null }}</textarea>

                                                            </div>

                                                        </div>

                                                        <hr>

                                                        <h3>Social Media:</h3>

                                                        <br>

                                                        <div class="form-group row">

                                                            <label class="col-md-2 label-control">Facebook</label>

                                                            <div class="col-md-4">

                                                                <input type="text" class="form-control" placeholder="Enter Facebook" name="facebook" value="{{ $general_setting->facebook ?? null }}" required>

                                                            </div>

                                                            <label class="col-md-2 label-control">Twitter</label>

                                                            <div class="col-md-4">

                                                                <input type="text" class="form-control" placeholder="Enter Twitter" name="twitter" value="{{ $general_setting->twitter ?? null }}" required>

                                                            </div>

                                                        </div>



                                                        <div class="form-group row">

                                                            <label class="col-md-2 label-control">Instagram</label>

                                                            <div class="col-md-4">

                                                                <input type="text" class="form-control" placeholder="Enter instagram" name="instagram" value="{{ $general_setting->instagram ?? null }}" required>

                                                            </div>

                                                            <label class="col-md-2 label-control">Youtube</label>

                                                            <div class="col-md-4">

                                                                <input type="text" class="form-control" placeholder="Enter youtube" name="youtube" value="{{ $general_setting->youtube ?? null }}" required>

                                                            </div>

                                                        </div>

                                                        <hr>

                                                        <h3>GST Setting:</h3>

                                                        <br>

                                                        <div class="form-group row">

                                                            <label class="col-md-1 label-control">CGST (%)</label>

                                                            <div class="col-md-3">

                                                                <input type="text" class="form-control" placeholder="Enter CGST" name="cgst_percentage" value="{{ $general_setting->cgst_percentage ?? null }}" required>

                                                            </div>

                                                            <label class="col-md-1 label-control">SGST (%)</label>

                                                            <div class="col-md-3">

                                                                <input type="text" class="form-control" placeholder="Enter SGST" name="sgst_percentage" value="{{ $general_setting->sgst_percentage ?? null }}" required>

                                                            </div>

                                                            <label class="col-md-1 label-control">IGST (%)</label>

                                                            <div class="col-md-3">

                                                                <input type="text" class="form-control" placeholder="Enter IGST" name="igst_percentage" value="{{ $general_setting->igst_percentage ?? null }}" required>

                                                            </div>

                                                        </div>

                                                        <div class="form-group row">

                                                            <div class="col-sm-12 text-center">

                                                                <button type="submit" class="btn btn-primary">Submit</button>

                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        </form>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>-->

                    <!-- End Old data Form  --> 

                </section>

            </div>

        </div>

    </div>

</div>

@include('admin.footer')
<script>
        function toggle() {
            var data = $("#lan_arr").val();
            $.ajax({
                type:"POST",
                url:""
                data:data,
                dataType:'json',
                success:function(data){

                }

            })
        }
</script>

<script type="text/javascript">
    $(".invoic-number").hide();
$(".invoicenumber").click(function() {
    if($(this).is(":checked")) {
        $(".invoic-number").show();
    } else {
        $(".invoic-number").hide();
    }
});
</script>

<script type="text/javascript">
    $(".serial-number").hide();
$(".serialnumber").click(function() {
    if($(this).is(":checked")) {
        $(".serial-number").show();
    } else {
        $(".serial-number").hide();
    }
});
</script>

<script>

    $(document).ready(function() {

        $(document).on("change", "#state", function(event) {

            let state_id = $(this).val();

            $.ajax({

                url: `{{ URL::to('cities-by-state/${state_id}') }}`,

                type: "get",

                dataType: "json",

                success: function(result) {

                    if (result.success) {

                        $("#city").html(result.html);

                    }

                }

            });

        });

    });
 $(document).on("click", ".cod-update-btn", function(event) {
    event.preventDefault();
    $('#cod-err').html('');
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
            //  $(this).attr('disabled', true);
              var frm = $('#codform');
             var formData = new FormData(frm[0]);
            $.ajax({
                url: $('#codform').attr('action'),
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
        
        $(document).on("click", ".add-header-btn", function(event) {
    event.preventDefault();
    $('#email-err').html('');
     $('#tollfree_number-err').html('');
     $('#whatsapp_number-err').html('');
     $('#header_logo-err').html('');
     $('#footer_logo-err').html('');
     $('#favicon-err').html('');
     $('#coupon_code-err').html('');
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
            //  $(this).attr('disabled', true);
              var frm = $('#headerform');
             var formData = new FormData(frm[0]);
            $.ajax({
                url: $('#headerform').attr('action'),
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

$(document).on("click", ".social-update-btn", function(event) {
    event.preventDefault();
    $('#fb_name-err').html('');
     $('#twit_name-err').html('');
     $('#insta_name-err').html('');
     $('#linkedin_name-err').html('');
     $('#youtube_name-err').html('');
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
            //  $(this).attr('disabled', true);
              var frm = $('#socialform');
             var formData = new FormData(frm[0]);
            $.ajax({
                url: $('#socialform').attr('action'),
                 type: 'POST',
                 processData: false,
                contentType: false,
                dataType: 'json',
                data: formData,
                context: this,
                success: function(result) {
                    if (result.success) {
                        sessionStorage.setItem('social',true);
                        location.reload();
                    } else {
                        $(this).attr('disabled', false);
                        if (result.code == 422) {
                            for (const key in result.errors) {
                                $(`.socialformn #${key}-err`).html(result.errors[key][0]);
                            }
                        } else {
                            console.log(result);
                        }
                    }
                }
            });
        });
        
        $(document).on("click", ".contactus-update-btn", function(event) {
    event.preventDefault();
    $('#heading-err').html('');
     $('#description-err').html('');
     $('#address-err').html('');
     $('#map_url-err').html('');
     $('#whatsapp_number-err').html('');
     $('#contact_number-err').html('');
     $('#email-err').html('');
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
            //  $(this).attr('disabled', true);
              var frm = $('#contactusform');
             var formData = new FormData(frm[0]);
            $.ajax({
                url: $('#contactusform').attr('action'),
                 type: 'POST',
                 processData: false,
                contentType: false,
                dataType: 'json',
                data: formData,
                context: this,
                success: function(result) {
                    if (result.success) {
                        sessionStorage.setItem('contactus',true);
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
        
        
        $(function () {
        if ( sessionStorage.getItem('social') ) {
                $(".socialmediatab").click();
                sessionStorage.removeItem('social');
            }
            if ( sessionStorage.getItem('contactus') ) {
                $("#tab-D").click();
                sessionStorage.removeItem('contactus');
            }
});
</script>


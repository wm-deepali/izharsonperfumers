        
  <nav class="navbar navbar-main navbar-expand-lg border-bottom">
          <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav4" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="main_nav4">
              <ul class="navbar-nav">
                <li class="nav-item categories-menu dropdown">
                  <a class="nav-link position-relative " href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="{{asset('frontend/images/icon/menu.png')}}" class="menu-icon"> Category Menu<i class="fa fa-angle-down text-white down-arrow-icon"></i>
                  </a>
                  <div class="dropdown-menu w-100 p-3">
                    <div class="row">
                      <!-- show all category -->
                  
                    @php
                
                  $mainCategory = App\Models\Category::whereNull('parent_id')->get();
                  $subCategory = App\Models\Category::wherenotNull('parent_id')->get();
                   $sidebarData = App\Models\Category::whereNull('parent_id')->where('status','active')->get();

                  @endphp
                     @if (isset($sidebarData) && count($sidebarData) > 0)
                       @foreach ($sidebarData as $category)
                      
                      
                      <div class="col-xl-3 col-lg-3 col-md-6 col-12">
                        <h6 class="menuheading">{{$category->name}}</h6>
                        <ul class="submenu-list">
                        @if (isset($category->active_direct_childs) && count($category->active_direct_childs) > 0)
                        @foreach ($category->active_direct_childs as $subCat)

                        
                          <li><a href="{{ route('listing', 'page=1&category=' . $subCat->slug) }}">{{$subCat->name}} </a></li>
                        

                          @endforeach
                          @endif
                          <li><a href="{{ route('listing', 'page=1&category=' . $category->slug) }}">View All</a></li>
                        </ul>
                      </div>
                      @endforeach
                      @endif
                      <!-- end show category -->
                      
                    </div>
                  </div>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{url('/')}}">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{route('aboutUs')}}">About Us</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{route('getBestSales')}}">Best Sales</a>
                </li>
                <li class="nav-item">
                   @if (Auth::guard('customer')->check())
                     <input type="hidden" name="user_type" id="user_type" value="loggedIn">
                    <a href="{{route('getFeedback')}}" class="nav-link user_type">Feed Back</a>
                    @else
                     <input type="hidden" name="user_type" id="user_type" value="visiter">
                    <a href="{{route('getFeedback')}}" class="nav-link user_type" >Feed Back</a>
                    @endif
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{route('getBlogData')}}">Blogs</a>
                </li>

                 <li class="nav-item">
                  <a class="nav-link" href="{{route('faqs')}}">FAQs</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{route('getContactUsForm')}}">Contact Us</a>
                </li>
                
                </ul>
            </div>
            <!-- collapse .// -->
          </div>
          <!-- container .// -->
        </nav>
      </div>
      <div class="mobile">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-3 col-3 text-left">
              <a style="cursor:pointer" onclick="openNav()" class="nb-p">
              
                <span class="iconify" data-icon="system-uicons:menu-hamburger" style="color: black;" data-height="30"></span>
              </a>
              <div id="mySidenav" class="sidenav">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">Close <span class="iconify" data-icon="radix-icons:cross-2" data-height="20"></span>
                </a>
                <div class="sideBar">
                  <ul>
                    <li class="nav-item">
                      <a class="nav-link" href="{{url('/')}}">Home</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{route('aboutUs')}}">About Us</a>
                    </li>
                    
                    <li class="nav-item" id="vertical-menu">
                      
    <ul>
       @if (isset($mainCategory) && count($mainCategory) > 0)
          @foreach ($mainCategory as $category)
        <li >
              <h3 class="nav-link"><span class="plus">+</span>{{$category->name}}</h3>

            <ul>
              @if(isset($subCategory) && count($subCategory) > 0)
                 @foreach($subCategory as $subCat)
                  @if($category->id == $subCat->parent_id)
                <li><a href="{{ url('view-all',$subCat->id) }}">{{$subCat->name}}</a> </li>
                @endif

                @endforeach
                @endif
             
                <li><a href="{{url('view-all/'.$category->id)}}">View All</a> </li>
            </ul>
        </li>
        @endforeach
        @endif

        <!-- we will keep this LI open by default -->

    </ul>

                    </li>

                    <li class="nav-item">
                      <a class="nav-link" href="{{route('getBestSales')}}">Best Sales</a>
                    </li>
                    <li class="nav-item">
                     @if (Auth::guard('customer')->check())
                     <input type="hidden" name="user_type" id="user_type" value="loggedIn">
                    <a href="{{route('getFeedback')}}" class="nav-link user_type">Feed Back</a>
                    @else
                     <input type="hidden" name="user_type" id="user_type" value="visiter">
                    <a href="{{route('getFeedback')}}" class="nav-link user_type" >Feed Back</a>
                    @endif
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{route('getBlogData')}}">Blogs</a>
                    </li>
                    
                    <li class="nav-item">
                      <a class="nav-link" href="{{route('faqs')}}">FAQs</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{route('getContactUsForm')}}">Contact Us</a>
                    </li>
                    
                  </ul>
                </div>
              </div>
            </div>
            @php
$topheaderData = App\Models\HeaderSetting::first();
            @endphp
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-6 text-center">
              <div class="d-flex justify-content-center align-items-center  h-100">
                <a href="{{url('/')}}" class="brand-wrap">
                   @if (isset($topheaderData->header_logo) && Storage::exists($topheaderData->header_logo))
                    <img class="logo m-0"  src="{{ URL::asset('storage/' . $topheaderData->header_logo) }}" >
                @endif
                
                </a>
              </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-3 col-3 text-right">
              <a href="#" class="nb-p">
                <span class="iconify" data-icon="prime:shopping-bag" style="color: black;" data-height="28"></span>
                <span class="notify mbs color-green">2</span>
              </a>
            </div>
          </div>
        </div>
      </div>
      <!-- navbar main end.// -->
    </header>

    <!-- header navbar end  -->
@extends('frontend.includes.main')
@section('title','Blog details')
@section('content')
    <section class="py-3 bg-light">
      <div class="container">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb custom-breadcumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Blog & Articles</li>
          </ol>
        </nav>
      </div>
    </section>

    <section class="my-3">
      <div class="container">
      <div class="blog-section-main">
        <div class="blog-sidebar">
          <div class="blog-search-section position-relative">
            <div class="wdinput">
              <input type="text" class="form-control" placeholder="Search" name="">
              <button class="btn search-btn"><i class="fa fa-search"> </i> </button>
            </div>
          </div>
          <div class="blog-recent-post p-3 my-3 border">
            <h6 class="mb-3">Recent Post</h6>
            <div class="recent-post-blog">
               @if(count($blogs)> 0 )
              @foreach($blogs as $blog)
              <a href="" class="recent-post-blog-box d-flex p-2">
                <div class="recent-post-img">
                  @if (isset($blog->image) && Storage::exists($blog->image))
                    <img src="{{ URL::asset('storage/' . $blog->image) }}" class="img-fluid">
                      @else
                      NA
                      @endif
                </div>
                <div class="recent-post-content px-2">
                
                  <h6>{{$blog->author}}</h6>
                  <p>{{\Carbon\Carbon::parse($blog->created_at)->format('d M, Y')}}</p>
                </div>
              </a>

              @endforeach
              @else
              No recent post fonund!
              @endif
            
              
             
            </div>
          </div>
          <div class="tags-post-section border p-3">
            <h6 class="mb-3">Tags</h6>

            <div class="tags-btn">
              <button class="btn bg-dark text-white mb-2">#Blog</button>
              <button class="btn bg-dark text-white mb-2">#News</button>
              <button class="btn bg-dark text-white mb-2">#Fashion</button>
            </div>
          </div>
        </div>
        <div class="blog-right-section blog-detail-right-section">
        
          <div class="blog-section-box p-2 ">
            <div class="blog-img-sec mb-3">
               @if (isset($blogDetails->image) && Storage::exists($blogDetails->image))
                    <img src="{{ URL::asset('storage/' . $blogDetails->image) }}" class="img-fluid">
                      @else
                      NA
                  @endif
         
          </div>
          <div class="blog-list-content">
           

            <div class="blog-list-content-full">
              <h5>{{$blogDetails->title}}</h5>
                {!! ($blogDetails->content) !!}

            
              <blockquote class="bg-light p-3 blockquote-sec text-center">
              <i class="fa fa-quote-left quote-icon" aria-hidden="true"></i>
              <h6 class="mb-3">By {{$blogDetails->author}}</h6>
              <i class="fa fa-calendar calendar-icon mr-3"> {{\Carbon\Carbon::parse($blogDetails->created_at)->format('d M, Y')}} </i>
               <i class="fa fa-comment-o comment-icon"> 0 </i>
              </blockquote>

              <div class="tags-btn mt-3">
              <button class="btn bg-dark text-white mb-2">#Blog</button>
              <button class="btn bg-dark text-white mb-2">#News</button>
              <button class="btn bg-dark text-white mb-2">#Fashion</button>
            </div>
             
            </div>
          </div>
        </div>
        
      
        </div>
      </div>
    </div>
    </section>


    @endsection
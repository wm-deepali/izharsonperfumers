@extends('frontend.includes.main')
@section('title','About Us')
@section('content')
      <section class="py-5 bg-light mb-3">
         <div class="container text-center">
            <h2>{{$about_us->title}}</h2>
            <nav aria-label="breadcrumb">
               <ol class="breadcrumb custom-breadcumb d-flex justify-content-center">
                  <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">About Us</li>
               </ol>
            </nav>
         </div>
      </section>

      <!-- ext  -->

      <!-- end  -->
      <section class="about-us-section">
         <div class="container">
            <div class="about-us-flex mb-5">
            <div class="about-us-left">
                {!! $about_us->content ?? '-' !!}
            </div>
            <div class="about-us-right">
                @if (isset($about_us) && Storage::exists($about_us->image))
                    <img src="{{ URL::asset('storage/' . $about_us->image) }}" class="img-fluid">
                @endif
            </div>
        </div>
         </div>
      </section>
      <section class="client-says py-5">
         <div class="container">
            <h2 class="text-center mb-3">What Client Say</h2>
            <h6 class="text-center">Stories of Success of our clients</h6>
            <div class="client-say-slider">
               <div class="owl-carousel owl-theme my-3" id="clientsays">
                  <div class="item">
                     <div class="client-says-sec text-center">
                        <img src="{{asset('frontend/images/client/client-1.png')}}">
                        <div class="client-reviews mb-3">
                           <i class="fa fa-star"></i>
                           <i class="fa fa-star"></i>
                           <i class="fa fa-star"></i>
                           <i class="fa fa-star"></i>
                           <i class="fa fa-star"></i>
                        </div>
                        <div class="client-say-reviews">
                           <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                              tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                              quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                              consequat. 
                           </p>
                        </div>
                        <div class="client-names">
                           <h6 class="mt-3">Nancy</h6>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>

      <script>
         $('#clientsays').owlCarousel({
           loop:true,
           margin:10,
           nav:false,
           responsive:{
             0:{
               items:1
             },
             600:{
               items:1
             },
             1000:{
               items:1
             }
           }
         })
      </script>

@endsection
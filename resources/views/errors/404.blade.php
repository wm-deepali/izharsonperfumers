@extends('front.app')

@section('title', '404 Error Page')

@section('content')

	<!-- Our Error Page -->
  	<section class="our-error">
  		<div class="container">
  			<div class="row">
          <div class="col-xl-6">
            <div class="animate_content text-center text-xl-start">
              <div class="animate_thumb">
                <img src="{{ asset('front/images/resource/error-page-img.svg')}}" alt="error-page-img">
              </div>
            </div>
          </div>
          <div class="col-xl-6">
            <div class="error_page_content mt80 mt50-lg text-center text-xl-start">
              <div class="erro_code">40<span class="text-thm">4</span></div>
              <div class="error_title">Oops! It looks like you're lost.</div>
              <p>The page you're looking for isn't available. Try to search again or use the go to.</p>
              <a class="btn-thm btn_error" href="{{ url('/') }}">Go Back To Homepages</a>
            </div>
          </div>
  			</div>
  		</div>
  	</section>
    
@endsection
@extends('frontend.includes.main')
@section('title','Privacy & Policy')
@section('content')
  <section class="py-5 bg-light mb-3">
        <div class="container text-center">
          <h2>Privacy Policy</h2>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb custom-breadcumb d-flex justify-content-center">
              <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Privacy Policy</li>
            </ol>
          </nav>
        </div>
      </section>

      <section class="policy-section py-3">
        <div class="container">
          <div class="border p-2 mb-2">
          	{!! ($data[0]->content) !!}
          <!-- <h4>Payment Policy</h4>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
          tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
          quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
          consequat. </p>
        <ul>
          <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
          tempor incididunt ut labore et dolore magna aliqua. </li>

          <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
          tempor incididunt ut labore et dolore magna aliqua.</li>

          <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
          tempor incididunt ut labore et dolore magna aliqua.</li>

          
        </ul> -->
      </div>

      <!-- <div class="border p-2 mb-2">
        <h4>Order Return</h4>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
          tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
          quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
          consequat. </p>
        <ul>
          <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
          tempor incididunt ut labore et dolore magna aliqua. </li>

          <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
          tempor incididunt ut labore et dolore magna aliqua.</li>

          <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
          tempor incididunt ut labore et dolore magna aliqua.</li>

          
        </ul>
      </div> -->
        
      </div>
      </section>
@endsection
@extends('front.app')

@section('title', 'Page Vendor List')

@section('content')

  <!-- Inner Page Breadcrumb -->
  <section class="inner_page_breadcrumb">
    <div class="container">
      <div class="row">
        <div class="col-xl-6">
          <div class="breadcrumb_content">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="{{ url('/') }}">Home</a>
              </li>
              <li class="breadcrumb-item active" aria-current="page"><a href="#">Terms and Conditions</a></li>
            </ol>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Our Terms & Conditions -->
  <section class="our-terms pt60">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 offset-lg-3">
          <div class="main-title text-center">
            <h2>Terms and Conditions</h2>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="terms_condition_grid text-start">
            <div class="grids mb60">
              {!! $policy->content !!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection
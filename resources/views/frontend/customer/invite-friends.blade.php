@extends('frontend.includes.main')
@section('title','Change Password')
@section('content')



    <section class="py-3 bg-light">
      <div class="container">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb custom-breadcumb">
           <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('listing') }}">Shop</a></li>
            <li class="breadcrumb-item active" aria-current="page">Invite Friend</li>
          </ol>
        </nav>
      </div>
    </section>

    <section>
      <div class="container">
        <div class="dashboard-flex-section d-flex my-3">
            @include('frontend.customer.dashboard_side_bar')
           <div class="dashboard-right-section border">
                <div class="d-flex border-bottom ">
                    <h1 class="h5 font-weight-medium pb-2">Invite Friends</h1>
                </div>
                <div class="dasboard-box mt-3 text-center d-flex">
                    <img src="{{ URL::asset('website/images/icon/offers.png') }}" alt="" class="offer-img">
                    <div class="referal-code">
                        <h5>Referal Code</h5>
                        <div class="wdinput refral-code-copy position-relative">
                            <input type="text" class="form-control" name="" id="codecopy" value="{{ $customer->referral_code }}" readonly>
                            <button class="btn copy-code-btn" onClick="copyToClipboard()"> <i class="fa fa-copy"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        <button class="filter-btn btn" id="filterbtn"><i class="fa fa-bars"></i> </button>
        </div>
      </div>
    </section>
    
@endsection
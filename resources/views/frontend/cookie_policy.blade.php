@extends('frontend.includes.main')
@section('title','Cookies & Policy')
@section('content')

 <section class="py-5 bg-light mb-3">
        <div class="container text-center">
          <h2>Cookies Policy</h2>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb custom-breadcumb d-flex justify-content-center">
              <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Cookie Policy</li>
            </ol>
          </nav>
        </div>
      </section>

      <section class="policy-section py-3">
        <div class="container">
        {!! ($data[0]->content) !!}
      </div>
      </section>
      @endsection


@extends('frontend.includes.main')

@section('title','Refund & Cancellation')

@section('content')

  <section class="py-5 bg-light mb-3">

        <div class="container text-center">

          <h2>Refund & Cancellation Policy</h2>

          <nav aria-label="breadcrumb">

            <ol class="breadcrumb custom-breadcumb d-flex justify-content-center">

              <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>

              <li class="breadcrumb-item active" aria-current="page">Refund & Cancellation Policy</li>

            </ol>

          </nav>

        </div>

      </section>



      <section class="feedback-section mt-5">

        <div class="container">

          <div class="faq-section">



            <div class="faqs-box mb-3">

              <!-- <h2>{{$data[0]->name}}</h2>

              <div class="faqs-box-pnl mb-2">

                <h6>When do I recive my order ?</h6>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod

                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,

                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo

                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse

                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non

                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

              </div>

              <div class="faqs-box-pnl mb-2">

                <h6>Return Policy 7 Days</h6>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod

                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,

                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo

                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse

                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non

                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

              </div> -->

              {!! ($data[0]->content) !!}

            </div>



        <!--     <div class="faqs-box mb-3">

              <h2>02.What is a Return Policy</h2>

              <div class="faqs-box-pnl mb-2">

                <h6>When do I recive mu order ?</h6>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod

                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,

                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo

                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse

                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non

                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

              </div>

              <div class="faqs-box-pnl mb-2">

                <h6>I now see the longer delivery time of (a part of ) my order. How  can I cancel it?</h6>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod

                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,

                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo

                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse

                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non

                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

              </div>

            </div>

 -->



           <!--  <div class="faqs-box mb-3">

              <h2>03.Secure with your Payment</h2>

              <div class="faqs-box-pnl mb-2">

                <h6>When do I recive mu order ?</h6>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod

                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,

                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo

                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse

                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non

                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

              </div>

              <div class="faqs-box-pnl mb-2">

                <h6>When do I recive mu order ?</h6>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod

                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,

                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo

                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse

                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non

                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

              </div>

            </div> -->

<!-- 

            <div class="faqs-box mb-3">

              <h2>04.Return , Exchange & Complaints</h2>

              <div class="faqs-box-pnl mb-2">

                <h6>When do I recive mu order ?</h6>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod

                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,

                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo

                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse

                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non

                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

              </div>

              <div class="faqs-box-pnl mb-2">

                <h6>I now see the longer delivery time of (a part of ) my order. How  can I cancel it?</h6>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod

                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,

                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo

                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse

                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non

                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

              </div>

            </div> -->

          </div>

        </div>

      </section>



@endsection


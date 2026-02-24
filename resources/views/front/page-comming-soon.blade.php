@extends('front.app')

@section('title', 'Page Vendor List')

@section('content')
    <!-- Our Error Page -->
    <section class="coming-soon">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-xl-6">
                    <div class="animate_content text-center text-xl-start">
                        <div class="animate_thumb">
                            <img src="{{ asset('front/images/resource/coming-soon.svg')}}" alt="coming-soon">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-5">
                    <div class="error_page_content mt80 mt30-lg mb30 text-center text-lg-start ps-0 ps-lg-3">
                        <div class="error_title">Coming Soon</div>
                        <p>We’re almost done. Subscribe us to get notified once we set everything online.</p>
                    </div>
                    <div class="event_counter_plugin_container ps-0 ps-lg-3 text-center text-lg-start">
                        <div class="event_counter_plugin_content">
                            <ul>
                                <li class="text-center"><span id="days"></span><span class="schdule">days</span></li>
                                <li class="text-center"><span id="hours"></span><span class="schdule">Hours</span></li>
                                <li class="text-center"><span id="minutes"></span><span class="schdule">Minutes</span></li>
                                <li class="text-center"><span id="seconds"></span><span class="schdule">Seconds</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="ui_kit_input mt20 ps-0 ps-lg-3">
                        <form>
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Your email address">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
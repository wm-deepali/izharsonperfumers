@extends('front.app')

@section('title', 'About Us')

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

                            <li class="breadcrumb-item active" aria-current="page">
                                {{ $about->title }}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Us & Team -->
    <section class="our-team pt0 pb40">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-lg-3">
                    <div class="aboutus_thumb">
                        <img class="img-fluid w100" src="{{ asset('storage/' . $about->image) }}" alt="{{ $about->title }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-10 m-auto pt30">
                    <div class="main-title">
                        <h2>{{ $about->title }}</h2>
                    </div>
                    <div class="about_us_content mb30 mt15">
                        <h4 class="title">
                            {{ $about->description }}
                        </h4>
                        {!! $about->content !!}
                    </div>
                </div>
               
                <!-- <div class="col-xl-10 m-auto pt60 bdrt1">
                    <div class="main-title">
                        <h2>Meet Our Leaders</h2>
                    </div>
                    <div class="row">
                        @foreach ($team as $member)
                            <div class="col-sm-6 col-lg-3">
                                <div class="team_member">
                                    <div class="thumb">
                                        <img class="img-fluid"
                                            src="{{ $member->image ? asset('storage/' . $member->image) : asset('front/images/team/1.jpg') }}"
                                            alt="1.jpg">
                                        <div class="overylay">
                                            <ul class="social_icon text-center">
                                                <li class="list-inline-item"><a href="#"><i class="fab fa-facebook"></i></a>
                                                </li>
                                                <li class="list-inline-item"><a href="#"><i class="fab fa-x-twitter"></i></a>
                                                </li>
                                                <li class="list-inline-item"><a href="#"><i class="fab fa-instagram"></i></a>
                                                </li>
                                                <li class="list-inline-item"><a href="#"><i class="fab fa-linkedin-in"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="details">
                                        <h4>{{ $member->name }}</h4>
                                        <p>{{ $member->designation }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div> -->
            </div>
         
            <div class="row mt60">
                <div class="col-xl-10 m-auto pt60 bdrt1">
                    <div class="main-title">
                        <h2>Why Should You Choose Us</h2>
                    </div>
                </div>
                <div class="col-xl-10 m-auto">
                    <div class="row">
                        @foreach($features as $feature)
                    <div class="col-sm-6 col-md-3">
                        <div class="icon_boxes about_style text-center">
                            <div class="icon">
                                <span class="{{ $feature->icon }}"></span>
                            </div>
                            <div class="details">
                                <h5 class="title">{{ $feature->title }}</h5>
                                <p class="para">{{ $feature->description }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Testimonials -->
    <section class="our-testimonial bgc-gmart-gray">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col">
                    <div class="main-title text-center">
                        <p>The review are in</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="zmart_testimonial_slider swiper mySwiper">
                        <div class="swiper-wrapper">
                            @foreach ($feedbacks as $feedback)
                                <div class="swiper-slide">
                                    <div class="zmart_testimonial1">
                                        <div class="review mb30 text-center">
                                            <ul>
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <li class="list-inline-item">
                                                        <a href="#">
                                                            <span
                                                                class="fas fa-star {{ $i <= $feedback->rating ? 'text-warning' : 'text-muted' }}"></span>
                                                        </a>
                                                    </li>
                                                @endfor
                                            </ul>
                                        </div>
                                        <div class="testimonial_contents text-center">
                                            <p class="main_title">{{ $feedback->message }}</p>
                                            <p class="author">{{ $feedback->first_name }} {{ $feedback->last_name }}</p>
                                            <p class="author_post">{{ $feedback->email }}</p>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                        </div>
                        <div class="swiper-button-next"><span class="fas fa-chevron-right"></span></div>
                        <div class="swiper-button-prev"><span class="fas fa-chevron-left"></span></div>
                        <div class="zmart_testimonial_slider d-flex justify-content-center">
    <div class="slideactive">1</div>
    <div class="slidetotal">{{ $feedbacks->count() }}</div>
</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
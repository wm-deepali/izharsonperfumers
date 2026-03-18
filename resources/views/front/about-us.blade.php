@extends('front.app')

@section('title', 'About Us')

@section('content')
    <style>
        /* === About Us Page Custom Styles === */
        .inner_page_breadcrumb {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-bottom: 1px solid #dee2e6;
        }

        .breadcrumb {
            background: transparent;
            padding: 0;
            margin: 0;
        }

        .breadcrumb-item + .breadcrumb-item::before {
            color: #6c757d;
        }

        .about-section {
            padding: 80px 0;
        }

        .aboutus_thumb img {
            border-radius: 16px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.12);
            transition: transform 0.4s ease, box-shadow 0.4s ease;
        }

        .aboutus_thumb img:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px rgba(0,0,0,0.18);
        }

        .main-title h2 {
            font-size: 2.5rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 1.2rem;
            position: relative;
            padding-bottom: 12px;
        }

        .main-title h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: #007bff;
            border-radius: 2px;
        }

        .about_us_content .title {
            font-size: 1.35rem;
            font-weight: 600;
            color: #2c3e50;
            line-height: 1.4;
            margin-bottom: 1.5rem;
        }

        .about_us_content .content {
            font-size: 1.08rem;
            line-height: 1.8;
            color: #444;
            text-align:start;
        }

        .icon_boxes {
            transition: all 0.35s ease;
            background: white;
            border-radius: 12px;
            padding: 35px 25px;
            box-shadow: 0 5px 25px rgba(0,0,0,0.06);
            border: 1px solid #f0f0f0;
        }

        .icon_boxes:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.12);
            border-color: #007bff33;
        }

        .icon_boxes .icon span {
            font-size: 3.2rem;
            background: linear-gradient(135deg, #007bff, #00c4ff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: inline-block;
        }

        .icon_boxes .title {
            font-size: 1.25rem;
            font-weight: 600;
            margin: 1rem 0 0.75rem;
            color: #1f2937;
        }

        .icon_boxes .para {
            color: #64748b;
            font-size: 0.98rem;
            line-height: 1.7;
        }

        /* Testimonials */
        .our-testimonial {
            background: #f8fafc;
            padding: 100px 0 80px;
        }

        .zmart_testimonial1 {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.08);
            padding: 40px 35px;
            transition: transform 0.3s ease;
            max-width: 720px;
            margin: 0 auto;
        }

        .zmart_testimonial1:hover {
            transform: translateY(-6px);
        }

        .review ul {
            margin: 0;
            padding: 0;
        }

        .review .fa-star {
            font-size: 1.4rem;
            margin: 0 4px;
        }

        .testimonial_contents .main_title {
            font-size: 1.28rem;
            line-height: 1.9;
            font-style: italic;
            color: #334155;
            margin-bottom: 1.8rem;
            font-weight: 500;
        }

        .testimonial_contents .author {
            font-size: 1.15rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 0.3rem;
        }

        .testimonial_contents .author_post {
            font-size: 0.95rem;
            color: #64748b;
        }

        .swiper-button-next,
        .swiper-button-prev {
            color: #007bff !important;
            background: rgba(255,255,255,0.9);
            width: 50px;
            height: 50px;
            border-radius: 50%;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: all 0.3s;
        }

        .swiper-button-next:hover,
        .swiper-button-prev:hover {
            background: #007bff;
            color: white !important;
        }

        .slide-counter {
            font-size: 1.1rem;
            font-weight: 600;
            color: #1e293b;
        }

        @media (max-width: 991px) {
            .about-section {
                padding: 60px 0;
            }
            .main-title h2 {
                font-size: 2.1rem;
            }
        }

        @media (max-width: 576px) {
            .zmart_testimonial1 {
                padding: 30px 20px;
            }
            .main-title h2::after {
                left: 0;
                transform: none;
            }
        }
        
        /* Detailed Content Card */
.about-detail-card {
    background: #ffffff;
    border-radius: 16px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.about-detail-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.12);
}

.detailed-content {
    font-size: 1.05rem;
    line-height: 1.85;
    color: #333;
}

.detailed-content p {
    margin-bottom: 1.4rem;
}

.detailed-content h2, .detailed-content h3, .detailed-content h4 {
    color: #1a1a1a;
    margin: 2rem 0 1rem;
    font-weight: 600;
}

.detailed-content h2 {
    font-size: 1.8rem;
}

.detailed-content h3 {
    font-size: 1.5rem;
}

.detailed-content ul, .detailed-content ol {
    padding-left: 1.8rem;
    margin-bottom: 1.5rem;
}

.detailed-content li {
    margin-bottom: 0.6rem;
}

/* Better readability on mobile */
@media (max-width: 767px) {
    .card-body {
        padding: 2rem 1.25rem !important;
    }
    .detailed-content {
        font-size: 1.02rem;
    }
}
    </style>

    <!-- Inner Page Breadcrumb -->
    <section class="inner_page_breadcrumb py-4 py-md-5">
        <div class="container">
            <div class="row">
                <div class="col-xl-6">
                    <div class="breadcrumb_content">
                        <ol class="breadcrumb mb-0">
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

    <!-- About Us & Features -->
    <section class="our-team about-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 mb-5 mb-lg-0">
                    <div class="aboutus_thumb">
                        <img class="img-fluid w-100" 
                             src="{{ asset('storage/' . $about->image) }}" 
                             alt="{{ $about->title }}">
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="main-title text-center text-lg-start">
                        <h2>{{ $about->title }}</h2>
                    </div>
                    <div class="about_us_content mb-4">
                        <!--<h4 class="title">-->
                        <!--    {{ $about->description }}-->
                        <!--</h4>-->
                        <div class="content">
                            {!! $about->description !!}
                        </div>
                        <!--<div class="content">-->
                        <!--    {!! $about->content !!}-->
                        <!--</div>-->
                    </div>
                </div>
            </div>
            
            <div class="row mt-5">
            <div class="col-12">
                <div class="card about-detail-card shadow-lg border-0 rounded-4 overflow-hidden">
                    <div class="card-body p-4 p-lg-5">
                        <div class="detailed-content">
                            {!! $about->content !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

            <!-- Why Choose Us -->
            <div class="row mt-5 pt-5">
                <div class="col-12">
                    <div class="main-title text-center">
                        <h2>Why Should You Choose Us</h2>
                    </div>
                </div>

                <div class="col-12 mt-4">
                    <div class="row g-4">
                        @foreach($features as $feature)
                            <div class="col-sm-6 col-lg-3">
                                <div class="icon_boxes text-center">
                                    <div class="icon mb-3">
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

    <!-- Testimonials -->
    <section class="our-testimonial">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <div class="main-title">
                        <h2>What Our Clients Say</h2>
                        <p class="text-muted mt-2">The reviews are in</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="zmart_testimonial_slider swiper mySwiper">
                        <div class="swiper-wrapper">
                            @foreach ($feedbacks as $feedback)
                                <div class="swiper-slide">
                                    <div class="zmart_testimonial1">
                                        <div class="review mb-4 text-center">
                                            <ul class="list-inline mb-0">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <li class="list-inline-item">
                                                        <span class="fas fa-star {{ $i <= $feedback->rating ? 'text-warning' : 'text-muted' }}"></span>
                                                    </li>
                                                @endfor
                                            </ul>
                                        </div>
                                        <div class="testimonial_contents text-center">
                                            <p class="main_title">“{{ $feedback->message }}”</p>
                                            <p class="author">{{ $feedback->first_name }} {{ $feedback->last_name }}</p>
                                            <p class="author_post">{{ $feedback->email }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="swiper-button-next"><i class="fas fa-chevron-right"></i></div>
                        <div class="swiper-button-prev"><i class="fas fa-chevron-left"></i></div>

                        <div class="d-flex justify-content-center mt-4 slide-counter">
                            <span class="slideactive me-2">1</span>
                            <span class="text-muted">/ {{ $feedbacks->count() }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
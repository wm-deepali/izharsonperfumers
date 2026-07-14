@extends('front.app')
@section('title', 'Contact Us')

<style>
        /* IZHARSON FAQ - Brand Matched Colors (Purple + Gold Theme) */
        .iz-faq-hero {
            padding: 50px 0 50px;
            background: linear-gradient(135deg, #f5f3ff 0%, #faf5ff 100%); /* light purple tint */
            position: relative;
        }

        .iz-faq-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at 20% 30%, rgba(107,33,182,0.06) 0%, transparent 60%);
            pointer-events: none;
        }

        .iz-faq-title {
            font-size: 2.8rem;
            font-weight: 800;
            color: #000000; 
            margin-bottom: 0.8rem;
            letter-spacing: -0.6px;
        }

        .iz-faq-subtitle {
            font-size: 1.18rem;
            color: #4b5563;
            max-width: 680px;
            margin: 0 auto;
            font-weight: 400;
        }

        .iz-faq-category {
            font-size: 2.1rem;
            font-weight: 700;
            color: #000000; /* purple for categories */
            margin: 0rem 0 2.2rem ;
            position: relative;
            text-align: center;
        }

        .iz-faq-category::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 5px;
            background: linear-gradient(to right, #d4af37, #facc15); /* gold gradient */
            border-radius: 3px;
        }

        .iz-faq-wrapper {
            max-width: 880px;
            margin: 0 auto 6rem;
        }

        .iz-faq-item {
            background: white;
            border-radius: 18px;
            margin-bottom: 1.4rem;
            box-shadow: 0 8px 24px rgba(107,33,182,0.08); /* subtle purple shadow */
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .iz-faq-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 16px 40px rgba(107,33,182,0.12);
        }

        .iz-faq-question {
            width: 100%;
            padding: 1.6rem 2.2rem;
            font-size: 1.14rem;
            font-weight: 600;
            color: #1f2937;
            background: transparent;
            border: none;
            text-align: left;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 1.2rem;
            transition: background 0.3s;
        }

        .iz-faq-question-number {
            min-width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #d4af37, #facc15); /* gold brand color */
            color: #1e1b32; /* dark for contrast */
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 1.15rem;
            flex-shrink: 0;
            box-shadow: 0 2px 8px rgba(212,175,55,0.3);
        }

        .iz-faq-toggle-icon {
            margin-left: auto;
            font-size: 1.5rem;
            color: #000000; /* purple */
            transition: transform 0.4s ease, color 0.3s;
        }

        .iz-faq-item.active .iz-faq-toggle-icon {
            transform: rotate(180deg);
            color: #d4af37; /* gold when open */
        }

        .iz-faq-answer {
            max-height: 0;
            overflow: hidden;
            padding: 0 2.2rem;
            background: #f5f3ff; /* very light purple */
            transition: max-height 0.45s ease, padding 0.4s ease;
            color: #374151;
            line-height: 1.8;
            font-size: 1.04rem;
        }

        .iz-faq-item.active .iz-faq-answer {
            max-height: 1400px;
            padding: 2rem 2.2rem 2.4rem;
        }

        .iz-faq-answer p:last-child {
            margin-bottom: 0;
        }

        @media (max-width: 991px) {
            .iz-faq-title { font-size: 2.4rem; }
            .iz-faq-category { font-size: 1.85rem; margin: 3rem 0 1.8rem; }
        }

        @media (max-width: 576px) {
            .iz-faq-hero { padding: 80px 0 50px; }
            .iz-faq-title { font-size: 2rem; }
            .iz-faq-question { padding: 10px; font-size: 14px; }
            .iz-faq-question{
                gap:10px;
            }
            .iz-faq-question-number {
    min-width: 35px;
    height: 35px;
    background: linear-gradient(135deg, #d4af37, #facc15);
    color: #1e1b32;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 14px;
    flex-shrink: 0;
    box-shadow: 0 2px 8px rgba(212, 175, 55, 0.3);
}
.iz-faq-item.active .iz-faq-answer {
    max-height: 1400px;
    padding: 15px;
}


        }
        
          .feature-card {
    height: 100%;
    background: rgba(255, 255, 255, 0.25);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border: 1px solid rgba(255, 255, 255, 0.35);
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 
        0 8px 32px rgba(31, 38, 135, 0.15),
        inset 0 0 0 1px rgba(255, 255, 255, 0.18);
    transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
    position: relative;
}

.feature-card:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 
        0 20px 40px rgba(31, 38, 135, 0.22),
        inset 0 0 0 1px rgba(255, 255, 255, 0.28);
}

.card-content {
    padding: 2rem 1.5rem;
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
    height: 100%;
}

.icon-wrapper {
    width: 70px;
    height: 70px;
    background: linear-gradient(135deg, rgba(255,255,255,0.9), rgba(240,245,255,0.7));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1.4rem;
    box-shadow: 
        0 6px 12px rgba(0,0,0,0.08),
        inset 0 2px 4px rgba(255,255,255,0.9);
    transition: all 0.4s ease;
}

.feature-card:hover .icon-wrapper {
    transform: scale(1.12) translateY(-4px);
    box-shadow: 
        0 10px 20px rgba(0,0,0,0.12),
        inset 0 3px 6px rgba(255,255,255,1);
}

.feature-icon {
    font-size: 2.1rem;
    color: #6366f1;          /* indigo-500 – change to your brand color */
    background: linear-gradient(45deg, #6366f1, #8b5cf6);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.card-title {
    font-weight: 700;
    font-size: 1.25rem;
    margin-bottom: 1rem;
    color: #1e293b;
}

.card-text {
    font-size: 0.98rem;
    color: #475569;
    line-height: 1.6;
    margin: 0;
    flex-grow: 1;
}

@media(max-width:480px){
   
.card-content {
    padding: 15px;
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
    height: 100%;
}
.card-title {
    font-weight: 700;
    font-size: 16px;
    margin-bottom: 1rem;
    color: #1e293b;
    margin-bottom: 0px;
}
.card-text {
    font-size: 12px;
    color: #475569;
    line-height: 1.6;
    margin: 0;
    flex-grow: 1;
}

.iz-faq-toggle-icon {
    margin-left: auto;
    font-size: 14px;
    color: #000000;
    transition: transform 0.4s ease, color 0.3s;
}
}
    </style>

@section('content')

    <!-- Inner Page Breadcrumb -->
    <section class="inner_page_breadcrumb py-4 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-xl-6">
                    <div class="breadcrumb_content">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="{{ url('/') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="our-contact p-0">
        <div class="container-fluid">
            <div class="row">
                <div class="h600 w-100" id="map-canvas-dynamic">
                    {!! $branches[0]['map_url'] ?? '<div class="alert alert-info text-center py-5">No map available</div>' !!}
                </div>
            </div>
        </div>
    </section>

    <!-- Main Contact Section -->
    <section class="our-contact py-5">
        <div class="container">

            <div class="row g-4">

                <!-- Left - Info + Social + Form Card -->
                <div class="col-lg-6">

                    <!-- Get in Touch Card -->
                    <div class="card shadow-lg border-0 mb-4 h-100">
                        <div class="card-body p-4 p-md-5">
                            <h2 class="card-title mb-4">Get in touch with us today</h2>
                            <p class="text-muted mb-4">{{ $settings->address }}</p>

                            <div class="contact_icon_box mb-4">
                                <div class="d-flex mb-3">
                                    <div class="icon fs-4 me-3 text-primary"><span class="flaticon-phone-call"></span></div>
                                    <div>
                                        <h5>Monday-Friday: 08am-9pm</h5>
                                        <a href="tel:{{ $settings->tollfree_number }}" class="text-decoration-none">
                                            {{ $settings->tollfree_number }}
                                        </a>
                                    </div>
                                </div>

                                <div class="d-flex">
                                    <div class="icon fs-4 me-3 text-primary"><span class="flaticon-email"></span></div>
                                    <div>
                                        <h5>Need help with your order?</h5>
                                        <a href="mailto:{{ $settings->email }}" class="text-decoration-none">
                                            {{ $settings->email }}
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4">
                                <h5 class="mb-3">Follow us</h5>
                                <ul class="social_icon_list list-inline mb-0">
                                    <li class="list-inline-item"><a href="{{ $socialLinks->fb_name ?? '#' }}" class="text-dark fs-4"><i class="fab fa-facebook"></i></a></li>
                                    <li class="list-inline-item"><a href="{{ $socialLinks->twit_name ?? '#' }}" class="text-dark fs-4"><i class="fab fa-x-twitter"></i></a></li>
                                    <li class="list-inline-item"><a href="{{ $socialLinks->insta_name ?? '#' }}" class="text-dark fs-4"><i class="fab fa-instagram"></i></a></li>
                                    <li class="list-inline-item"><a href="{{ $socialLinks->linkedin_name ?? '#' }}" class="text-dark fs-4"><i class="fab fa-linkedin-in"></i></a></li>
                                    <li class="list-inline-item"><a href="{{ $socialLinks->youtube_name ?? '#' }}" class="text-dark fs-4"><i class="fab fa-youtube"></i></a></li>
                                    <li class="list-inline-item"><a href="https://wa.me/{{ $settings->whatsapp_number ?? '' }}" target="_blank" class="text-dark fs-4"><i class="fab fa-whatsapp"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Right - Contact Form Card -->
                <div class="col-lg-6">
                    <div class="card shadow-lg border-0 h-100">
                        <div class="card-body p-4 p-md-5">

                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <h3 class="mb-4">Send us a message</h3>

                            <form class="contact_form" method="POST" action="{{ route('contact.store') }}">
                                @csrf
                                <div class="row g-3">

                                    <div class="col-md-6">
                                        <label class="form-label">Name</label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                               value="{{ old('name') }}" placeholder="Enter your name">
                                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                               value="{{ old('email') }}" placeholder="Enter your email">
                                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Phone</label>
                                        <input type="tel" name="mobile_number" pattern="[0-9]{10}" class="form-control @error('mobile_number') is-invalid @enderror"
                                               value="{{ old('mobile_number') }}" placeholder="Enter your phone number">
                                        @error('mobile_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Message</label>
                                        <textarea name="message" rows="6" class="form-control @error('message') is-invalid @enderror"
                                                  placeholder="Write your message here...">{{ old('message') }}</textarea>
                                        @error('message') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="col-12">
                                        <button type="submit" class="btn btn-thm btn-lg w-100">Send Message</button>
                                    </div>

                                </div>
                            </form>

                        </div>
                    </div>
                </div>

            </div>

            <!-- Our Offices / Branches -->
            <div class="row mt-5 pt-5 border-top">
                <div class="col-12 text-center mb-5">
                    <h2>Come and visit one of our offices</h2>
                    <p class="text-muted">We have multiple locations ready to welcome you</p>
                </div>

                @foreach($branches as $branch)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card shadow h-100 border-0">
                            <div class="card-body p-4">
                                <h4 class="card-title mb-3">{{ $branch['name'] }}</h4>
                                <ul class="list-unstyled mb-4">
                                    <li class="mb-2"><i class="fas fa-map-marker-alt me-2 text-primary"></i>
                                        {{ $branch['address'] }}
                                    </li>
                                    <li class="mb-2"><i class="fas fa-city me-2 text-primary"></i>
                                        {{ $branch['cities']['name'] ?? '' }}, {{ $branch['states']['name'] ?? '' }}
                                    </li>
                                    <li class="mb-2"><i class="fas fa-phone me-2 text-primary"></i>
                                        <a href="tel:{{ $branch['contact_number'] }}" class="text-dark text-decoration-none">
                                            {{ $branch['contact_number'] }}
                                        </a>
                                    </li>
                                    <li><i class="fas fa-envelope me-2 text-primary"></i>
                                        <a href="mailto:{{ $branch['email'] }}" class="text-dark text-decoration-none">
                                            {{ $branch['email'] }}
                                        </a>
                                    </li>
                                </ul>

                                <a href="#" class="btn btn-outline-primary branch-map-btn w-100"
                                   data-map='{!! $branch["map_url"] !!}'>
                                    See on Map
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- FAQ Section -->
            <div class="row mt-5 pt-5 border-top">
                <div class="col-lg-8 offset-lg-2">
                    <div class="card shadow border-0">
                        <div class="card-body p-4 p-md-5">
                            <h2 class="text-center mb-4">Frequently Asked Questions</h2>

                            <div class="accordion" id="accordionExample">
                               
                                
                                <!--<div class="iz-faq-wrapper">-->
                    @foreach($faqs as $faq)
                        <div class="iz-faq-item ">
                            <button class="iz-faq-question">
                                <span class="iz-faq-question-number">{{ $loop->iteration }}</span>
                                {{ $faq->question }}
                                <i class="fas fa-chevron-down iz-faq-toggle-icon"></i>
                            </button>

                            <div class="iz-faq-answer">
                                {!! $faq->answer !!}
                            </div>
                        </div>
                       
                    @endforeach
                <!--</div>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Features Section -->
           

        </div>
    </section>
    <section class="features ptb cardsecview1" style="">
    <div class="container">
        <div class="row g-4">
            @foreach($features as $feature)
                <div class="col-6 col-sm-6 col-lg-4 col-xl-3">
                    <div class="feature-card">
                        <div class="card-content">
                            <div class="icon-wrapper">
                                <span class="{{ $feature->icon }} feature-icon"></span>
                            </div>
                            <h5 class="card-title">{{ $feature->title }}</h5>
                            <p class="card-text">{{ $feature->description }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>


    <script>
        document.querySelectorAll('.branch-map-btn').forEach(btn => {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                let map = this.dataset.map;
                document.querySelector('#map-canvas-dynamic').innerHTML = map;
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        });
    </script>
      <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.iz-faq-question').forEach(btn => {
                btn.addEventListener('click', function () {
                    const item = this.closest('.iz-faq-item');
                    const parent = item.parentElement;
                    const isActive = item.classList.contains('active');

                    // Close others in same category
                    parent.querySelectorAll('.iz-faq-item').forEach(el => {
                        if (el !== item) el.classList.remove('active');
                    });

                    // Toggle current
                    item.classList.toggle('active');
                });
            });
        });
    </script>

@endsection
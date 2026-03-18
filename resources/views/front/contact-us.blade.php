@extends('front.app')
@section('title', 'Contact Us')

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
                                @foreach($faqs as $faq)
                                    <div class="accordion-item border-0 shadow-sm mb-3">
                                        <h2 class="accordion-header" id="heading{{ $loop->index }}">
                                            <button class="accordion-button collapsed fw-bold" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapse{{ $loop->index }}"
                                                    aria-expanded="false" aria-controls="collapse{{ $loop->index }}">
                                                <span class="me-3 badge bg-primary rounded-pill">{{ $loop->iteration }}</span>
                                                {{ $faq->question }}
                                            </button>
                                        </h2>
                                        <div id="collapse{{ $loop->index }}" class="accordion-collapse collapse"
                                             aria-labelledby="heading{{ $loop->index }}" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                {{ $faq->answer }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Features Section -->
            <div class="row mt-5 pt-5 border-top g-4">
                @foreach($features as $feature)
                    <div class="col-sm-6 col-lg-3">
                        <div class="card shadow-sm border-0 text-center h-100">
                            <div class="card-body p-4">
                                <div class="icon fs-1 text-primary mb-3">
                                    <span class="{{ $feature->icon }}"></span>
                                </div>
                                <h5 class="card-title">{{ $feature->title }}</h5>
                                <p class="card-text text-muted">{{ $feature->description }}</p>
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

@endsection
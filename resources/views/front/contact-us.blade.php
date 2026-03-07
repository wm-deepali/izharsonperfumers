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

                            <li class="breadcrumb-item active" aria-current="page">
                                Contact Us
                            </li>

                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Contact -->
    <section class="our-contact p0">
        <div class="container-fluid">
            <div class="row">
                <div class="h600" id="map-canvas-dynamic">
                    {!! $branches[0]['map_url'] ?? '' !!}
                </div>
            </div>
        </div>
    </section>

    <!-- Our Contact -->
    <section class="our-contact pt55 pb30">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="contact_page_content">
                        <div class="main-title">
                            <h2 class="mtitle">Get in touch with us <br class="d-none d-md-block"> today</h2>
                            <p>{{ $settings->address }}</p>
                        </div>
                        <div class="contact_icon_box mt30">
                            <div class="contact_iconbox d-flex mb30">
                                <div class="icon"><span class="flaticon-phone-call"></span></div>
                                <div class="details ms-4">
                                    <h4 class="title">Monday-Friday: 08am-9pm</h4>
                                    <a href="#">{{ $settings->tollfree_number }}</a>
                                </div>
                            </div>
                            <div class="contact_iconbox d-flex">
                                <div class="icon"><span class="flaticon-email"></span></div>
                                <div class="details ms-4">
                                    <h4 class="title">Need help with your order?</h4>
                                    <a href="#">{{ $settings->email }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="footer_social_widget mt30 mb30-md">
                            <h4 class="title mb0">Follow us</h4>
                            <div class="social_icon_list mt10">
                                <ul class="mb20">
                                     <li class="list-inline-item"><a href="{{ $socialLinks->fb_name }}"><i
                                                    class="fab fa-facebook"></i></a>
                                        </li>
                                        <li class="list-inline-item"><a href="{{ $socialLinks->twit_name }}"><i
                                                    class="fab fa-x-twitter"></i></a>
                                        </li>
                                        <li class="list-inline-item"><a href="{{ $socialLinks->insta_name }}"><i
                                                    class="fab fa-instagram"></i></a>
                                        </li>
                                        <li class="list-inline-item"><a href="{{ $socialLinks->linkedin_name }}"><i
                                                    class="fab fa-linkedin-in"></i></a>
                                        </li>
                                        <li class="list-inline-item"><a href="{{ $socialLinks->youtube_name }}"><i
                                                    class="fab fa-youtube"></i></a>
                                        </li>
                                        <li class="list-inline-item"><a
                                                href="https://wa.me/{{ $settings->whatsapp_number }}" target="_blank"><i
                                                    class="fab fa-whatsapp"></i></a>
                                        </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form_grid">
                        <div class="wrapper">
                            @if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
                            <form class="contact_form" method="POST" action="{{ route('contact.store') }}">
    @csrf

    <div class="row">

        <div class="col-md-6">
            <div class="form-group mb-4">
                <label class="form-label">Name</label>
                       <input class="form-control @error('name') is-invalid @enderror"
       type="text"
       name="name"
       value="{{ old('name') }}"
       placeholder="Enter your name">

@error('name')
<div class="text-danger">{{ $message }}</div>
@enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group mb-4">
                <label class="form-label">Email</label>
                <input class="form-control email @error('email') is-invalid @enderror"
       type="email"
       name="email"
       value="{{ old('email') }}"
       placeholder="Enter your email">

@error('email')
<div class="text-danger">{{ $message }}</div>
@enderror
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group mb-4">
                <label class="form-label">Phone</label>
               <input class="form-control @error('mobile_number') is-invalid @enderror"
       type="tel"
       name="mobile_number"
       value="{{ old('mobile_number') }}"
       placeholder="Enter your phone number"
       pattern="[0-9]{10}">

@error('mobile_number')
<div class="text-danger">{{ $message }}</div>
@enderror
            </div>
        </div>

        <div class="col-sm-12">
            <div class="form-group mb-4">
                <label class="form-label">Message</label>
                <textarea name="message"
          class="form-control @error('message') is-invalid @enderror"
          rows="8"
          placeholder="Write your message here">{{ old('message') }}</textarea>

@error('message')
<div class="text-danger">{{ $message }}</div>
@enderror
            </div>

            <div class="form-group mb0">
                <button type="submit" class="btn btn-thm">
                    Send Message
                </button>
            </div>
        </div>

    </div>
</form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt60 pt55 bdrt1">
                <div class="col-lg-6">
                    <div class="main-title">
                        <h2 class="mtitle">Come and visit one of our offices <br class="d-none d-md-block"> around the world
                        </h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit ut aliquam <br class="d-none d-md-block">
                            purus sit amet luctus venenatis lectus.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row">
                        @foreach($branches as $branch)
                            <div class="col-md-6">
                                <div class="location_lists">
                                    <div class="wrapper">

                                        <h4 class="title">{{ $branch['name'] }}</h4>

                                        <ul>
                                            <li>
                                                <a href="#">
                                                    {{ $branch['address'] }}
                                                </a>
                                            </li>

                                            <li>
                                                <a href="#">
                                                    {{ $branch['cities']['name'] ?? '' }},
                                                    {{ $branch['states']['name'] ?? '' }}
                                                </a>
                                            </li>

                                            <li>
                                                <a href="tel:{{ $branch['contact_number'] }}">
                                                    {{ $branch['contact_number'] }}
                                                </a>
                                            </li>

                                            <li>
                                                <a href="mailto:{{ $branch['email'] }}">
                                                    {{ $branch['email'] }}
                                                </a>
                                            </li>
                                        </ul>

                                        <a href="#" class="locate_map_btn branch-map-btn" data-map='{!! $branch["map_url"] !!}'>
                                            See Map
                                        </a>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row mt20 pt55 bdrt1">
                <div class="col-lg-6 offset-lg-3">
                    <div class="main-title text-center">
                        <h2>Frequently Asked Questions</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="shortcode_widget_accprdons mb0">
                        <div class="faq_according text-start">
                            <div class="accordion" id="accordionExample">
                               @foreach($faqs as $faq)
<div class="card">
    <div class="card-header" id="heading{{ $loop->index }}">
        <h2 class="mb-0">
            <button class="btn btn-link text-start collapsed"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#collapse{{ $loop->index }}"
                aria-expanded="false"
                aria-controls="collapse{{ $loop->index }}">

                <span>{{ $loop->iteration }}</span> {{ $faq->question }}

            </button>
        </h2>
    </div>

    <div id="collapse{{ $loop->index }}"
        class="collapse"
        aria-labelledby="heading{{ $loop->index }}"
        data-bs-parent="#accordionExample">

        <div class="card-body">
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
            <div class="row pt55 bdrt1">
                @foreach($features as $feature)
                    <div class="col-sm-6 col-xl-3">
                        <div class="icon_boxes">
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
    </section>

    <script>

        document.querySelectorAll('.branch-map-btn').forEach(btn => {

            btn.addEventListener('click', function (e) {

                e.preventDefault();

                let map = this.dataset.map;

                document.querySelector('#map-canvas-dynamic').innerHTML = map;

                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });

            });

        });

    </script>

@endsection
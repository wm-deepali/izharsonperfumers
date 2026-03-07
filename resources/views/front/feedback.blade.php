@extends('front.app')

@section('title', 'Feedback')

@section('content')

    <!-- Breadcrumb -->
    <section class="inner_page_breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-xl-6">
                    <div class="breadcrumb_content">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ url('/') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">
                                Feedback
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Contact / Feedback -->
    <section class="our-contact pt55 pb30">
        <div class="container">

            <div class="row">
                <!-- FEEDBACK FORM -->
                <div class="col-lg-12">

                    <div class="form_grid">
                        <div class="wrapper">

                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <form class="contact_form" method="POST" action="{{ route('feedback.store') }}"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="row">

                                    <!-- FIRST NAME -->
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">

                                            <label class="form-label">First Name</label>

                                            <input class="form-control @error('first_name') is-invalid @enderror"
                                                type="text" name="first_name" value="{{ old('first_name') }}"
                                                placeholder="First Name">

                                            @error('first_name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror

                                        </div>
                                    </div>


                                    <!-- LAST NAME -->
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">

                                            <label class="form-label">Last Name</label>

                                            <input class="form-control @error('last_name') is-invalid @enderror" type="text"
                                                name="last_name" value="{{ old('last_name') }}" placeholder="Last Name">

                                            @error('last_name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror

                                        </div>
                                    </div>


                                    <!-- EMAIL -->
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">

                                            <label class="form-label">Email</label>

                                            <input class="form-control @error('email') is-invalid @enderror" type="email"
                                                name="email" value="{{ old('email') }}" placeholder="Email">

                                            @error('email')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror

                                        </div>
                                    </div>


                                    <!-- PHONE -->
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">

                                            <label class="form-label">Phone</label>

                                            <input class="form-control @error('mobile_number') is-invalid @enderror"
                                                type="tel" name="mobile_number" value="{{ old('mobile_number') }}"
                                                placeholder="Phone">

                                            @error('mobile_number')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror

                                        </div>
                                    </div>


                                    <!-- RATING -->
                                    <div class="col-md-12">
                                        <div class="form-group mb-4">

                                            <label class="form-label">Rating</label>

                                            <div class="rating-stars">

                                                <i class="fas fa-star star" data-value="1"></i>
                                                <i class="fas fa-star star" data-value="2"></i>
                                                <i class="fas fa-star star" data-value="3"></i>
                                                <i class="fas fa-star star" data-value="4"></i>
                                                <i class="fas fa-star star" data-value="5"></i>

                                            </div>

                                            <input type="hidden" name="rating" id="rating-value">

                                        </div>
                                    </div>


                                    <!-- IMAGE -->
                                    <div class="col-md-12">
                                        <div class="form-group mb-4">

                                            <label class="form-label">Upload Image</label>

                                            <input type="file" class="form-control" name="image" style="height: inherit;">

                                        </div>
                                    </div>


                                    <!-- MESSAGE -->
                                    <div class="col-md-12">
                                        <div class="form-group mb-4">

                                            <label class="form-label">Message</label>

                                            <textarea name="message" class="form-control" rows="6"
                                                placeholder="Write your feedback">{{ old('message') }}</textarea>

                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-thm">
                                            Submit Feedback
                                        </button>
                                    </div>

                                </div>
                            </form>

                        </div>
                    </div>

                </div>

            </div>

        </div>
    </section>

    <script>

        const stars = document.querySelectorAll('.star')
        const ratingInput = document.getElementById('rating-value')

        stars.forEach(star => {
            star.addEventListener('click', function () {

                let rating = this.dataset.value

                ratingInput.value = rating

                stars.forEach(s => s.classList.remove('active'))

                for (let i = 0; i < rating; i++) {
                    stars[i].classList.add('active')
                }

            })
        })

    </script>

@endsection
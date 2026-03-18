@extends('front.app')
@section('title', 'Feedback')

@section('content')

    <!-- Breadcrumb -->
    <section class="inner_page_breadcrumb py-4 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-xl-6">
                    <div class="breadcrumb_content">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="{{ url('/') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Feedback</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Feedback Section -->
    <section class="feedback-section py-5 bg-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-xl-7">

                    <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                        <div class="card-header bg-thm text-white text-center py-4">
                            <h2 class="mb-0">We Value Your Feedback</h2>
                            <p class="mb-0 mt-2 opacity-75">Help us improve by sharing your thoughts</p>
                        </div>

                        <div class="card-body p-4 p-md-5">
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <form class="contact_form" method="POST" action="{{ route('feedback.store') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="row g-4">

                                    <!-- First Name + Last Name -->
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">First Name <span class="text-danger">*</span></label>
                                        <input type="text" name="first_name" class="form-control form-control-lg @error('first_name') is-invalid @enderror"
                                               value="{{ old('first_name') }}" placeholder="Enter your first name" required>
                                        @error('first_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Last Name</label>
                                        <input type="text" name="last_name" class="form-control form-control-lg @error('last_name') is-invalid @enderror"
                                               value="{{ old('last_name') }}" placeholder="Enter your last name">
                                        @error('last_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Email + Phone -->
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Email <span class="text-danger">*</span></label>
                                        <input type="email" name="email" class="form-control form-control-lg @error('email') is-invalid @enderror"
                                               value="{{ old('email') }}" placeholder="your.email@example.com" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Phone</label>
                                        <input type="tel" name="mobile_number" pattern="[0-9]{10}" class="form-control form-control-lg @error('mobile_number') is-invalid @enderror"
                                               value="{{ old('mobile_number') }}" placeholder="Enter 10-digit number">
                                        @error('mobile_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Rating -->
                                    <div class="col-12">
                                        <label class="form-label fw-bold d-block">How would you rate your experience? <span class="text-danger">*</span></label>
                                        <div class="rating-stars d-flex justify-content-center gap-2 my-3">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star fs-1 star {{ old('rating') >= $i ? 'active text-warning' : 'text-muted' }}"
                                                   data-value="{{ $i }}" role="button" tabindex="0"></i>
                                            @endfor
                                        </div>
                                        <input type="hidden" name="rating" id="rating-value" value="{{ old('rating') }}" required>
                                        @error('rating')
                                            <div class="text-danger text-center">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Image Upload -->
                                    <div class="col-12">
                                        <label class="form-label fw-bold">Upload Screenshot / Image (optional)</label>
                                        <div class="input-group input-group-lg">
                                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"
                                                   accept="image/*">
                                            @error('image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <small class="form-text text-muted">Max 5MB - JPG, PNG</small>
                                    </div>

                                    <!-- Message -->
                                    <div class="col-12">
                                        <label class="form-label fw-bold">Your Feedback <span class="text-danger">*</span></label>
                                        <textarea name="message" class="form-control form-control-lg @error('message') is-invalid @enderror"
                                                  rows="6" placeholder="Tell us what you think..." required>{{ old('message') }}</textarea>
                                        @error('message')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Submit -->
                                    <div class="col-12 text-center mt-4">
                                        <button type="submit" class="btn btn-thm btn-lg px-5 py-3">
                                            <i class="fas fa-paper-plane me-2"></i> Submit Feedback
                                        </button>
                                    </div>

                                </div>
                            </form>
                        </div>

                        <div class="card-footer bg-light text-center py-4 border-0">
                            <small class="text-muted">Thank you for helping us serve you better!</small>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <style>
        .rating-stars .star {
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .rating-stars .star:hover,
        .rating-stars .star.active {
            transform: scale(1.2);
            color: #ffc107 !important;
        }
        .bg-thm {
            background: #f9f9f9 !important; 
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const stars = document.querySelectorAll('.star');
            const ratingInput = document.getElementById('rating-value');

            function setRating(value) {
                ratingInput.value = value;
                stars.forEach(star => {
                    star.classList.toggle('active', star.dataset.value <= value);
                    star.classList.toggle('text-warning', star.dataset.value <= value);
                    star.classList.toggle('text-muted', star.dataset.value > value);
                });
            }

            stars.forEach(star => {
                star.addEventListener('click', () => {
                    setRating(star.dataset.value);
                });

                // Optional: keyboard accessibility
                star.addEventListener('keydown', e => {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        setRating(star.dataset.value);
                    }
                });
            });

            // Set initial rating from old input (after validation fail)
            const initial = ratingInput.value;
            if (initial) setRating(initial);
        });
    </script>

@endsection
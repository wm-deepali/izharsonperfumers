@extends('front.app')

@section('title', 'Create Account')

@section('content')
    <section class="our-log-reg bgc-f5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-xl-5 col-xxl-4 m-auto">
                    <div class="log_reg_form mt70-992">

                        <h2 class="title">Create your account</h2>

                        {{-- Success Message --}}
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        {{-- Validation Errors --}}
                        @if($errors->any())
                            <div class="alert alert-danger">{{ $errors->first() }}</div>
                        @endif

                        <div class="sign_up_form">
                            <form method="POST" action="{{ route('customer.register') }}">
                                @csrf

                                <div class="form-group">
                                    <label class="form-label">Your Name</label>
                                    <input type="text" name="name" value="{{ old('name') }}" class="form-control"
                                        placeholder="Ali Tufan" required>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Your Email</label>
                                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                                        class="form-control" placeholder="example@email.com" required>
                                    <small id="email-error" class="text-danger"></small>

                                </div>

                                <div class="form-group">
                                    <label class="form-label">Contact Number</label>
                                    <input id="mobile_number" type="text" name="mobile_number"
                                        value="{{ old('mobile_number') }}" class="form-control"
                                        placeholder="Enter mobile number" required>
                                    <small id="mobile-error" class="text-danger"></small>
                                </div>

                                <div class="form-group mb20">
                                    <label class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control"
                                        placeholder="******************" required>
                                </div>

                                <div class="form-group mb20">
                                    <label class="form-label">Confirm Password</label>
                                    <input type="password" name="password_confirmation" class="form-control"
                                        placeholder="******************" required>
                                </div>

                                <div class="form-group mb20">
                                    <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
                                </div>

                                <button type="submit" class="btn btn-signup btn-thm">
                                    Create Account
                                </button>

                                <p class="text-center mb25 mt10">
                                    Already have an account?
                                    <a href="{{ route('customer.login') }}">Sign in</a>
                                </p>

                                <div class="hr_content">
                                    <hr>
                                    <span class="hr_top_text">or</span>
                                </div>

                                <ul class="login_with_social text-center mt30 mb0">
                                    <li class="list-inline-item"><a href="#"><i class="fab fa-facebook"></i></a></li>
                                    <li class="list-inline-item">
                                        <a href="{{ route('customer.google.login') }}">
                                            <i class="fab fa-google"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item"><a href="#"><i class="fab fa-x-twitter"></i></a></li>
                                    <li class="list-inline-item"><a href="#"><i class="fab fa-apple"></i></a></li>
                                </ul>

                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script>
$(document).ready(function () {

    let typingTimer;
    let delay = 500; // 0.5 sec wait
    let lastEmail = '';
    let lastMobile = '';

    $('#email, #mobile_number').on('keyup', function () {

        clearTimeout(typingTimer);

        typingTimer = setTimeout(function () {

            let email = $('#email').val();
            let mobile = $('#mobile_number').val();

            // same value pe request mat bhejo
            if (email === lastEmail && mobile === lastMobile) {
                return;
            }

            lastEmail = email;
            lastMobile = mobile;

            $.ajax({
                url: "{{ route('check.user.exists') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    email: email,
                    mobile_number: mobile
                },
                success: function (res) {

                    // Email check
                    if (res.email) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Email Already Exists',
                            text: 'Please use a different email',
                        });
                    }

                    // Mobile check
                    if (res.mobile) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Mobile Already Exists',
                            text: 'Please use a different number',
                        });
                    }
                }
            });

        }, delay);

    });

});
</script>
@endsection
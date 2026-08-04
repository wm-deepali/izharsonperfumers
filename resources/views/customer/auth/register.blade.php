@extends('front.app')

@section('title', 'Create Account')

@section('content')
    <section class="our-log-reg bgc-f5 p-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-xl-5 col-xxl-4 m-auto">
                    <div class="log_reg_form ">

                        <h2 class="title">Create your account</h2>

                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger">{{ $errors->first() }}</div>
                        @endif

                        <div class="sign_up_form">
                            <form method="POST" action="{{ route('customer.register') }}">
                                @csrf

                                <div class="form-group">
                                    <label class="form-label">Your Name</label>
                                    <input type="text" name="name" value="{{ old('name') }}" class="form-control"
                                        placeholder="Enter your name" required>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Your Email</label>
                                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                                        class="form-control" placeholder="example@email.com" required>
                                    <small id="email-error" class="text-danger"></small>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Mobile Number</label>
                                    <div class="d-flex gap-2">
                                        <select name="country_code" id="country_code" class="form-control"
                                            style="max-width:130px;">
                                            @foreach(config('country_codes') as $c)
                                                <option value="{{ $c['dial_code'] }}" {{ old('country_code', '+91') == $c['dial_code'] ? 'selected' : '' }}>
                                                    {{ $c['dial_code'] }} ({{ $c['iso'] }})
                                                </option>
                                            @endforeach
                                        </select>
                                        <input id="mobile_number" type="text" name="mobile_number"
                                            value="{{ old('mobile_number') }}" class="form-control"
                                            placeholder="Enter mobile number" required>
                                    </div>
                                    <small id="mobile-error" class="text-danger"></small>
                                </div>

                                <div class="form-group mb20">
                                    <label class="form-label">Password</label>
                                    <div style="position:relative;">
                                        <input type="password" name="password" id="password" class="form-control"
                                            placeholder="******************" required style="padding-right:40px;">
                                        <span class="toggle-password" data-target="password"
                                            style="position:absolute; right:12px; top:50%; transform:translateY(-50%); cursor:pointer; color:#888;">
                                            <svg class="icon-eye" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                <circle cx="12" cy="12" r="3"></circle>
                                            </svg>
                                            <svg class="icon-eye-off" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" style="display:none;">
                                                <path
                                                    d="M17.94 17.94A10.94 10.94 0 0 1 12 20c-7 0-11-8-11-8a18.5 18.5 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24">
                                                </path>
                                                <line x1="1" y1="1" x2="23" y2="23"></line>
                                            </svg>
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group mb20">
                                    <label class="form-label">Confirm Password</label>
                                    <div style="position:relative;">
                                        <input type="password" name="password_confirmation" id="password_confirmation"
                                            class="form-control" placeholder="******************" required
                                            style="padding-right:40px;">
                                        <span class="toggle-password" data-target="password_confirmation"
                                            style="position:absolute; right:12px; top:50%; transform:translateY(-50%); cursor:pointer; color:#888;">
                                            <svg class="icon-eye" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                <circle cx="12" cy="12" r="3"></circle>
                                            </svg>
                                            <svg class="icon-eye-off" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" style="display:none;">
                                                <path
                                                    d="M17.94 17.94A10.94 10.94 0 0 1 12 20c-7 0-11-8-11-8a18.5 18.5 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24">
                                                </path>
                                                <line x1="1" y1="1" x2="23" y2="23"></line>
                                            </svg>
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group mb20">
                                    <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
                                </div>

                                <div class="custom-control custom-checkbox mt-4">
                                    <input type="checkbox" name="remember" class="custom-control-input" id="exampleCheck3">
                                    <label class="custom-control-label" for="exampleCheck3">I agree to the Terms &
                                        Conditions</label>
                                </div>

                                <button type="submit" class="btn btn-signup btn-thm">
                                    Create Account
                                </button>

                                <div class="text-center my-3" style="position:relative;">
                                    <hr>
                                    <span
                                        style="position:absolute; top:-10px; left:50%; transform:translateX(-50%); background:#fff; padding:0 10px; color:#888; font-size:13px;">
                                        OR
                                    </span>
                                </div>

                                <a href="{{ route('customer.google.login') }}"
                                    class="btn btn-outline-dark w-100 d-flex align-items-center justify-content-center gap-2"
                                    style="border-top: 1px solid #212529 !important;">
                                    <svg width="20" height="20" viewBox="0 0 100 100" style="flex-shrink:0;">
                                        <path fill="#4285F4"
                                            d="M99.96 51.02c0-3.6-.32-7.06-.92-10.4H51v19.68h27.5c-1.18 6.4-4.78 11.82-10.2 15.44v12.82h16.5C94.06 79.9 99.96 66.7 99.96 51.02z" />
                                        <path fill="#34A853"
                                            d="M51 101c13.78 0 25.32-4.56 33.76-12.44l-16.5-12.82c-4.58 3.06-10.44 4.88-17.26 4.88-13.28 0-24.52-8.96-28.54-21H5.44v13.22C13.84 89.7 31.02 101 51 101z" />
                                        <path fill="#FBBC05"
                                            d="M22.46 59.62A30.6 30.6 0 0 1 20.8 50c0-3.34.58-6.58 1.66-9.62V27.16H5.44A50.4 50.4 0 0 0 0 50c0 8.1 1.94 15.76 5.44 22.84l17.02-13.22z" />
                                        <path fill="#EA4335"
                                            d="M51 19.4c7.5 0 14.24 2.58 19.54 7.64l14.66-14.66C76.3 4.5 64.76 0 51 0 31.02 0 13.84 11.3 5.44 27.16l17.02 13.22c4.02-12.04 15.26-21 28.54-21z" />
                                    </svg>
                                    Sign up with Google
                                </a>

                                <p class="text-center mb25 mt10">
                                    Already have an account?
                                    <a href="{{ route('customer.login') }}" style="color:blue;">Sign in</a>
                                </p>
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
            let delay = 500;
            let lastEmail = '';
            let lastMobile = '';

            $('#email, #mobile_number').on('keyup', function () {

                clearTimeout(typingTimer);

                typingTimer = setTimeout(function () {

                    let email = $('#email').val();
                    let mobile = $('#mobile_number').val();

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
                            if (res.email) {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Email Already Exists',
                                    text: 'Please use a different email',
                                });
                            }
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

            $('.toggle-password').on('click', function () {
                const targetId = $(this).data('target');
                const input = $('#' + targetId);
                const eyeIcon = $(this).find('.icon-eye');
                const eyeOffIcon = $(this).find('.icon-eye-off');

                if (input.attr('type') === 'password') {
                    input.attr('type', 'text');
                    eyeIcon.hide();
                    eyeOffIcon.show();
                } else {
                    input.attr('type', 'password');
                    eyeIcon.show();
                    eyeOffIcon.hide();
                }
            });

        });
    </script>
@endsection
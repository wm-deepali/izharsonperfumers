@extends('front.app')

@section('title', 'Sign In / Sign Up')

@section('content')
    <section class="our-log-reg bgc-f5 p-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-xl-5 col-xxl-4 m-auto">
                    <div class="log_reg_form">
                        <h2 class="title">Sign In / Sign Up</h2>

                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger">{{ $errors->first() }}</div>
                        @endif

                        <form method="POST" id="auth-form" action="{{ route('customer.login') }}">
                            @csrf

                            <div class="mb-2 mr-sm-2">
                                <label class="form-label">Mobile Number or Email</label>
                                <input type="text" id="login_id" name="login_id" value="{{ old('login_id') }}"
                                    class="form-control" placeholder="Enter mobile number or email" required autocomplete="off">
                                <small id="login-id-note" class="text-muted d-block mt-1"></small>
                            </div>

                            {{-- Existing email account only --}}
                            <div class="form-group mb-2 mr-sm-2" id="password-group" style="display:none;">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control m-0" placeholder="Password">
                            </div>

                            <div class="custom-control custom-checkbox" id="remember-group" style="display:none;">
                                <input type="checkbox" name="remember" class="custom-control-input" id="rememberMe">
                                <label class="custom-control-label" for="rememberMe">Remember me</label>
                                <a class="btn-fpswd float-end" href="{{ route('customer.password.request') }}">
                                    Lost your password?
                                </a>
                            </div>

                            <button type="submit" id="password-submit-btn" class="btn btn-log btn-thm mt10" style="display:none;">Login</button>
                            <button type="button" id="otp-request-btn" class="btn btn-log btn-thm mt10" style="display:none;">Send OTP</button>

                            <div class="text-center my-3" style="position:relative;">
                                <hr>
                                <span style="position:absolute; top:-10px; left:50%; transform:translateX(-50%); background:#fff; padding:0 10px; color:#888; font-size:13px;">
                                    OR
                                </span>
                            </div>

                            <a href="{{ route('customer.google.login') }}{{ request('redirect') ? '?redirect=' . urlencode(request('redirect')) : '' }}"
                               class="btn btn-outline-dark w-100 d-flex align-items-center justify-content-center gap-2"
                               style="border-top: 1px solid #212529 !important;">
                                <svg width="20" height="20" viewBox="0 0 100 100" style="flex-shrink:0;">
                                    <path fill="#4285F4" d="M99.96 51.02c0-3.6-.32-7.06-.92-10.4H51v19.68h27.5c-1.18 6.4-4.78 11.82-10.2 15.44v12.82h16.5C94.06 79.9 99.96 66.7 99.96 51.02z"/>
                                    <path fill="#34A853" d="M51 101c13.78 0 25.32-4.56 33.76-12.44l-16.5-12.82c-4.58 3.06-10.44 4.88-17.26 4.88-13.28 0-24.52-8.96-28.54-21H5.44v13.22C13.84 89.7 31.02 101 51 101z"/>
                                    <path fill="#FBBC05" d="M22.46 59.62A30.6 30.6 0 0 1 20.8 50c0-3.34.58-6.58 1.66-9.62V27.16H5.44A50.4 50.4 0 0 0 0 50c0 8.1 1.94 15.76 5.44 22.84l17.02-13.22z"/>
                                    <path fill="#EA4335" d="M51 19.4c7.5 0 14.24 2.58 19.54 7.64l14.66-14.66C76.3 4.5 64.76 0 51 0 31.02 0 13.84 11.3 5.44 27.16l17.02 13.22c4.02-12.04 15.26-21 28.54-21z"/>
                                </svg>
                                Continue with Google
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function () {

        let typingTimer;
        const delay = 500;

        function setMode(mode, value) {
            $('#password-group, #password-submit-btn, #otp-request-btn, #remember-group').hide();
            $('input[name="password"]').prop('required', false);
            $('#login-id-note').text('');

            if (mode === 'otp') {
                $('#otp-request-btn').show();
                const isMobile = /^[0-9]{10}$/.test(value);
                $('#login-id-note').text(isMobile
                    ? 'We will send an OTP to this mobile number.'
                    : "We will send a verification code to this email — it'll create your account.");
            } else if (mode === 'password') {
                $('#password-group, #remember-group, #password-submit-btn').show();
                $('input[name="password"]').prop('required', true);
            } else if (mode === 'invalid') {
                $('#login-id-note').text('Enter a valid 10-digit mobile number or email.');
            }
        }

        $('#login_id').on('keyup', function () {
            clearTimeout(typingTimer);
            const value = $(this).val().trim();

            if (!value) { setMode('initial', ''); return; }

            typingTimer = setTimeout(function () {
                $.ajax({
                    url: "{{ route('customer.login.check-type') }}",
                    method: "POST",
                    data: { _token: "{{ csrf_token() }}", login_id: value },
                    success: function (res) { setMode(res.mode, value); }
                });
            }, delay);
        });

        $('#otp-request-btn').on('click', function () {
            const value = $('#login_id').val().trim();
            if (!value) return;

            $.ajax({
                url: "{{ route('customer.login.request-otp') }}",
                method: "POST",
                data: { _token: "{{ csrf_token() }}", login_id: value },
                success: function () {
                    window.location.href = "{{ route('customer.login.verify-otp') }}";
                },
                error: function (xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Could not send OTP',
                        text: xhr.responseJSON?.message || 'Please try again.'
                    });
                }
            });
        });

    });
    </script>
@endsection
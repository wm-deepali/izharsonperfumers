@extends('front.app')

@section('title', 'Verify OTP')

@section('content')
    <section class="our-log-reg bgc-f5 p-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-xl-5 col-xxl-4 m-auto">
                    <div class="log_reg_form">
                        <h2 class="title">Verify OTP</h2>
                        <p class="text-muted">We've sent a 6-digit code to your mobile number.</p>

                        @if($errors->any())
                            <div class="alert alert-danger">{{ $errors->first() }}</div>
                        @endif

                        <form method="POST" action="{{ $purpose === 'register' ? route('customer.register.verify-otp.submit') : route('customer.login.verify-otp.submit') }}">
                            @csrf
                            <div class="form-group mb20">
                                <label class="form-label">Enter OTP</label>
                                <input type="text" name="otp" class="form-control" maxlength="6" placeholder="6-digit code" required autofocus>
                            </div>
                            <button type="submit" class="btn btn-log btn-thm mt10 w-100">Verify</button>
                        </form>

                        <p class="text-center mt10">
                            Didn't get the code?
                            <a href="#" id="resend-otp-link">Resend OTP</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
$(document).ready(function () {
    $('#resend-otp-link').on('click', function (e) {
        e.preventDefault();
        const url = "{{ $purpose === 'register' ? route('customer.register.resend-otp') : route('customer.login.resend-otp') }}";

        $.ajax({
            url: url,
            method: "POST",
            data: { _token: "{{ csrf_token() }}" },
            success: function (res) {
                Swal.fire({ icon: 'success', title: 'OTP Resent', text: res.message });
            },
            error: function () {
                Swal.fire({ icon: 'error', title: 'Failed', text: 'Please try again.' });
            }
        });
    });
});
</script>
@endsection
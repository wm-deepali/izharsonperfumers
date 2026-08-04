@extends('front.app')

@section('title', 'Verify OTP')

@section('content')
    <section class="our-log-reg bgc-f5 p-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-xl-5 col-xxl-4 m-auto">
                    <div class="log_reg_form">
                        <h2 class="title">Verify OTP</h2>

                        @if($errors->any())
                            <div class="alert alert-danger">{{ $errors->first() }}</div>
                        @endif

                        <p class="text-muted">
                            Enter the 6-digit OTP sent to your {{ $isEmail ? 'email' : 'mobile number' }}
                            @if($maskedIdentifier)
                                <strong>({{ $maskedIdentifier }})</strong>
                            @endif
                        </p>

                        <form method="POST" action="{{ route('customer.login.verify-otp') }}">
                            @csrf
                            <div class="form-group mb20">
                                <label class="form-label">OTP</label>
                                <input type="text" name="otp" class="form-control" maxlength="6"
                                    placeholder="Enter 6-digit OTP" required autofocus>
                            </div>
                            <button type="submit" class="btn btn-log btn-thm mt10 w-100">Verify</button>
                        </form>

                        <p class="text-center mt-3">
                            Didn't get the code?
                            <a href="javascript:void(0);" id="resend-otp-btn" style="color:blue;">Resend OTP</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function () {
        $('#resend-otp-btn').on('click', function () {
            $.ajax({
                url: "{{ route('customer.login.resend-otp') }}",
                method: "POST",
                data: { _token: "{{ csrf_token() }}" },
                success: function (res) {
                    Swal.fire({ icon: 'success', title: res.message || 'OTP resent.' });
                },
                error: function (xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Could not resend',
                        text: xhr.responseJSON?.message || 'Please try again.'
                    });
                }
            });
        });
    });
    </script>
@endsection
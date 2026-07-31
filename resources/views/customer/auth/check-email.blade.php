@extends('front.app')

@section('title', 'Verify Your Email')

@section('content')
    <section class="our-log-reg bgc-f5 p-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-xl-5 col-xxl-4 m-auto">
                    <div class="log_reg_form text-center">
                        <h2 class="title">Check your email</h2>
                        <p class="text-muted">
                            We've sent a verification link to your email address. Click the link to activate your account.
                        </p>
                        <p class="text-center mt10">
                            <a href="{{ route('customer.login') }}" style="color:blue;">Back to Sign in</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
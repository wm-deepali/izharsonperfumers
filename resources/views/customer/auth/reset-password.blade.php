@extends('front.app')

@section('title', 'Reset Password')

@section('content')
<section class="our-log-reg bgc-f5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 m-auto">
                <div class="log_reg_form">

                    <h2 class="title">Reset Password</h2>

                    @if($errors->any())
                        <div class="alert alert-danger">{{ $errors->first() }}</div>
                    @endif

                    <form method="POST" action="{{ route('customer.password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group mb-2">
                            <label>New Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <div class="form-group mb-3">
                            <label>Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>

                        <button class="btn btn-log btn-thm">Reset Password</button>

                    </form>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection
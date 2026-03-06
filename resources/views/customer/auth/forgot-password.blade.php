@extends('front.app')

@section('title', 'Forgot Password')

@section('content')
<section class="our-log-reg bgc-f5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 m-auto">
                <div class="log_reg_form">

                    <h2 class="title">Forgot Password</h2>

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">{{ $errors->first() }}</div>
                    @endif

                    <form method="POST" action="{{ route('customer.password.email') }}">
                        @csrf

                        <div class="form-group mb-3">
                            <label>Email Address</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <button class="btn btn-log btn-thm">Send Reset Link</button>

                    </form>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection
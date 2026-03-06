@extends('front.app')

@section('title', 'Page Vendor List')

@section('content')

    <section class="our-log-reg bgc-f5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-xl-5 col-xxl-4 m-auto">
                    <div class="log_reg_form mt70-992">
                        <h2 class="title">Sign-In</h2>

                        {{-- Success message --}}
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        {{-- Error message --}}
                        @if($errors->any())
                            <div class="alert alert-danger">{{ $errors->first() }}</div>
                        @endif

                        <div class="login_form">
                            <form method="POST" action="{{ route('customer.login') }}">
                                @csrf

                                <div class="mb-2 mr-sm-2">
                                    <label class="form-label">Username or email address</label>
                                    <input type="text" name="email" value="{{ old('email') }}" class="form-control"
                                        placeholder="Ali Tufan" required>
                                </div>

                                <div class="form-group mb5">
                                    <label class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Password"
                                        required>
                                </div>

                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="remember" class="custom-control-input" id="exampleCheck3">
                                    <label class="custom-control-label" for="exampleCheck3">Remember me</label>
                                    <a class="btn-fpswd float-end" href="{{ route('customer.password.request') }}">
                                        Lost your password?
                                    </a>
                                </div>

                                <button type="submit" class="btn btn-log btn-thm mt20">Login</button>

                                <p class="text-center mb25 mt10">
                                    Don't have an account?
                                    <a href="{{ route('customer.register') }}">Create account</a>
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

@endsection
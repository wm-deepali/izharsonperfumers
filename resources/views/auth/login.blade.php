<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
     <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/login_css.css') }}">
     <style>
       .fa.fa-fw.field_icon.toggle-password.fa-eye {
    float: right;
    margin-top: -29px;
    margin-right: 25px;
}
.fa.fa-fw.field_icon.toggle-password.fa-eye-slash {
    float: right;
    margin-top: -29px;
    margin-right: 25px;
}
.btn-login:focus {
  box-shadow: 0 0.5em 0.5em -0.4em var(--hover);
  transform: translateY(-0.25em);
}
.btn-login:hover {
  box-shadow: 0 0.5em 0.5em -0.4em var(--hover);
  transform: translateY(-0.25em);
}
   </style>
  </head>
  <body>
    <section class="ftco-section">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-12 col-lg-10">
            <div class="wrap d-md-flex">
              <div class="img d-flex justify-content-around align-items-center" style="background:#cd3f42">
                  @php use App\Models\User; $user=User::first();  @endphp
                  <img style="height:150px;width:350px" src="{{ URL::asset('storage/' . $user->image_login_page) }}" style="width:200px" class="img-fluid"/>
              </div>
              <div class="login-wrap p-4 p-md-5">
                  <div class="w-100">
                    <h3 class="mb-4">Admin Login</h3>
                  </div>
                   @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                <form method="POST" action="{{ route('login') }}" class="signin-form">
                    @csrf
                  <div class="form-group mb-3">
                    <label class="label" for="name">{{ __('Email Address') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
                        @error('email')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                  </div>
                  <div class="form-group mb-3">
                    <label class="label" for="password">{{ __('Password') }}</label>
                    <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    autocomplete="current-password">
                                    <span toggle="#password-field" class="fa fa-fw fa-eye field_icon toggle-password"></span>
                                @error('password')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                  </div>
                  <div class="form-group">
                    <button type="submit" class="form-control btn btn-primary rounded submit px-3 btn-login">{{ __('Login') }}</button>
                  </div>
                  <div class="form-group d-md-flex">
                    <div class="w-50 text-left">
                      <label class="checkbox-wrap checkbox-primary mb-0"> {{ __('Remember Me') }}
                      <input type="checkbox"  name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}/>
                        <span class="checkmark"></span>
                      </label>
                    </div>
                    
                     @if (Route::has('password.request'))
                    <div class="w-50 text-md-right">
                      <a href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                    </div>
                     @endif
                  </div>
                </form>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </body>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
   <script>
      $(".toggle-password").click(function() {
    $(this).toggleClass("fa-eye fa-eye-slash");
    input = $(this).parent().find("input");
    if (input.attr("type") == "password") {
        input.attr("type", "text");
    } else {
        input.attr("type", "password");
    }
});
  </script>
  </html>
<!--<div class="container">-->
<!--    <div class="row justify-content-center">-->
<!--        <div class="col-md-8">-->
<!--            <div class="card">-->
<!--                <div class="card-header">{{ __('Login') }}</div>-->
<!--                <div class="card-body">-->
<!--                @if (session('error'))-->
<!--                        <div class="alert alert-danger" role="alert">-->
<!--                            {{ session('error') }}-->
<!--                        </div>-->
<!--                    @endif-->
<!--                    <form method="POST" action="{{ route('login') }}">-->
<!--                        @csrf-->
<!--                        <div class="row mb-3">-->
<!--                            <label for="email"-->
<!--                                class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>-->
<!--                            <div class="col-md-6">-->
<!--                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"-->
<!--                                    name="email" value="{{ old('email') }}" autocomplete="email" autofocus>-->
<!--                                @error('email')-->
<!--                                <span class="invalid-feedback" role="alert">-->
<!--                                    <strong>{{ $message }}</strong>-->
<!--                                </span>-->
<!--                                @enderror-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="row mb-3">-->
<!--                            <label for="password"-->
<!--                                class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>-->
<!--                            <div class="col-md-6">-->
<!--                                <input id="password" type="password"-->
<!--                                    class="form-control @error('password') is-invalid @enderror" name="password"-->
<!--                                    autocomplete="current-password">-->
<!--                                @error('password')-->
<!--                                <span class="invalid-feedback" role="alert">-->
<!--                                    <strong>{{ $message }}</strong>-->
<!--                                </span>-->
<!--                                @enderror-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="row mb-3">-->
<!--                            <div class="col-md-6 offset-md-4">-->
<!--                                <div class="form-check">-->
<!--                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"-->
<!--                                        {{ old('remember') ? 'checked' : '' }}>-->
<!--                                    <label class="form-check-label" for="remember">-->
<!--                                        {{ __('Remember Me') }}-->
<!--                                    </label>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="row mb-0">-->
<!--                            <div class="col-md-8 offset-md-4">-->
<!--                                <button type="submit" class="btn btn-primary">-->
<!--                                    {{ __('Login') }}-->
<!--                                </button>-->
<!--                                @if (Route::has('password.request'))-->
<!--                                <a class="btn btn-link" href="{{ route('password.request') }}">-->
<!--                                    {{ __('Forgot Your Password?') }}-->
<!--                                </a>-->
<!--                                @endif-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </form>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
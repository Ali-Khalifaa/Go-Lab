<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>GOLAB</title>
    <link rel="shortcut icon" href="{{ url('/') }}/public/images/logo.png" type="image/png"/>
    <!-- Bootstrap -->
    <link href="{{asset('/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{asset('vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- Animate.css -->
    <link href="{{asset('vendors/animate.css/animate.min.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{asset('build/css/custom.min.css')}}" rel="stylesheet">
    <!--  font     -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Tajawal', sans-serif;
        }

        .header-login {
            width: 100%;
            height: 40px;
            background-color: #251754;
        }

        .footer-login {
            position: absolute;
            bottom: 0;
            text-align: center;
            width: 100%;
            font-size: 20px;
            color: white;
            background: #2e2e2e;
            z-index: 999;
            padding: 10px;
        }

        .footer-login span a {
            color: #61c08d;
        }
    </style>
</head>
<body class="login ">
<div class="header-login"></div>
<div class="container">
    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
                <form method="POST" action="{{ route('login') }}">
                    <h1>
                        <img style="width: 200px" src="{{asset('images/logo.png')}}" alt="">
                    </h1>
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-12">
                            <input id="email" type="email" placeholder="الإيميل"
                                   class="form-control @error('email') is-invalid @enderror" name="email"
                                   value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <input id="password" type="password" placeholder="كلمة السر"
                                   class="form-control @error('password') is-invalid @enderror" name="password" required
                                   autocomplete="current-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember"
                                       id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    تذكرني
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div>
                            <button type="submit" class="btn btn-default submit">
                                تسجيل الدخول
                            </button>

                            {{--                                @if (Route::has('password.request'))--}}
                            {{--                                    <a class="reset_pass" href="{{ route('password.request') }}">--}}
                            {{--                                        {{ __('Forgot Your Password?') }}--}}
                            {{--                                    </a>--}}
                            {{--                                @endif--}}
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    {{--                        <div class="separator">--}}
                    {{--                        <div>--}}
                    {{--                                <h1><i class="fa fa-paw"></i> App Dashboard!</h1>--}}
                    {{--                                <p>@ {{ now()->year }} All Rights Reserved. Privacy and Terms</p>--}}
                    {{--                              </div>--}}
                    {{--                        </div>--}}
                </form>
            </section>
        </div>
    </div>
</div>
<div class="footer-login">
    <span><a href="http://innovations-eg.com/">Innovations</a></span>
    كافة الحقوق محفوظة لشركة
</div>
</body>
</html>


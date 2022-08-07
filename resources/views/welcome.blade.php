<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>GOLAB</title>
    <link rel="shortcut icon" href="{{ url('/') }}/public/images/logo.png" type="image/png" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal&display=swap" rel="stylesheet">
    <!-- Styles -->
    <style>
        * {
            font-family: 'Tajawal', sans-serif;
        }

        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        .img-container {
            border: 10px solid #251754;
            border-radius: 50%;
            width: 500px;
            height: 500px;
        }

        .logo-img {
            width: 60%;
            white-space: nowrap;
            text-align: center;
            margin-top: 85px;
            vertical-align: middle;
        }

        .link-nav {
            background: #251754;
            color: white !important;
            padding: 15px !important;
            border-radius: 30px;
        }

        * {
            font-family: 'Tajawal', sans-serif;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a class="link-nav" href="{{ url('/admin') }}">لوحة التحكم</a>
            @else
                <a class="link-nav" href="{{ route('login') }}">تسجيل الدخول</a>
            @endauth
            <a class="link-nav" href="{{route('download')}}">تحميل نسخة المندوب</a>
        </div>
    @endif

    <div class="content">
        <div class="title m-b-md">
            <div class="img-container">
                <img class="logo-img" src="{{asset('images/logo.png')}}" alt="">
            </div>
        </div>


    </div>
</div>
</body>
</html>

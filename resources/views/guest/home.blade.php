<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">


</head>

<body>
    <div class="d-flex justify-content-end">
        @if (Route::has('login'))
            <div class="top-right links">

                @auth
                    <a href="{{ route('admin.home') }}">Daashboard</a>
                @else
                    <a href="{{ route('login') }}">Login</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif
                @endauth
            </div>
    </div>
    @endif

    <div id="root"></div>

    <script src="{{ asset('js/front.js') }}"></script>
</body>

</html>

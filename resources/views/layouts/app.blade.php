<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {!! SEO::generate() !!}
    <meta property="og:image"         content="{{config('app.url')}}/images/logo.png" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Google Ads -->
    @if (config('app.ads_enabled'))
        
    @endif
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body class="d-flex flex-column min-vh-100">
    <div id="app">
        @include('inc.navbar')
        <main>
            @yield('content')
        </main>
    </div>
</body>
<footer class="mt-auto">
    @include('inc.ad.bottom_ad')
    @include('inc.footer')
</footer>
@yield('script')
</html>

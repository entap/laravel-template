<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('admin.title') }}</title>

    <script src="{{ asset('js/admin.js') }}"></script>

    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">

    @stack('head')
</head>

<body>
    <div id="app" style="padding-top: 6rem;">
        @include('admin.partials.navbar')

        <div class="container">
            @yield('content')
        </div>
    </div>
</body>

</html>

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('admin.title') }}</title>

    <script src="{{ asset('vendor/admin/js/app.js') }}"></script>

    <link href="{{ asset('vendor/admin/css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        @yield('app')
    </div>
</body>

</html>

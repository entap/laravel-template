<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        @include('layouts._navbar')

        <div class="container mt-4">
            <div class="row">
                <nav class="col-3">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a class="nav-link @if (request()->route()->named('groups.descendants.*')) active @endif" href="{{ route('groups.descendants.index', $group) }}">
                                @lang('Groups')
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if (request()->route()->named('groups.members.*')) active @endif" href="{{ route('groups.members.index', $group) }}">
                                @lang('Members')
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="col-9">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</body>

</html>

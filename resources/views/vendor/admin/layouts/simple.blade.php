@extends('admin::layouts.app')

@section('app')
    @include('admin::partials.header')

    <main class="py-4">
        @yield('content')
    </main>
@endsection

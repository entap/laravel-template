@extends('admin::layouts.app')

@section('app')
    @include('admin::partials.header')

    <div class="py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    @include('admin::partials.sidebar')
                </div>
                <main class="col-md-8">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>
@endsection

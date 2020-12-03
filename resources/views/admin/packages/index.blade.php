@extends('admin::layouts.sidebar')

@section('content')
    @foreach ($packages as $package)
        {{ $package->name }}
    @endforeach
@endsection

@extends('admin::layouts.sidebar')

@section('content')
    @foreach ($items as $item)
        {{ $item->title }}
        {{ $item->uri }}
    @endforeach
@endsection

@extends('admin::layouts.sidebar')

@section('content')
    {{ __('Title') }}
    {{ $item->title }}
    {{ __('URL') }}
    {{ $item->uri }}
    {{ __('Order') }}
    {{ $item->order }}
    {{ __('Update') }}
@endsection

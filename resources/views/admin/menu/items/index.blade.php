@extends('admin::layouts.sidebar')

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>{{ __('Title') }}</th>
                <th>{{ __('URL') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->uri }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

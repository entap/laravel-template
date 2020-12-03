@extends('admin::layouts.sidebar')

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>{{ __('Name') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($packages as $package)
                <tr>
                    <td>{{ $package->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

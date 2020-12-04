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
                    <td>
                        <a href="{{ route('admin.packages.show', $package) }}">
                            {{ $package->name }}
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

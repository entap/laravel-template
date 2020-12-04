@extends('admin::layouts.sidebar')

@section('content')
    <h1>{{ $package->name }}</h1>

    @if (empty($package->releases->count()))
        {{ __('No Release') }}
    @else
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>{{ __('Version') }}</th>
                    <th>{{ __('URL') }}</th>
                    <th>{{ __('Publish Date') }}</th>
                    <th>{{ __('Expire Date') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($package->releases as $release)
                    <tr>
                        <td>{{ $release->version }}</td>
                        <td>{{ $release->uri }}</td>
                        <td>{{ $release->publish_date }}</td>
                        <td>{{ $release->expire_date }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <div>
        <a href="{{ route('admin.packages.index') }}" class="btn btn-link">
            {{ __('Back') }}
        </a>
    </div>
@endsection

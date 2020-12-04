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
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($package->releases as $release)
                    <tr>
                        <td>{{ $release->version }}</td>
                        <td>{{ $release->uri }}</td>
                        <td>{{ $release->publish_date }}</td>
                        <td>{{ $release->expire_date }}</td>
                        <td>
                            <form method="POST"
                                action="{{ route('admin.packages.releases.destroy', [$package, $release]) }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger"
                                    onclick="return confirm('{{ __('Are you sure you want to delete?') }}')">
                                    {{ __('Delete') }}
                                </button>
                            </form>
                        </td>
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

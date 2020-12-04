@extends('admin::layouts.sidebar')

@section('content')
    <div class="text-right">
        <a href="{{ route('admin.packages.create') }}" class="btn btn-link">
            + {{ __('Create Package') }}
        </a>
    </div>

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
                    <td>
                        <a href="{{ route('admin.packages.edit', $package) }}">
                            {{ __('Edit') }}
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@extends('admin::layouts.sidebar')

@section('content')
    <dl>
        <dt>{{ __('Name') }}</dt>
        <dd>{{ $package->name }}</dd>

        <dt>{{ __('Versions') }}</dt>
        <dd>
            <table class="table">
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
        </dd>
    </dl>
@endsection

@extends(config('admin.view.layouts.default'))

@section('content')
    <h1>{{ $user->name }}</h1>

    <h5 class="mt-4">@lang('entities.user_devices.title')</h5>
    <table class="table">
        <thead>
            <tr>
                <th>@lang('UUID')</th>
                <th>@lang('entities.user_devices.properties.platform')</th>
                <th>@lang('entities.user_devices.properties.package')</th>
                <th>@lang('entities.user_devices.properties.package_version')</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($user->devices as $device)
                <tr>
                    <td>{{ Str::limit($device->uuid, 8, '...') }}</td>
                    <td>{{ $device->platform }}</td>
                    <td>{{ $device->package }}</td>
                    <td>{{ $device->package_version }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

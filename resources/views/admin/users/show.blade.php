@extends(config('admin.view.layouts.default'))

@section('content')
    @include('admin.partials.alerts.success')

    <h1>{{ $user->name }}</h1>

    @if ($user->isSuspended())
        <p class="alert alert-danger">@lang('This user has suspended.')</p>
    @endif

    @if ($user->isTester())
        <p class="alert alert-secondary">このユーザーは検証ユーザーです。</p>
    @endif

    <div class="text-right">
        <div>
            @if ($user->isTester())
                <form action="{{ route('admin.users.remove-tester-role', $user) }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary text-nowrap">
                            @lang('admin/actions.tester.remove')
                        </button>
                    </div>
                </form>
            @else
                <form action="{{ route('admin.users.assign-tester-role', $user) }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary text-nowrap">
                            @lang('admin/actions.tester.assign')
                        </button>
                    </div>
                </form>
            @endif
        </div>
    </div>

    <div class="text-right">
        <div>
            @if ($user->isSuspended())
                <form action="{{ route('admin.users.unsuspend', $user) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-primary text-nowrap">
                        @lang('Unsuspend')
                    </button>
                </form>
            @else
                <a href="{{ route('admin.users.suspend', $user) }}" class="btn btn-danger text-nowrap">
                    @lang('Suspend')
                </a>
            @endif
        </div>
    </div>

    <h5 class="mt-4">@lang('entities.user_devices.title')</h5>
    @if ($devices->count())
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
    @else
        <p>@lang('No user device.')</p>
    @endif

    <hr>

    <div>
        <a href="{{ route('admin.users.index') }}" class="btn btn-link">
            @lang('Back')
        </a>
    </div>
@endsection

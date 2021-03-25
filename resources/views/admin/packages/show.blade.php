@extends(config('admin.view.layouts.default'))

@section('content')
    <h1>{{ $package->name }}</h1>

    <div class="text-right">
        <a href="{{ route('admin.packages.releases.create', $package) }}" class="btn btn-primary">
            @lang('releases.actions.create')
        </a>
    </div>

    @if (empty($package->releases->count()))
        @lang('No Release')
    @else
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>@lang('releases.properties.version')</th>
                    <th>@lang('releases.properties.uri')</th>
                    <th>@lang('releases.properties.publish_date')</th>
                    <th>@lang('releases.properties.expire_date')</th>
                    <th></th>
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
                            <a href="{{ route('admin.packages.releases.edit', [$package, $release]) }}"
                                class="btn btn-sm btn-link text-nowrap">
                                @lang('Edit')
                            </a>
                        </td>
                        <td>
                            <form method="POST"
                                action="{{ route('admin.packages.releases.destroy', [$package, $release]) }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger text-nowrap"
                                    onclick="return confirm('@lang('messages.confirmations.delete')')">
                                    @lang('Delete')
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
            @lang('Back')
        </a>
    </div>
@endsection

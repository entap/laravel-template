@extends(config('admin.view.layouts.default'))

@section('content')
    <h1>@lang('packages.title')</h1>

    <div class="text-right">
        <a href="{{ route('admin.packages.create') }}" class="btn btn-primary">
            @lang('packages.actions.create')
        </a>
    </div>

    <table class="table mt-4">
        <thead>
            <tr>
                <th>@lang('packages.properties.name')</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($packages as $package)
                <tr>
                    <td>
                        {{ $package->name }}
                    </td>
                    <td>
                        <a href="{{ route('admin.packages.show', $package) }}" class="btn btn-sm btn-link text-nowrap">
                            @lang('Show')
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('admin.packages.edit', $package) }}" class="btn btn-sm btn-primary text-nowrap">
                            @lang('Edit')
                        </a>
                    </td>
                    <td>
                        <form method="POST" action="{{ route('admin.packages.destroy', $package) }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger text-nowrap"
                                onclick="return confirm('@lang('admin::messages.confirmations.delete')')">
                                @lang('Delete')
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

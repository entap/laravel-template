@extends(config('admin.view.layouts.default'))

@section('content')
    <h1>@lang('admin::roles.title')</h1>

    @include('admin::partials.alerts.error')

    <div class="text-right mb-4">
        <a href="{{ route('admin.settings.roles.create') }}" class="btn btn-primary">
            @lang('admin::roles.actions.create')
        </a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>@lang('admin::roles.properties.name')</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($roles as $role)
                <tr>
                    <td class="w-100">{{ $role->name }}</td>
                    <td>
                        <a href="{{ route('admin.settings.roles.show', $role) }}"
                            class="btn btn-sm btn-link text-nowrap mr-1">
                            @lang('Show')
                        </a>

                    </td>
                    <td>
                        <a href="{{ route('admin.settings.roles.edit', $role) }}"
                            class="btn btn-sm btn-primary text-nowrap mr-1">
                            @lang('Edit')
                        </a>
                    </td>
                    <td>
                        <form method="POST" action="{{ route('admin.settings.roles.destroy', $role) }}">
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

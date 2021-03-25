@extends(config('admin.view.layouts.default'))

@section('content')
    <h1>@lang('users.title')</h1>

    <div class="text-right mb-4">
        <a href="{{ route('admin.settings.users.create') }}" class="btn btn-primary">@lang('users.actions.create')</a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th class="w-100">@lang('users.properties.name')</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>
                        <a href="{{ route('admin.settings.users.show', $user) }}" class="btn btn-sm btn-link text-nowrap">
                            @lang('Show')
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('admin.settings.users.edit', $user) }}"
                            class="btn btn-sm btn-primary text-nowrap">
                            @lang('Edit')
                        </a>
                    </td>
                    <td>
                        @if (Admin::user()->id !== $user->id)
                            <form method="POST" action="{{ route('admin.settings.users.destroy', $user) }}">
                                @csrf
                                @method("DELETE")
                                <button class="btn btn-sm btn-danger text-nowrap"
                                    onclick="return confirm('@lang('messages.confirmations.delete')')">
                                    @lang('Delete')
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@extends(config('admin.view.layouts.default'))

@section('content')
    <dl id="role">
        <dt>@lang('roles.properties.name')</dt>
        <dd>{{ $role->name }}</dd>

        <dt>@lang('permissions.title')</dt>
        <dd>
            <ul>
                @foreach ($role->permissions as $permission)
                    <li>
                        {{ $permission->name }}
                    </li>
                @endforeach
            </ul>
        </dd>
    </dl>

    <div class="d-flex">
        <a href="{{ route('admin.settings.roles.index') }}" class="btn btn-link mr-1">
            @lang('Back')
        </a>

        <a href="{{ route('admin.settings.roles.edit', $role) }}" class="btn btn-primary text-nowrap mr-1">
            @lang('Edit')
        </a>

        <form method="POST" action="{{ route('admin.settings.roles.destroy', $role) }}">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger" onclick="return confirm('@lang('messages.confirmations.delete')')">
                @lang('Delete')
            </button>
        </form>
    </div>
@endsection

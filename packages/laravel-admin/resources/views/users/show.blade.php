@extends(config('admin.view.layouts.default'))

@section('content')
    <dl id="user">
        <dt>@lang('admin::users.properties.name')</dt>
        <dd>{{ $user->name }}</dd>

        <dt>@lang('admin::users.properties.username')</dt>
        <dd>{{ $user->username }}</dd>

        <dt>@lang('admin::roles.title')</dt>
        <dd>
            <ul>
                @foreach ($user->roles as $role)
                    <li>
                        {{ $role->name }}
                    </li>
                @endforeach
            </ul>
        </dd>

        <dt>@lang('admin::permissions.title')</dt>
        <dd>
            <ul>
                @foreach ($user->permissions as $permission)
                    <li>
                        {{ $permission->name }}
                    </li>
                @endforeach
            </ul>
        </dd>

        @unless(empty($user->groups))
            <dt>@lang('admin::user_groups.title')</dt>
            <dd>
                @foreach ($user->groups as $group)
                    <div class="group">{{ $group->name }}</div>
                @endforeach
            </dd>
        @endunless
    </dl>

    <div class="d-flex">
        <a href="{{ route('admin.settings.users.edit', $user) }}" class="btn btn-primary mr-1">
            @lang('Edit')
        </a>
        @if (Admin::user()->id !== $user->id)
            <form method="POST" action="{{ route('admin.settings.users.destroy', $user) }}">
                @csrf
                @method("DELETE")
                <button class="btn btn btn-danger"
                    onclick="return confirm('@lang('admin::messages.confirmations.delete')')">
                    @lang('Delete')
                </button>
            </form>
        @endif
    </div>

    <hr>

    <div>
        <a href="{{ route('admin.settings.users.index') }}" class="btn btn-link">
            @lang('Back')
        </a>
    </div>
@endsection

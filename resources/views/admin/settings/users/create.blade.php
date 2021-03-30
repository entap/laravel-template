@extends(config('admin.view.layouts.default'))

@section('content')
    <h1>@lang('messages.common.create', ['entity' => __('users.title')])</h1>

    <form action="{{ route('admin.settings.users.store') }}" method="post">
        @csrf

        <div class="form-group">
            <label for="name">@lang('users.properties.name')</label>
            <div>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name') }}" />

                <x-error name="name"></x-error>
            </div>
        </div>

        <div class="form-group">
            <label for="username">@lang('users.properties.username')</label>
            <div>
                <input type="text" name="username" id="username"
                    class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}"
                    autocomplete="off" />

                <x-error name="username"></x-error>
            </div>
        </div>

        <div class="form-group">
            <label for="password">@lang('users.properties.password')</label>
            <div>
                <input type="password" name="password" id="password"
                    class="form-control @error('password') is-invalid @enderror" autocomplete="new-password" />

                <x-error name="password"></x-error>
            </div>
        </div>

        <div class="form-group">
            <label for="password">@lang('users.properties.password_confirmation')</label>
            <div>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="form-control @error('password') is-invalid @enderror" autocomplete="new-password" />
            </div>
        </div>

        <div class="form-group">
            <label for="roles">@lang('roles.title')</label>
            <div>
                @foreach ($roles as $role)
                    <div class="form-check">
                        <input type="checkbox" name="roles[]" value="{{ $role->id }}" id="role-{{ $role->id }}"
                            class="form-check-input @error('roles') is-invalid @enderror" />
                        <label for="role-{{ $role->id }}">
                            {{ $role->name }}
                        </label>
                    </div>
                @endforeach

                <x-error name="roles"></x-error>
            </div>
        </div>

        <div class="form-group">
            <label for="permissions">@lang('permissions.title')</label>
            <div>
                @foreach ($permissions as $permission)
                    <div class="form-check">
                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                            id="permission-{{ $permission->id }}"
                            class="form-check-input @error('permissions') is-invalid @enderror" />
                        <label for="permission-{{ $permission->id }}">
                            {{ $permission->name }}
                        </label>
                    </div>
                @endforeach

                <x-error name="permissions"></x-error>
            </div>
        </div>

        <div class="form-group">
            <label for="group_id">@lang('user_groups.title')</label>
            <div>
                <select name="group_id" id="group_id" class="form-control @error('group_id') is-invalid @enderror">
                    <option value="">@lang('None')</option>
                    @foreach ($groupOptions as $option)
                        <option value="{{ $option->id }}" {{ $option->id == old('group_id') ? 'selected' : '' }}>
                            {{ $option->name }}
                        </option>
                    @endforeach
                </select>

                <x-error name="group_id"></x-error>
            </div>
        </div>

        <div class="form-group text-right">
            <button type="submit" class="btn btn-primary">
                @lang('Create')
            </button>
        </div>
    </form>

    <hr>

    <div>
        <a href="{{ route('admin.settings.users.index') }}" class="btn btn-link">
            @lang('Back')
        </a>
    </div>
@endsection

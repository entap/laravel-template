@extends(config('admin.view.layouts.default'))

@section('content')
    <form action="{{ route('admin.settings.users.update', $user) }}" method="post">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">@lang('admin::users.properties.name')</label>
            <div>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name', $user->name) }}" />

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="username">@lang('admin::users.properties.username')</label>
            <div>
                <input type="text" name="username" id="username"
                    class="form-control @error('username') is-invalid @enderror"
                    value="{{ old('username', $user->username) }}" />

                @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="password">@lang('admin::users.properties.password')</label>
            <div>
                <input type="password" name="password" id="password"
                    class="form-control @error('password') is-invalid @enderror" />

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="password">@lang('admin::users.properties.password_confirmation')</label>
            <div>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="form-control @error('password') is-invalid @enderror" />
            </div>
        </div>

        <div class="form-group">
            <label for="roles">@lang('admin::roles.title')</label>
            <div>
                @foreach ($roles as $role)
                    <div class="form-check">
                        <input type="checkbox" name="roles[]" value="{{ $role->id }}" id="role-{{ $role->id }}"
                            class="form-check-input @error('roles') is-invalid @enderror"
                            {{ collect(old('roles', $user->roles->pluck('id')))->contains($role->id) ? 'checked' : '' }} />
                        <label for="role-{{ $role->id }}">
                            {{ $role->name }}
                        </label>
                    </div>
                @endforeach

                @error('roles')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="permissions">@lang('admin::permissions.title')</label>
            <div>
                @foreach ($permissions as $permission)
                    <div class="form-check">
                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                            id="permission-{{ $permission->id }}"
                            class="form-check-input @error('permissions') is-invalid @enderror"
                            {{ collect(old('permissions', $user->permissions->pluck('id')))->contains($permission->id) ? 'checked' : '' }} />
                        <label for="permission-{{ $permission->id }}">
                            {{ $permission->name }}
                        </label>
                    </div>
                @endforeach

                @error('permissions')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="group_id">@lang('admin::user_groups.title')</label>
            <div>
                <select name="group_id" id="group_id" class="form-control @error('group_id') is-invalid @enderror">
                    <option value="">@lang('None')</option>
                    @foreach ($groupOptions as $option)
                        <option value="{{ $option->id }}"
                            {{ $option->id == old('group_id', $user->groups->pluck('id')->first()) ? 'selected' : '' }}>
                            {{ $option->name }}
                        </option>
                    @endforeach
                </select>

                @error('group_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group text-right">
            <button type="submit" class="btn btn-primary">
                @lang('Update')
            </button>
        </div>
    </form>

    <hr>

    <div>
        <a href="{{ route('admin.settings.users.show', $user) }}" class="btn btn-link">
            @lang('Back')
        </a>
    </div>
@endsection

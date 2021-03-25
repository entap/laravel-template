@extends(config('admin.view.layouts.default'))

@section('content')
    <form action="{{ route('admin.settings.roles.update', $role) }}" method="post">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">@lang('roles.properties.name')</label>
            <div>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name', $role->name) }}" />

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="permissions">@lang('permissions.title')</label>
            <div>
                @foreach ($permissions as $permission)
                    <div class="form-check">
                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                            id="permission-{{ $permission->id }}"
                            class="form-check-input @error('permissions') is-invalid @enderror"
                            {{ collect(old('permissions', $role->permissions->pluck('id')))->contains($permission->id) ? 'checked' : '' }} />
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

        <div class="form-group text-right">
            <button type="submit" class="btn btn-primary">
                @lang('Update')
            </button>
        </div>
    </form>

    <hr>

    <div>
        <a href="{{ route('admin.settings.roles.show', $role) }}" class="btn btn-link">
            @lang('Back')
        </a>
    </div>
@endsection

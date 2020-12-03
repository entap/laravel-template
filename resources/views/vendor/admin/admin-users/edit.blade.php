@extends('admin::layouts.sidebar')

@section('content')
    <form action="{{ route('admin.users.update', $user) }}" method="post">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">名前</label>
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
            <label for="username">ログインID</label>
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
            <label for="password">パスワード</label>
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
            <label for="password">パスワード（確認）</label>
            <div>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="form-control @error('password') is-invalid @enderror" />
            </div>
        </div>

        <div class="form-group">
            <label for="roles">ロール</label>
            <div>
                <select name="roles[]" id="roles" class="form-control @error('roles') is-invalid @enderror" multiple>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}"
                            {{ collect(old('roles', $user->roles()->pluck('id')))->contains($role->id) ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>

                @error('roles')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="permissions">パーミッション</label>
            <div>
                <select name="permissions[]" id="permissions"
                    class="form-control @error('permissions') is-invalid @enderror" multiple>
                    @foreach ($permissions as $permission)
                        <option value="{{ $permission->id }}"
                            {{ collect(old('permissions', $user->permissions()->pluck('id')))->contains($permission->id) ? 'selected' : '' }}>
                            {{ $permission->name }}
                        </option>
                    @endforeach
                </select>

                @error('permissions')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <a href="{{ route('admin.users.show', $user) }}" class="btn btn-link">
                戻る
            </a>
            <button type="submit" class="btn btn-primary">
                更新
            </button>
        </div>
    </form>
@endsection

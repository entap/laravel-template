@extends('admin::layouts.sidebar')

@section('content')
    <form action="{{ route('admin.roles.store') }}" method="post">
        @csrf

        <div class="form-group">
            <label for="name">名前</label>
            <div>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name') }}" />

                @error('name')
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
                            {{ in_array($permission->id, old('permissions', [])) ? 'selected' : '' }}>
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
            <a href="{{ route('admin.roles.index') }}" class="btn btn-link">
                戻る
            </a>
            <button type="submit" class="btn btn-primary">
                作成
            </button>
        </div>
    </form>
@endsection

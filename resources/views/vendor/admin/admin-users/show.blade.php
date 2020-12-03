@extends('admin::layouts.sidebar')

@section('content')
    <dl id="user">
        <dt>名前</dt>
        <dd>{{ $user->name }}</dd>

        <dt>ログインID</dt>
        <dd>{{ $user->username }}</dd>

        <dt>権限セット</dt>
        <dd>
            <ul>
                @foreach ($user->roles as $role)
                    <li>
                        {{ $role->name }}
                    </li>
                @endforeach
            </ul>
        </dd>

        <dt>権限</dt>
        <dd>
            <ul>
                @foreach ($user->permissions as $permission)
                    <li>
                        {{ $permission->name }}
                    </li>
                @endforeach
            </ul>
        </dd>
    </dl>

    <div class="d-flex">
        <a href="{{ route('admin.users.index') }}" class="btn btn-link mr-1">
            一覧に戻る
        </a>
        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary mr-1">
            編集
        </a>
        @include('admin::partials.admin-users.btn-delete')
    </div>
@endsection

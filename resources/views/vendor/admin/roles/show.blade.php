@extends('admin::layouts.sidebar')

@section('content')
    <dl id="role">
        <dt>名前</dt>
        <dd>{{ $role->name }}</dd>

        <dt>権限</dt>
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
        <a href="{{ route('admin.roles.index') }}" class="btn btn-link mr-1">
            一覧に戻る
        </a>

        <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-primary text-nowrap mr-1">
            編集
        </a>

        <form method="POST" action="{{ route('admin.roles.destroy', $role) }}">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger" onclick="return confirm('本当に削除してもよろしいですか？')">
                削除
            </button>
        </form>
    </div>
@endsection

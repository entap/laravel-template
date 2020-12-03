@extends('admin::layouts.sidebar')

@section('content')
    <div class="text-right mb-4">
        <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">
            追加
        </a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>名前</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($roles as $role)
                <tr>
                    <td>{{ $role->name }}</td>
                    <td>
                        <div class="d-flex">
                            <a href="{{ route('admin.roles.show', $role) }}" class="btn btn-link text-nowrap mr-1">
                                詳細
                            </a>

                            <a href="{{ route('admin.roles.edit', $role) }}" class="btn btn-primary text-nowrap mr-1">
                                編集
                            </a>

                            <form method="POST" action="{{ route('admin.roles.destroy', $role) }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger text-nowrap" onclick="return confirm('本当に削除してもよろしいですか？')">
                                    削除
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

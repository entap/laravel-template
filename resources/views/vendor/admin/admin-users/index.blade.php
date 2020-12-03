@extends('admin::layouts.sidebar')

@section('content')
    <div class="text-right mb-4">
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">追加</a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>名前</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>
                        <div class="d-flex">
                            <a href="{{ route('admin.users.show', $user) }}" class="btn btn-link">
                                詳細
                            </a>
                            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary mr-1">
                                編集
                            </a>
                            @include('admin::partials.admin-users.btn-delete')
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

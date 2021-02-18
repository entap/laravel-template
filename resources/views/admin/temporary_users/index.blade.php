@extends(config('admin.view.layouts.default'))

@section('content')
    <h1>@lang('temporary_users.title')</h1>

    @if (count($users))
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>@lang('temporary_users.properties.name')</th>
                    <th>@lang('temporary_users.properties.email')</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <form action="{{ route('admin.temporary-users.accept', $user) }}" method="POST">
                                @csrf
                                <div>
                                    <button type="submit" class="btn btn-sm btn-primary text-nowrap">
                                        @lang('Accept')
                                    </button>
                                </div>
                            </form>
                        </td>
                        <td>
                            <form action="{{ route('admin.temporary-users.reject', $user) }}" method="POST">
                                @csrf
                                <div>
                                    <button type="submit" class="btn btn-sm btn-danger text-nowrap">
                                        @lang('Reject')
                                    </button>
                                </div>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $users->withQueryString()->links() }}
        </div>
    @else
        <div class="mt-4">@lang('No User.')</div>
    @endif
@endsection

@extends(config('admin.view.layouts.default'))

@section('content')
    <h1>@lang('Admin User Groups')</h1>

    <div class="text-right">
        <a href="{{ route('admin.user-groups.create') }}" class="btn btn-primary">
            @lang('Add User Group')
        </a>
    </div>

    <table class="table mt-4">
        <thead>
            <tr>
                <th>@lang('Name')</th>
                <th>@lang('Users')</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($groups as $group)
                <tr>
                    <td>{{ $group->name }}</td>
                    {{-- TODO SQLで用意する --}}
                    <td>{{ $group->users->count() }}</td>
                    <td>
                        <form action="{{ route('admin.user-groups.destroy', $group) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('{{ __('Are you sure you want to delete?') }}')">
                                {{ __('Delete') }}
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

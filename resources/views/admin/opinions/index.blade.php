@extends(config('admin.view.layouts.default'))

@section('content')
    <h1>@lang('User Opinions')</h1>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>@lang('Contact')</th>
                <th>@lang('Subject')</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($opinions as $opinion)
                <tr>
                    <td>
                        <a href="{{ route('admin.users.show', $opinion->user) }}">
                            {{ $opinion->userName }}
                        </a>
                    </td>
                    <td>{{ $opinion->subject }}</td>
                    <td>
                        <a href="{{ route('admin.opinions.show', $opinion) }}" class="btn btn-sm btn-link text-nowrap">
                            @lang('Show')
                        </a>
                    </td>
                    <td>
                        <form action="{{ route('admin.opinions.destroy', $opinion) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-sm btn-danger text-nowrap"
                                onclick="return confirm('@lang('messages.confirmations.delete')')">
                                @lang('Delete')
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

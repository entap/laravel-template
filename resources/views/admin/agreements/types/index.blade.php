@extends(config('admin.view.layouts.default'))

@section('content')
    <h1>@lang('Agreement Types')</h1>

    <div class="text-right">
        <a href="{{ route('admin.agreement_types.create') }}" class="btn btn-link text-nowrap">
            @lang('Add Agreement Type')
        </a>
    </div>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>@lang('Name')</th>
                <th>@lang('Slug')</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($types as $type)
                <tr>
                    <td>{{ $type->slug }}</td>
                    <td>{{ $type->name }}</td>
                    <td>
                        <a href="{{ route('admin.agreement_types.show', $type) }}" class="btn btn-sm btn-link">
                            @lang('Show')
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('admin.agreement_types.edit', $type) }}" class="btn btn-sm btn-primary">
                            @lang('Edit')
                        </a>
                    </td>
                    <td>
                        <form action="{{ route('admin.agreement_types.destroy', $type) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-sm btn-danger text-nowrap"
                                onclick="return confirm('@lang('admin::messages.confirmations.delete')')">
                                @lang('Delete')
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

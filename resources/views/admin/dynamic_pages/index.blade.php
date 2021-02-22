@extends(config('admin.view.layouts.default'))

@section('content')
    <h1>@lang('Dynamic Contents')</h1>

    <div class="text-right">
        <a href="{{ route('admin.dynamic-pages.create') }}" class="btn btn-primary">
            @lang('Add Content')
        </a>
    </div>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>@lang('Slug')</th>
                <th>@lang('Subject')</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pages as $page)
                <tr>
                    <td>{{ $page->slug }}</td>
                    <td>{{ optional($page->contents->last())->subject }}</td>
                    <td>
                        <a href="{{ route('admin.dynamic-pages.edit', $page) }}"
                            class="btn btn-sm btn-primary text-nowrap">
                            @lang('Edit')
                        </a>
                    </td>
                    <td>
                        <form action="{{ route('admin.dynamic-pages.destroy', $page) }}" method="POST">
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

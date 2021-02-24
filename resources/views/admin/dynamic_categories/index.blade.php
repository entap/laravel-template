@extends(config('admin.view.layouts.default'))

@section('content')
    <h1>@lang('Dynamic Content Categories')</h1>

    <div class="text-right">
        <a href="{{ route('admin.dynamic-categories.create') }}" class="btn btn-primary text-nowrap">
            @lang('Add Category')
        </a>
    </div>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>@lang('Name')</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>
                        {{ str_repeat('——', $category->depth) }}
                        {{ $category->name }}
                    </td>
                    <td>
                        <a href="{{ route('admin.dynamic-categories.show', $category) }}"
                            class="btn btn-sm btn-link text-nowrap">
                            @lang('Show')
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('admin.dynamic-categories.edit', $category) }}"
                            class="btn btn-sm btn-primary text-nowrap">
                            @lang('Edit')
                        </a>
                    </td>
                    <td>
                        <form action="{{ route('admin.dynamic-categories.destroy', $category) }}" method="POST">
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

@extends(config('admin.view.layouts.default'))

@section('content')
    <h1>@lang('admin::menu_items.title')</h1>

    <div class="text-right">
        <a href="{{ route('admin.settings.menu.items.create') }}" class="btn btn-primary text-nowrap">
            @lang('admin::menu_items.actions.create')
        </a>
    </div>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>@lang('admin::menu_items.properties.title')</th>
                <th>@lang('admin::menu_items.properties.uri')</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items->toFlatTree() as $item)
                <tr>
                    <td>
                        <span class="indent">{{ str_repeat('——', $item->depth) }}</span>
                        {{ $item->title }}
                    </td>
                    <td>{{ $item->uri }}</td>
                    <td>
                        <a href="{{ route('admin.settings.menu.items.edit', $item) }}"
                            class="btn btn-sm btn-link text-nowrap">
                            @lang('Edit')
                        </a>
                    </td>
                    <td>
                        <form method="POST" action="{{ route('admin.settings.menu.items.destroy', $item) }}">
                            @csrf
                            @method('DELETE')

                            <button class="btn btn-sm btn-danger"
                                onclick="return confirm('@lang('Are you sure you want to delete?')')">
                                @lang('Delete')
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@extends(config('admin.view.layouts.default'))

@section('content')
    <h1>@lang('Dynamic Content')</h1>

    <h3>{{ $page->slug }}</h3>

    <div class="text-right">
        <a href="{{ route('admin.dynamic-pages.edit', $page) }}" class="btn btn-primary">
            @lang('Edit')
        </a>
    </div>

    <h5>@lang('History')</h5>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>@lang('Subject')</th>
                <th>@lang('Updated At')</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contents as $content)
                <tr>
                    <td>{{ $content->subject }}</td>
                    <td>{{ $content->updated_at->format('Y-m-d H:i') }}</td>
                    <td>
                        <a href="{{ route('admin.dynamic-contents.show', $content) }}"
                            class="btn btn-sm btn-link text-nowrap" target="_new">
                            @lang('Show')
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <hr>

    <div>
        <a href="{{ route('admin.dynamic-pages.index') }}" class="btn btn-link text-nowrap">
            @lang('Back')
        </a>
    </div>
@endsection

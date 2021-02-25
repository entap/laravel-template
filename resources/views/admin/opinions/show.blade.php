@extends(config('admin.view.layouts.default'))

@section('content')
    <h1>@lang('User Opinion')</h1>

    <dl>
        <dt>@lang('Contact')</dt>
        <dd>
            <a href="{{ route('admin.users.show', $opinion->user) }}">
                {{ $opinion->userName }}
            </a>
        </dd>

        <dt>@lang('Subject')</dt>
        <dd>{{ $opinion->subject }}</dd>

        <dt>@lang('Body')</dt>
        <dd>{{ $opinion->body }}</dd>
    </dl>

    <hr>

    <div>
        <a href="{{ route('admin.opinions.index') }}" class="btn btn-link text-nowrap">
            @lang('Back')
        </a>
    </div>
@endsection

@extends(config('admin.view.layouts.default'))

@section('content')
    <h1>@lang('messages.common.create', ['entity' => __('mails.title')])</h1>

    <div class="mb-3">
        <a href="{{ route('admin.mails.index') }}" class="btn btn-info">
            @lang('Back')
        </a>
    </div>

    @include('mails.note')

    <form action="{{ route('admin.mails.store') }}" method="POST">
        @csrf

        @include('mails.form')

        <div class="mt-4">
            <button type="submit" class="btn btn-primary">
                @lang('Create')
            </button>
        </div>
    </form>
@endsection

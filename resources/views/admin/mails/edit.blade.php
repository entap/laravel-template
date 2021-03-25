@extends(config('admin.view.layouts.default'))

@section('content')
    @include('admin.partials.alerts.success')

    <h1>@lang('messages.common.edit', ['entity' => __('admin.mails.title')])</h1>

    @include('admin.mails.note')

    <form action="{{ route('admin.mails.update', $mail) }}" method="POST">
        @csrf
        @method('PUT')

        @include('admin.mails.form')

        <div class="form-group text-right">
            <button type="submit" class="btn btn-primary">
                @lang('Update')
            </button>
        </div>
    </form>

    <hr>

    <div>
        <a href="{{ route('admin.mails.index') }}" class="btn btn-link">
            @lang('Back')
        </a>
    </div>
@endsection

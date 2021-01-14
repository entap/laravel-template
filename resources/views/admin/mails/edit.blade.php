@extends(config('admin.view.layouts.default'))

@section('content')
    <h1>{{ __('Edit Mail Template') }}</h1>

    <div class="mb-3">
        <a href="{{ route('admin.mails.index') }}" class="btn btn-info">
            Back
        </a>
    </div>

    @include('admin.mails.note')

    <form action="{{ route('admin.mails.update', $mail) }}" method="POST">
        @csrf
        @method('PUT')

        @include('admin.mails.form')

        <div class="mt-4">
            <button type="submit" class="btn btn-primary">
                {{ __('Update') }}
            </button>
        </div>
    </form>
@endsection

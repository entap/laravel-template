@extends(config('admin.view.layouts.default'))

@section('content')
    <h1>{{ __('Add Mail Template') }}</h1>

    @include('admin.mails.note')

    <form action="{{ route('admin.mails.store') }}" method="POST">
        @csrf

        @include('admin.mails.form')

        <div class="mt-4">
            <button type="submit" class="btn btn-primary">
                {{ __('Create') }}
            </button>
        </div>
    </form>
@endsection

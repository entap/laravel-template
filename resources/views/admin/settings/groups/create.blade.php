@extends(config('admin.view.layouts.default'))

@section('content')
    <h1>@lang('Add Group')</h1>

    <form action="{{ route('admin.settings.groups.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">{{ __('Name') }}</label>
            <div>
                <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name"
                    value="{{ old('name') }}" required autocomplete="off" />

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="description">{{ __('Description') }}</label>
            <div>
                <textarea name="description" id="description"
                    class="form-control @error('description') is-invalid @enderror" rows="3"></textarea>

                @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary">
                {{ __('Create') }}
            </button>
        </div>
    </form>
@endsection

@extends(config('admin.view.layouts.default'))

@section('content')
    @include('admin.partials.alerts.success')

    <h1>@lang('App Settings')</h1>

    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="welcome_message">@lang('validation.attributes.welcome_message')</label>
            <div>
                <input type="text" id="welcome_message" class="form-control @error('welcome_message') is-invalid @enderror"
                    name="welcome_message" value="{{ old('welcome_message', $settings->welcome_message) }}"
                    autocomplete="off" required />
                @error('welcome_message')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary text-nowrap">
                @lang('Update')
            </button>
        </div>
    </form>
@endsection

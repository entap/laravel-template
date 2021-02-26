@extends(config('admin.view.layouts.default'))

@section('content')
    <h1>@lang('Add Agreement')</h1>

    <form action="{{ route('admin.agreement_types.agreements.store', $type) }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">@lang('Name')</label>
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
            <label for="description">@lang('Description')</label>
            <div>
                <textarea id="description" class="form-control @error('description') is-invalid @enderror"
                    name="description">{{ old('description') }}</textarea>
                @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary text-nowrap">
                @lang('Create')
            </button>
        </div>
    </form>

    <hr>

    <div>
        <a href="{{ route('admin.agreement_types.show', $type) }}" class="btn btn-link text-nowrap">
            @lang('Back')
        </a>
    </div>
@endsection

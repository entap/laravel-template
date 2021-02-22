@extends(config('admin.view.layouts.default'))

@section('content')
    <form action="{{ route('admin.dynamic-pages.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="slug">@lang('Slug')</label>
            <div>
                <input type="text" id="slug" class="form-control @error('slug') is-invalid @enderror" name="slug"
                    value="{{ old('slug') }}" required autocomplete="off" />
                @error('slug')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="subject">@lang('Subject')</label>
            <div>
                <input type="text" id="subject" class="form-control @error('subject') is-invalid @enderror" name="subject"
                    value="{{ old('subject') }}" required autocomplete="off" />
                @error('subject')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="body">@lang('Body')</label>
            <div>
                <textarea id="body" class="form-control @error('body') is-invalid @enderror" name="body"
                    required>{{ old('body') }}</textarea>
                @error('body')
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
        <a href="{{ route('admin.dynamic-pages.index') }}" class="btn btn-link text-nowrap">
            @lang('Back')
        </a>
    </div>
@endsection

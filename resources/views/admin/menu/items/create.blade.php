@extends(config('admin.view.layouts.default'))

@section('content')
    <form action="{{ route('admin.settings.menu.items.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="title">@lang('validation.attributes.title')</label>
            <div>
                <input id="title" class="form-control @error('title') is-invalid @enderror" type="text" name="title"
                    value="{{ old('title', '') }}" required autocomplete="off" />

                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="uri">@lang('validation.attributes.uri')</label>
            <div>
                <input id="uri" class="form-control @error('uri') is-invalid @enderror" type="text" name="uri"
                    value="{{ old('uri', '') }}" autocomplete="off" />

                @error('uri')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="parent_id">@lang('validation.attributes.parent_id')</label>
            <div>
                <select name="parent_id" id="parent_id" class="form-control @error('parent_id') is-invalid @enderror">
                    <option value=""></option>
                    @foreach ($parentOptions as $option)
                        <option value="{{ $option->id }}" {{ $option->id === old('parent_id', '') ? 'selected' : '' }}>
                            {{ $option->title }}
                        </option>
                    @endforeach
                </select>

                @error('parent_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                @lang('Create')
            </button>
        </div>
    </form>
@endsection

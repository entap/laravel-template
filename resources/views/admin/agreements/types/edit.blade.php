@extends(config('admin.view.layouts.default'))

@section('content')
    <h1>@lang('Edit Agreement Type')</h1>

    <form action="{{ route('admin.agreement_types.update', $type) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="slug">@lang('Slug')</label>
            <div>
                <input type="text" id="slug" class="form-control @error('slug') is-invalid @enderror" name="slug"
                    value="{{ old('slug', $type->slug) }}" required autocomplete="off" />
                @error('slug')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="name">@lang('Name')</label>
            <div>
                <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name"
                    value="{{ old('name', $type->name) }}" required autocomplete="off" />
                @error('name')
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

    <hr>

    <div>
        <a href="{{ route('admin.agreement_types.index') }}" class="btn btn-link text-nowrap">
            @lang('Back')
        </a>
    </div>
@endsection

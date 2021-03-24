@extends(config('admin.view.layouts.default'))

@section('content')
    <h1>@lang('packages.pages.create')</h1>

    <form action="{{ route('admin.packages.store') }}" method="post">
        @csrf

        <div class="form-group">
            <label for="name">@lang('packages.properties.name')</label>
            <div>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name') }}" />

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group text-right">
            <button type="submit" class="btn btn-primary">
                @lang('Create')
            </button>
        </div>
    </form>

    <hr>

    <div>
        <a href="{{ route('admin.packages.index') }}" class="btn btn-link">
            @lang('Back')
        </a>
    </div>
@endsection

@extends('admin::layouts.sidebar')

@section('content')
    <h1>{{ __('Create Release') }}</h1>

    <form action="{{ route('admin.packages.releases.store', $package) }}" method="post">
        @csrf

        <div class="form-group">
            <label for="version">{{ __('Version') }}</label>
            <div>
                <input type="text" name="version" id="version" class="form-control @error('version') is-invalid @enderror"
                    value="{{ old('version') }}" />

                @error('version')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="uri">{{ __('URL') }}</label>
            <div>
                <input type="text" name="uri" id="uri" class="form-control @error('uri') is-invalid @enderror"
                    value="{{ old('uri') }}" />

                @error('uri')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="publish_date">{{ __('Publish Date') }}</label>
            <div>
                <input type="text" name="publish_date" id="publish_date"
                    class="form-control @error('publish_date') is-invalid @enderror" value="{{ old('publish_date') }}" />

                @error('publish_date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>


        <div class="form-group">
            <label for="expire_date">{{ __('Expire Date') }}</label>
            <div>
                <input type="text" name="expire_date" id="expire_date"
                    class="form-control @error('expire_date') is-invalid @enderror" value="{{ old('expire_date') }}" />

                @error('expire_date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group text-right">
            <button type="submit" class="btn btn-primary">
                {{ __('Create') }}
            </button>
        </div>
    </form>

    <hr>

    <div>
        <a href="{{ route('admin.packages.show', $package) }}" class="btn btn-link">
            {{ __('Back') }}
        </a>
    </div>
@endsection

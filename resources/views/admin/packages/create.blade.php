@extends('admin::layouts.sidebar')

@section('content')
    <h1>{{ __('Create Package') }}</h1>

    <form action="{{ route('admin.packages.store') }}" method="post">
        @csrf

        <div class="form-group">
            <label for="name">{{ __('Name') }}</label>
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
                {{ __('Create') }}
            </button>
        </div>
    </form>

    <hr>

    <div>
        <a href="{{ route('admin.packages.index') }}" class="btn btn-link">
            {{ __('Back') }}
        </a>
    </div>
@endsection

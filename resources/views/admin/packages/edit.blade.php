@extends('admin::layouts.sidebar')

@section('content')
    <h1>{{ __('Update Package') }}</h1>

    <form action="{{ route('admin.packages.update', $package) }}" method="post">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">{{ __('Name') }}</label>
            <div>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name', $package->name) }}" />

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group text-right">
            <button type="submit" class="btn btn-primary">
                {{ __('Update') }}
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

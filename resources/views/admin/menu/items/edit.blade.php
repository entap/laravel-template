@extends('admin::layouts.sidebar')

@section('content')
    <form action="{{ route('admin.menu.items.update', $item) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">{{ __('Title') }}</label>
            <div>
                <input id="title" class="form-control @error('title') is-invalid @enderror" type="text" name="title"
                    value="{{ old('title', $item->title) }}" required autocomplete="off" />

                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="uri">{{ __('URL') }}</label>
            <div>
                <input id="uri" class="form-control @error('uri') is-invalid @enderror" type="text" name="uri"
                    value="{{ old('uri', $item->uri) }}" autocomplete="off" />

                @error('uri')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="order">{{ __('Order') }}</label>
            <div>
                <input id="order" class="form-control @error('order') is-invalid @enderror" type="number" name="order"
                    value="{{ old('order', $item->order) }}" required="0" autocomplete="off" />

                @error('order')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group mt-4 text-right">
            <button type="submit" class="btn btn-primary">
                {{ __('Update') }}
            </button>
        </div>
    </form>
@endsection

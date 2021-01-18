@extends(config('admin.view.layouts.default'))

@section('content')
    <h1>@lang('Add Property')</h1>

    <form action="{{ route('admin.settings.properties.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="display_name">{{ __('Display Name') }}</label>
            <div>
                <input type="text" id="display_name" class="form-control @error('display_name') is-invalid @enderror"
                    name="display_name" value="{{ old('display_name') }}" required autocomplete="off" />

                @error('display_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="description">{{ __('Description') }}</label>
            <div>
                <textarea name="name" id="name" class="form-control @error('description') is-invalid @enderror"
                    rows="3"></textarea>

                @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="name">{{ __('Name') }}</label>
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
            <label for="type_id">{{ __('Type') }}</label>
            <div>
                <select name="type_id" id="type_id" class="form-control @error('type_id') is-invalid @enderror">
                    @foreach ($typeOptions as $option)
                        <option value="{{ $option->id }}" {{ $option->id === old('type_id', '') ? 'selected' : '' }}>
                            {{ $option->display_name }}
                        </option>
                    @endforeach
                </select>

                @error('type_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary">
                {{ __('Create') }}
            </button>
        </div>
    </form>
@endsection

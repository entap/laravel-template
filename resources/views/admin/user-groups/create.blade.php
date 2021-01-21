@extends(config('admin.view.layouts.default'))

@section('content')
    <h1>@lang('Add User Groups')</h1>

    <form action="{{ route('admin.user-groups.store') }}" method="POST">
        @csrf

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
            <label for="parent_id">{{ __('Parent') }}</label>
            <div>
                <select name="parent_id" id="parent_id" class="form-control @error('parent_id') is-invalid @enderror">
                    <option value="">@lang('None')</option>
                    @foreach ($parentOptions as $option)
                        <option value="{{ $option->id }}" {{ $option->id === old('parent_id') ? 'selected' : '' }}>
                            {{ $option->name }}
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

        <div class="mt-4">
            <button type="submit" class="btn btn-primary">
                {{ __('Create') }}
            </button>
        </div>
    </form>
@endsection

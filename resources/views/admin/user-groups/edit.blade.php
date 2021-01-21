@extends(config('admin.view.layouts.default'))

@section('content')
    <h1>@lang('Edit User Groups')</h1>

    <form action="{{ route('admin.user-groups.update', $group) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">{{ __('Name') }}</label>
            <div>
                <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name"
                    value="{{ old('name', $group->name) }}" required autocomplete="off" />
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
                    @foreach ($parentOptions as $option)
                        <option value="{{ $option->id }}"
                            {{ $option->id === old('parent_id', $group->parent_id) ? 'selected' : '' }}>
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
                {{ __('Update') }}
            </button>
        </div>
    </form>
@endsection

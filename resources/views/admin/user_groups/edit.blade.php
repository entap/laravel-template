@extends(config('admin.view.layouts.default'))

@section('content')
    <h1>@lang('messages.common.edit', ['entity' => __('user_groups.title')])</h1>

    <form action="{{ route('admin.settings.user-groups.update', $group) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">@lang('user_groups.properties.name')</label>
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
            <label for="parent_id">@lang('user_groups.properties.parent')</label>
            <div>
                <select name="parent_id" id="parent_id" class="form-control @error('parent_id') is-invalid @enderror">
                    @foreach ($parentOptions as $option)
                        <option value=""></option>
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

        <div class="form-group text-right">
            <button type="submit" class="btn btn-primary">
                @lang('Update')
            </button>
        </div>
    </form>

    <hr>

    <div>
        <a href="{{ route('admin.settings.user-groups.index') }}" class="btn btn-link">
            @lang('Back')
        </a>
    </div>
@endsection

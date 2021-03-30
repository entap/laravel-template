@extends(config('admin.view.layouts.default'))

@section('content')
    <h1>@lang('Edit Dynamic Category')</h1>

    <form action="{{ route('admin.dynamic-categories.update', $category) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">@lang('Name')</label>
            <div>
                <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name"
                    value="{{ old('name', $category->name) }}" required autocomplete="off" />
                <x-error name="name"></x-error>
            </div>
        </div>

        <div class="form-group">
            <label for="parent_id">@lang('Parent')</label>
            <div>
                <select name="parent_id" id="parent_id" class="form-control @error('parent_id') is-invalid @enderror">
                    <option value=""></option>
                    @foreach ($parentOptions as $option)
                        <option value="{{ $option->id }}"
                            {{ $option->id === old('parent_id', $category->parent_id) ? 'selected' : '' }}>
                            {{ $option->name }}
                        </option>
                    @endforeach
                </select>
                <x-error name="parent_id"></x-error>
            </div>
        </div>

        <div class="form-group">
            <label for="pages">@lang('Pages')</label>
            <div>
                @foreach ($pageOptions as $option)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="pages[]" value="{{ $option->id }}"
                            id="page_id_{{ $option->id }}"
                            {{ old('pages', $category->pages->pluck('id'))->contains($option->id) ? 'checked' : '' }} />
                        <label class="form-check-label" for="page_id_{{ $option->id }}">
                            {{ $option->slug }}
                        </label>
                    </div>
                @endforeach
                <x-error name="pages"></x-error>
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
        <a href="{{ route('admin.dynamic-categories.index') }}" class="btn btn-link text-nowrap">
            @lang('Back')
        </a>
    </div>
@endsection

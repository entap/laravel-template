@extends(config('admin.view.layouts.default'))

@section('content')
    <form action="{{ route('admin.settings.menu.items.update', $item) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">@lang('validation.attributes.title')</label>
            <div>
                <input id="title" class="form-control @error('title') is-invalid @enderror" type="text" name="title"
                    value="{{ old('title', $item->title) }}" required autocomplete="off" />

                <x-error name="title"></x-error>
            </div>
        </div>

        <div class="form-group">
            <label for="uri">@lang('validation.attributes.uri')</label>
            <div>
                <input id="uri" class="form-control @error('uri') is-invalid @enderror" type="text" name="uri"
                    value="{{ old('uri', $item->uri) }}" autocomplete="off" />

                <x-error name="uri"></x-error>
            </div>
        </div>

        <div class="form-group">
            <label for="parent_id">@lang('validation.attributes.parent_id')</label>
            <div>
                <select name="parent_id" id="parent_id" class="form-control @error('parent_id') is-invalid @enderror">
                    <option value=""></option>
                    @foreach ($parentOptions as $option)
                        <option value="{{ $option->id }}"
                            {{ $option->id === old('parent_id', $item->parent_id) ? 'selected' : '' }}>
                            {{ $option->title }}
                        </option>
                    @endforeach
                </select>

                <x-error name="parent_id"></x-error>
            </div>
        </div>

        <div class="form-group mt-4 text-right">
            <button type="submit" class="btn btn-primary">
                @lang('Update')
            </button>
        </div>
    </form>
@endsection

@extends(config('admin.view.layouts.default'))

@section('content')
    <h1>@lang('user_segments.pages.edit')</h1>

    <form action="{{ route('admin.user-segments.update', $userSegment) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">@lang('user_segments.properties.name')</label>
            <div>
                <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name"
                    value="{{ old('name', $userSegment->name) }}" required autocomplete="off" />
                <x-error name="name"></x-error>
            </div>
        </div>

        <label>@lang('user_segments.properties.filter')</label>

        <pre class="small alert alert-secondary">{{ json_encode($userSegment->filter, JSON_PRETTY_PRINT) }}</pre>

        <div class="mt-4 text-right">
            <button type="submit" class="btn btn-primary">
                @lang('Update')
            </button>
        </div>
    </form>

    <hr>

    <div>
        <a href="{{ route('admin.user-segments.index') }}" class="btn btn-link">
            @lang('Back')
        </a>
    </div>
@endsection

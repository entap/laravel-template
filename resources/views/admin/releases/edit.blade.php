@extends(config('admin.view.layouts.default'))

@section('content')
    <h1>@lang('releases.pages.edit')</h1>

    <form action="{{ route('admin.packages.releases.update', [$package, $release]) }}" method="post">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="version">@lang('releases.properties.version')</label>
            <div>
                <input type="text" name="version" id="version" class="form-control @error('version') is-invalid @enderror"
                    value="{{ old('version', $release->version) }}" />

                <x-error name="version"></x-error>
            </div>
        </div>

        <div class="form-group">
            <label for="uri">@lang('releases.properties.uri')</label>
            <div>
                <input type="text" name="uri" id="uri" class="form-control @error('uri') is-invalid @enderror"
                    value="{{ old('uri', $release->uri) }}" />

                <x-error name="uri"></x-error>
            </div>
        </div>

        <div class="form-group">
            <label for="publish_date">@lang('releases.properties.publish_date')</label>
            <div>
                <input type="text" name="publish_date" id="publish_date"
                    class="form-control @error('publish_date') is-invalid @enderror"
                    value="{{ old('publish_date', $release->publish_date) }}" />

                <x-error name="publish_date"></x-error>
            </div>
        </div>


        <div class="form-group">
            <label for="expire_date">@lang('releases.properties.expire_date')</label>
            <div>
                <input type="text" name="expire_date" id="expire_date"
                    class="form-control @error('expire_date') is-invalid @enderror"
                    value="{{ old('expire_date', $release->expire_date) }}" />

                <x-error name="expire_date"></x-error>
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
        <a href="{{ route('admin.packages.show', $package) }}" class="btn btn-link">
            @lang('Back')
        </a>
    </div>
@endsection

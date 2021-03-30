@extends(config('admin.view.layouts.default'))

@section('content')
    <h1>@lang('packages.pages.edit')</h1>


    <form action="{{ route('admin.packages.update', $package) }}" method="post">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">@lang('packages.properties.name')</label>
            <div>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name', $package->name) }}" />

                <x-error name="name"></x-error>
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
        <a href="{{ route('admin.packages.index') }}" class="btn btn-link">
            @lang('Back')
        </a>
    </div>
@endsection

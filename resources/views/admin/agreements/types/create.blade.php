@extends(config('admin.view.layouts.default'))

@section('content')
    <h1>@lang('Add Agreement Type')</h1>

    <form action="{{ route('admin.agreement_types.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="slug">@lang('Slug')</label>
            <div>
                <input type="text" id="slug" class="form-control @error('slug') is-invalid @enderror" name="slug"
                    value="{{ old('slug') }}" required autocomplete="off" />
                    <x-error name="slug"></x-error>
            </div>
        </div>

        <div class="form-group">
            <label for="name">@lang('Name')</label>
            <div>
                <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name"
                    value="{{ old('name') }}" required autocomplete="off" />
                    <x-error name="name"></x-error>
            </div>
        </div>

        <div class="form-group">
            <div>
                <div class="form-check">
                    <input type="checkbox" name="confirmation_mode" value="strict" id="confirmation_mode"
                        class="form-check-input" />
                    <label class="form-check-label" for="confirmation_mode">
                        新しい契約を追加したら改めて同意を求める
                    </label>
                </div>
                <x-error name="confirmation_mode"></x-error>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary text-nowrap">
                @lang('Create')
            </button>
        </div>
    </form>

    <hr>

    <div>
        <a href="{{ route('admin.agreement_types.index') }}" class="btn btn-link text-nowrap">
            @lang('Back')
        </a>
    </div>
@endsection

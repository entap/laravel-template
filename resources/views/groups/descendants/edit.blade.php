@extends('layouts.app')

@section('content')
    <form action="{{ route('groups.descendants.update', [$group, $descendant]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">@lang('validation.attributes.name')</label>
            <div>
                <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name"
                    value="{{ old('name', $descendant->name) }}" autocomplete="off" required />
                <x-error name="name"></x-error>
            </div>
        </div>

        <div class="form-group text-right">
            <button type="submit" class="btn btn-primary text-nowrap">
                @lang('Update')
            </button>
        </div>
    </form>

    <hr>

    <a href="{{ route('groups.descendants.index', $group) }}" class="btn btn-link text-nowrap">
        @lang('Back')
    </a>
@endsection

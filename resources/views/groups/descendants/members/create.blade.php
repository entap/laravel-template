@extends('layouts.ladybird')

@section('content')
    <form action="{{ route('groups.descendants.members.store', [$group, $descendant]) }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="member_id">@lang('validation.attributes.member_id')</label>
            <div>
                <select name="member_id" id="member_id" class="form-control @error('member_id') is-invalid @enderror">
                    @foreach ($memberOptions as $option)
                        <option value="{{ $option->id }}" {{ $option->id === old('member_id', '') ? 'selected' : '' }}>
                            {{ $option->name }}
                        </option>
                    @endforeach
                </select>
                @error('member_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group text-right">
            <button type="submit" class="btn btn-primary text-nowrap">
                @lang('Add Member')
            </button>
        </div>
    </form>

    <hr>

    <a href="{{ route('groups.descendants.show', [$group, $descendant]) }}" class="btn btn-link text-nowrap">
        @lang('Back')
    </a>
@endsection

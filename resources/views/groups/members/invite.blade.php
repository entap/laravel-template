@extends('layouts.app')

@section('content')
    <form action="{{ route('groups.members.create', $group->id) }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="email">@lang('validation.attributes.email')</label>
            <div>
                <input type="text" id="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" autocomplete="off" required />
                <x-error name="email"></x-error>
            </div>
        </div>

        <div class="form-group">
            <label for="role">@lang('validation.attributes.role')</label>
            <div>
                <select name="role" id="role" class="form-control @error('role') is-invalid @enderror">
                    @foreach ($roleOptions as $option)
                        <option value="{{ $option }}" {{ $option === old('role') ? 'selected' : '' }}>
                            {{ $option }}
                        </option>
                    @endforeach
                </select>
                @error('role')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary text-nowrap">
                @lang('Invite')
            </button>
        </div>
    </form>
@endsection

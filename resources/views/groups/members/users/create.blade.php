@extends('layouts.ladybird')

@section('content')
    @if (session('message'))
        <div class="alert alert-info">
            {{ session('message') }}
        </div>
    @endif

    <form action="{{ route('groups.users.store', $group) }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">@lang('validation.attributes.name')</label>
            <div>
                <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name"
                    value="{{ old('name') }}" autocomplete="off" required />
                <x-error name="name"></x-error>
            </div>
        </div>

        <div class="form-group">
            <label for="email">@lang('validation.attributes.email')</label>
            <div>
                <input type="text" id="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email', $email) }}" autocomplete="off" required />
                <x-error name="email"></x-error>
            </div>
        </div>

        <div class="form-group">
            <label for="password">@lang('validation.attributes.password')</label>
            <div>
                <input type="password" id="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" value="{{ old('password') }}" autocomplete="new-password" required />
                <x-error name="password"></x-error>
            </div>
        </div>

        <div class="form-group">
            <label for="password_confirmation">@lang('validation.attributes.password_confirmation')</label>
            <div>
                <input type="password" id="password_confirmation"
                    class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation"
                    value="{{ old('password_confirmation') }}" required />
                <x-error name="password_confirmation"></x-error>
            </div>
        </div>

        <div class="form-group">
            <label for="role">@lang('validation.attributes.role')</label>
            <div>
                <select name="role" id="role" class="form-control @error('role') is-invalid @enderror">
                    @foreach ($roleOptions as $option)
                        <option value="{{ $option }}" {{ $option === old('role', $role) ? 'selected' : '' }}>
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

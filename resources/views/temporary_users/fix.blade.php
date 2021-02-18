@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-sm-6">
            <form action="{{ route('temporary-users.fix', $rejectedTemporaryUser) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">@lang('temporary_users.properties.name')</label>
                    <div>
                        <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name"
                            value="{{ old('name', $temporaryUser->name) }}" autocomplete="off" />

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">@lang('temporary_users.properties.email')</label>
                    <div>
                        <input type="text" id="email" class="form-control @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email', $temporaryUser->email) }}" required autocomplete="off" />

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary text-nowrap">
                        @lang('Fix')
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

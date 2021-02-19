@extends(config('admin.view.layouts.default'))

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">@lang('Suspend :user.', ['user' =>
                            $user->name ?? "User {$user->id}" ])</div>

                        <form action="{{ route('admin.users.suspend', $user) }}" method="POST" class="mt-4">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="suspending_reason">@lang('validation.attributes.suspending_reason')</label>
                                <div>
                                    <textarea id="suspending_reason"
                                        class="form-control @error('suspending_reason') is-invalid @enderror"
                                        name="suspending_reason">{{ old('suspending_reason') }}</textarea>

                                    @error('suspending_reason')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-danger">
                                    @lang('Suspend')
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <hr>

                <div>
                    <a href="{{ route('admin.users.show', $user) }}" class="btn btn-link">
                        @lang('Back')
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

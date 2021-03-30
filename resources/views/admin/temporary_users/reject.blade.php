@extends(config('admin.view.layouts.default'))

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-5">
                <h1>@lang('Reject User')</h1>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.temporary-users.reject', $temporaryUser) }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="reason">@lang('validation.attributes.reason')</label>
                                <div>
                                    <textarea id="reason" class="form-control @error('reason') is-invalid @enderror"
                                        name="reason" placeholder="名前の入力が漏れています。（任意）">{{ old('reason') }}</textarea>

                                    @error('reason')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-danger">
                                    @lang('admin/actions.reject')
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <hr>

                <div>
                    <a href="{{ route('admin.temporary-users.index') }}" class="btn btn-link">
                        @lang('Back')
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

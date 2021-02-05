@extends(config('admin.view.layouts.default'))

@section('content')
    <h1>@lang('Users')</h1>

    <div>
        <div class="text-right">
            <a class="btn btn-link" data-toggle="collapse" href="#searchbox" role="button" aria-expanded="false"
                aria-controls="searchbox">
                @lang('Advanced Search')
            </a>
            <a href="{{ route('admin.users.index') }}" class="btn btn-link">
                @lang('Clear Condition')
            </a>
        </div>
        <div class="collapse" id="searchbox">
            <div class="card card-body mb-4">
                <form>
                    <div class="form-group">
                        <label for="id">@lang('ID')</label>
                        <div>
                            <input type="text" id="id" class="form-control" name="id"
                                value="{{ request()->input('id', '') }}" autocomplete="off" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">@lang('Name')</label>
                        <div>
                            <input type="text" id="name" class="form-control" name="name"
                                value="{{ request()->input('name', '') }}" autocomplete="off" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">@lang('E-mail')</label>
                        <div>
                            <input type="text" id="email" class="form-control" name="email"
                                value="{{ request()->input('email', '') }}" autocomplete="off" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="start_created_at">@lang('Start created at')</label>
                        <div>
                            <input type="datetime-local" id="start_created_at" class="form-control" name="start_created_at"
                                value="{{ request()->input('start_created_at', '') }}" autocomplete="off" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="stop_created_at">@lang('Stop created at')</label>
                        <div>
                            <input type="datetime-local" id="stop_created_at" class="form-control" name="stop_created_at"
                                value="{{ request()->input('stop_created_at', '') }}" autocomplete="off" />
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">
                            @lang('Search')
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if (count($users))
        <div class="d-flex justify-content-center">
            {{ $users->withQueryString()->links() }}
        </div>

        <table class="table mt-4">
            <thead>
                <tr>
                    <th>@lang('ID')</th>
                    <th>@lang('Name')</th>
                    <th>@lang('Email')</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $users->withQueryString()->links('') }}
        </div>
    @else
        <div class="mt-4">@lang('No User.')</div>
    @endif
@endsection

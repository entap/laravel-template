@extends(config('admin.view.layouts.default'))

@section('content')
    <h1>{{ __('Users') }}</h1>

    <div>
        <div class="text-right">
            <a class="btn btn-link" data-toggle="collapse" href="#searchbox" role="button" aria-expanded="false"
                aria-controls="searchbox">
                詳細検索
            </a>
            <a href="{{ route('admin.users.index') }}" class="btn btn-link">
                検索クリア
            </a>
        </div>
        <div class="collapse" id="searchbox">
            <div class="card card-body mb-4">
                <form>
                    <div class="form-group">
                        <label for="name">{{ __('Name') }}</label>
                        <div>
                            <input type="text" id="name" class="form-control" name="name"
                                value="{{ request()->input('name', '') }}" autocomplete="off" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">{{ __('E-mail') }}</label>
                        <div>
                            <input type="text" id="email" class="form-control" name="email"
                                value="{{ request()->input('email', '') }}" autocomplete="off" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="start_created_at">{{ __('Start created at') }}</label>
                        <div>
                            <input type="datetime-local" id="start_created_at" class="form-control" name="start_created_at"
                                value="{{ request()->input('start_created_at', '') }}" autocomplete="off" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="stop_created_at">{{ __('Stop created at') }}</label>
                        <div>
                            <input type="datetime-local" id="stop_created_at" class="form-control" name="stop_created_at"
                                value="{{ request()->input('stop_created_at', '') }}" autocomplete="off" />
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Search') }}
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
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Email') }}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $users->withQueryString()->links() }}
        </div>
    @else
        <div class="mt-4">{{ __('No User.') }}</div>
    @endif
@endsection

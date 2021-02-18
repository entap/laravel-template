@extends(config('admin.view.layouts.default'))

@section('content')
    <h1>@lang('entities.users.title')</h1>

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
        <div class="collapse mt-3" id="searchbox">
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
                        <label for="name">@lang('entities.users.properties.name')</label>
                        <div>
                            <input type="text" id="name" class="form-control" name="name"
                                value="{{ request()->input('name', '') }}" autocomplete="off" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">@lang('entities.users.properties.email')</label>
                        <div>
                            <input type="text" id="email" class="form-control" name="email"
                                value="{{ request()->input('email', '') }}" autocomplete="off" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="start_created_at">@lang('validation.attributes.start_created_at')</label>
                        <div>
                            <input type="datetime-local" id="start_created_at" class="form-control" name="start_created_at"
                                value="{{ request()->input('start_created_at', '') }}" autocomplete="off" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="end_created_at">@lang('validation.attributes.end_created_at')</label>
                        <div>
                            <input type="datetime-local" id="end_created_at" class="form-control" name="end_created_at"
                                value="{{ request()->input('end_created_at', '') }}" autocomplete="off" />
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">
                            @lang('Search')
                        </button>

                        <input type="submit" name="saves_user_segment" value="@lang('Save User Segment')"
                            class="btn btn-link" />
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if (count($users))
        <div class="d-flex justify-content-center">
            {{ $users->withQueryString()->links() }}
        </div>

        <table class="table mt-3">
            <thead>
                <tr>
                    <th>@lang('ID')</th>
                    <th>@lang('entities.users.properties.name')</th>
                    <th>@lang('entities.users.properties.email')</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <a href="{{ route('admin.users.show', $user) }}" class="btn btn-sm btn-link">
                                @lang('Show')
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $users->withQueryString()->links() }}
        </div>
    @else
        <div class="mt-4">@lang('No User.')</div>
    @endif
@endsection

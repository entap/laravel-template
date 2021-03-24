@extends(config('admin.view.layouts.default'))

@section('content')
    <h1>@lang('admin::user_groups.title')</h1>

    <div class="text-right">
        <a class="btn btn-link" data-toggle="collapse" href="#searchbox" role="button" aria-expanded="false"
            aria-controls="searchbox">
            @lang('Advanced Search')
        </a>

        <a href="{{ route('admin.settings.user-groups.create') }}" class="btn btn-primary ml-2">
            @lang('admin::user_groups.actions.create')
        </a>
    </div>

    <div class="collapse mt-3" id="searchbox">
        <div class="row justify-content-end">
            <div class="col-sm-6">
                <div class="card card-body">
                    @include('admin::user_groups._searchbox')
                </div>
            </div>
        </div>
    </div>

    @if (request()->has('search'))
        <div class="text-right mt-3">
            <a href="{{ route('admin.settings.user-groups.index') }}" class="btn btn-link ml-2">
                @lang('Clear Condition')
            </a>
        </div>
    @endif

    <table class="table mt-4">
        <thead>
            <tr>
                <th>@lang('admin::user_groups.properties.name')</th>
                <th>@lang('admin::user_groups.properties.users')</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($groups as $group)
                <tr>
                    <td>{{ str_repeat('——', $group->depth) . ' ' . $group->name }}</td>
                    <td>{{ $group->users()->count() }}</td>
                    <td>
                        <a href="{{ route('admin.settings.user-groups.edit', $group) }}"
                            class="btn btn-sm btn-primary text-nowrap">
                            @lang('Edit')
                        </a>
                    </td>
                    <td>
                        <form action="{{ route('admin.settings.user-groups.destroy', $group) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-sm btn-danger text-nowrap"
                                onclick="return confirm('@lang('admin::messages.confirmations.delete')')">
                                @lang('Delete')
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@extends(config('admin.view.layouts.default'))

@section('content')
    <h1>@lang('Agreement Type')</h1>
    <h3>{{ $type->slug }}</h3>

    <h5>@lang('Name')</h5>
    <p>{{ $type->name }}</p>

    <h5>@lang('Agreements')</h5>

    <div class="text-right">
        <a href="{{ route('admin.agreement_types.agreements.create', $type) }}" class="btn btn-primary text-nowrap">
            @lang('Add Agreement')
        </a>
    </div>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>@lang('Name')</th>
                <th>@lang('Description')</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($agreements as $agreement)
                <tr>
                    <td>{{ $agreement->name }}</td>
                    <td>{{ $agreement->description }}</td>
                    <td>
                        <form action="{{ route('admin.agreement_types.agreements.destroy', [$type, $agreement]) }}"
                            method="POST">
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

    <hr>

    <div>
        <a href="{{ route('admin.agreement_types.index') }}" class="btn btn-link text-nowrap">
            @lang('Back')
        </a>
    </div>
@endsection

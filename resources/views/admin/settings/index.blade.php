@extends(config('admin.view.layouts.default'))

@section('content')
    <h1>@lang('Settings')</h1>

    <ul class="nav nav-pills">
        <li class="nav-item">
            <a href="#" class="nav-link active">
                @lang('No Group')
            </a>
        </li>
        @foreach ($groups as $group)
            <li class="nav-item">
                <a href="{{ route('admin.settings.groups.show', $group) }}" class="nav-link">
                    {{ $group->name }}
                </a>
            </li>
        @endforeach
    </ul>

    <div class="text-right">
        <a href="{{ route('admin.settings.properties.create') }}" class="btn btn-primary">
            @lang('Add Property')
        </a>
        <a href="{{ route('admin.settings.groups.create') }}" class="btn btn-primary">
            @lang('Add Group')
        </a>
    </div>

    <table class="table mt-4">
        <thead>
            <tr>
                <th class="col-8">{{ __('Name') }}</th>
                <th class="col-2">{{ __('Values') }}</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($independentProperties as $property)
                <tr>
                    <td>{{ $property->display_name }} ({{ $property->name }})</td>
                    <td>{{ $property->values->pluck('value') }}</td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

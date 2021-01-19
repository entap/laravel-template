@extends(config('admin.view.layouts.default'))

@section('content')
    <h1>@lang('Settings')</h1>

    <ul class="nav nav-pills">
        <li class="nav-item">
            <a href="{{ route('admin.settings.index') }}" class="nav-link">
                @lang('No Group')
            </a>
        </li>
        @foreach ($groups as $g)
            <li class="nav-item">
                <a href="{{ route('admin.settings.groups.show', $g) }}" class="nav-link @if ($g->id
                    === $group->id) active @endif">
                    {{ $g->name }}
                </a>
            </li>
        @endforeach
    </ul>

    <div class="text-right">
        <a href="{{ route('admin.settings.groups.properties.create', $group) }}" class="btn btn-primary">
            @lang('Add Property')
        </a>
        <a href="{{ route('admin.settings.groups.create') }}" class="btn btn-primary">
            @lang('Add Group')
        </a>
    </div>

    <p class="small text-secondary">{{ $group->description }}</p>

    <table class="table mt-4">
        <thead>
            <tr>
                <th class="col-8">{{ __('Name') }}</th>
                <th class="col-2">{{ __('Values') }}</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($group->properties as $property)
                <tr>
                    <td>{{ $property->display_name }} ({{ $property->name }})</td>
                    <td>{{ $property->values->pluck('value') }}</td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

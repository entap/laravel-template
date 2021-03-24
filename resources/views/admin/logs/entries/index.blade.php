@extends(config('admin.view.layouts.default'))

@section('content')
    <h3>{{ $tableName }}</h3>

    @if (count($entries))
        <div class="d-flex justify-content-center">
            {{ $entries->withQueryString()->links() }}
        </div>

        <table class="table">
            <thead>
                <tr>
                    @foreach ($columns as $column)
                        <th>
                            {{ $column->getComment() ?? Str::title(str_replace('_', ' ', $column->getName())) }}
                        </th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($entries as $entry)
                    <tr>
                        @foreach ($columns as $column)
                            <td>
                                {{ $entry->{$column->getName()} }}
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $entries->withQueryString()->links() }}
        </div>
    @else
        <div>{{ __('No Entry') }}</div>
    @endif

    <div>
        <a href="{{ route('admin.logs.index') }}" class="btn btn-link text-nowrap">
            {{ __('Back') }}
        </a>
    </div>
@endsection

@extends(config('admin.view.layouts.default'))

@section('content')
    <h1>@lang('user_segments.title')</h1>

    @empty($userSegments->count())
        <p>@lang('messages.missing', ['entity' => __('user_segments.title')])</p>
    @else
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>@lang('user_segments.properties.name')</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($userSegments as $segment)
                    <tr>
                        <td>{{ $segment->name }}</td>
                        <td>
                            <a href="{{ route('admin.user-segments.show', $segment) }}" class="btn btn-sm btn-link">
                                @lang('Search')
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('admin.user-segments.edit', $segment) }}" class="btn btn-sm btn-primary">
                                @lang('Edit')
                            </a>
                        </td>
                        <td>
                            <form action="{{ route('admin.user-segments.destroy', $segment) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-sm btn-danger text-nowrap"
                                    onclick="return confirm('@lang('admin::messages.confirmations.delete')')">
                                    {{ __('Delete') }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $userSegments->withQueryString()->links() }}
        </div>
    @endempty
@endsection

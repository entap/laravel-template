@extends(config('admin.view.layouts.default'))

@section('content')
    <h1>{{ __('Users') }}</h1>

    @if (count($users))
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
    @else
        <div class="mt-4">{{ __('No User.') }}</div>
    @endif
@endsection

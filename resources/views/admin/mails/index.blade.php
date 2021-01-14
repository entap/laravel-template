@extends(config('admin.view.layouts.default'))

@section('content')
    <h1>{{ __('Mail Templates') }}</h1>

    @if (count($mails))
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>{{ __('Title') }}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mails as $mail)
                    <tr>
                        <td>{{ $mail->title }}</td>
                        <td></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $mails->withQueryString()->links() }}
        </div>
    @else
        <div class="mt-4">{{ __('No User.') }}</div>
    @endif
@endsection

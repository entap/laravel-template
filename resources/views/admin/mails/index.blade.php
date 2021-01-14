@extends(config('admin.view.layouts.default'))

@section('content')
    <h1>{{ __('Mail Templates') }}</h1>

    <div class="text-right">
        <a href="{{ route('admin.mails.create') }}" class="btn btn-primary">
            {{ __('Add Mail Template') }}
        </a>
    </div>

    @if (count($mails))
        <table class="table mt-4">
            <thead>
                <tr>
                    <th class="col-2">{{ __('Type') }}</th>
                    <th class="col-8">{{ __('Title') }}</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mails as $mail)
                    <tr>
                        <td>{{ $mail->type->name }}</td>
                        <td>{{ $mail->title }}</td>
                        <td>
                            <a href="{{ route('admin.mails.edit', $mail) }}" class="btn btn-primary">
                                {{ __('Edit') }}
                            </a>
                        </td>
                        <td>
                            <form action="{{ route('admin.mails.destroy', $mail) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('{{ __('Are you sure you want to delete?') }}')">
                                    {{ __('Delete') }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $mails->withQueryString()->links() }}
        </div>
    @else
        <div class="mt-4">{{ __('No Mail Template.') }}</div>
    @endif
@endsection

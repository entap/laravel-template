@extends(config('admin.view.layouts.default'))

@section('content')
    <h1>@lang('admin::mails.title')</h1>

    <div class="text-right">
        <a href="{{ route('admin.mails.create') }}" class="btn btn-primary">
            @lang('admin::mails.actions.create')
        </a>
    </div>

    @if (count($mails))
        <table class="table mt-4">
            <thead>
                <tr>
                    <th class="col-8 text-nowrap">@lang('admin::mails.properties.title')</th>
                    <th class="col-2 text-nowrap">@lang('admin::mails.properties.status')</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mails as $mail)
                    <tr>
                        <td>{{ $mail->title }}</td>
                        <td>{{ __('mail.status.' . $mail->status) }}</td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('admin.mails.edit', $mail) }}"
                                    class="btn btn-sm btn-primary text-nowrap">
                                    @lang('Edit')
                                </a>
                                <form action="{{ route('admin.mails.duplicate', $mail) }}" method="POST" class="ml-2">
                                    @csrf

                                    <button type="submit" class="btn btn-sm btn-info text-nowrap">
                                        @lang('Duplicate')
                                    </button>
                                </form>
                                <form action="{{ route('admin.mails.destroy', $mail) }}" method="POST" class="ml-2">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-sm btn-danger text-nowrap"
                                        onclick="return confirm('@lang('admin::messages.confirmations.delete')')">
                                        @lang('Delete')
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $mails->withQueryString()->links('pagination::bootstrap-4') }}
        </div>
    @else
        <div class="mt-4">@lang('No Mail Template.')</div>
    @endif
@endsection

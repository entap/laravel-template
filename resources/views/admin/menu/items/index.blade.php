@extends('admin::layouts.sidebar')

@section('content')
    <div class="text-right">
        <a href="{{ route('admin.menu.items.create') }}" class="btn btn-link text-nowrap">
            <span>+</span> <span>{{ __('Add Menu Item') }}</span>
        </a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>{{ __('Title') }}</th>
                <th>{{ __('URL') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->uri }}</td>
                    <td>
                        <a href="{{ route('admin.menu.items.edit', $item) }}" class="btn btn-link text-nowrap">
                            {{ __('Edit') }}
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

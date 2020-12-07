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
                    <td>
                        <form method="POST" action="{{ route('admin.menu.items.destroy', $item) }}">
                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger"
                                onclick="return confirm('{{ __('Are you sure you want to delete?') }}')">
                                {{ __('Delete') }}
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

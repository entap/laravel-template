@extends('layouts.app')

@section('content')
    <div class="text-right">
        <a href="{{ route('groups.members.create', $group) }}" class="btn btn-primary text-nowrap">
            @lang('Invite')
        </a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>@lang('Name')</th>
                <th>@lang('E-mail')</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($members as $member)
                <tr>
                    <td>{{ $member->name }}</td>
                    <td>{{ $member->email }}</td>
                    <td>
                        <form action="{{ route('groups.members.destroy', [$group, $member]) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger text-nowrap"
                                onclick="return confirm('@lang('Are you sure you want to delete?')')">
                                @lang('Delete')
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

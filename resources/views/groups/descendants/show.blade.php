@extends('layouts.app')

@section('content')
    <p>{{ $group->name }}</p>
    <p>{{ $descendant->name }}</p>

    <table class="table">
        <thead>
            <tr>
                <th class="col">@lang('Name')</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($members as $member)
                <tr>
                    <td>{{ $member->name }}</td>
                    <td>
                        <form action="{{ route('groups.descendants.members.destroy', [$group, $descendant, $member]) }}"
                            method="POST">
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

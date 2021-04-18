@extends('layouts.app')

@section('content')
    <p>{{ $group->name }}</p>
    <p>{{ $descendant->name }}</p>

    <table class="table">
        <thead>
            <tr>
                <th>@lang('Name')</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($members as $member)
                <tr>
                    <td>{{ $member->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

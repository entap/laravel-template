@extends('layouts.app')

@section('content')
    <h1>{{ $group->name }}</h1>

    <a href="{{ route('groups.descendants.index', $group) }}" class="btn btn-link">
        @lang('Groups')
    </a>

    <a href="{{ route('groups.members.index', $group) }}" class="btn btn-link">
        @lang('Members')
    </a>
@endsection

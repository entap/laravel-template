@extends('layouts.app')

@section('content')
    <div class="list-group">
        @foreach ($groups as $group)
            <a href="{{ route('groups.show', $group) }}" class="list-group-item list-group-item-action">
                {{ $group->name }}
            </a>
        @endforeach
    </div>
@endsection

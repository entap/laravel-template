@extends('layouts.app')

@section('content')
    {{-- <div class="text-right">
        <a href="{{ route('groups.descendants.create', $group) }}" class="btn btn-primary text-nowrap">
            @lang('Create')
        </a>
    </div> --}}

    <ul class="list-group">
        @foreach ($members as $member)
            <li class="list-group-item d-flex">
                <div class="flex-grow-1">
                    {{ $member->name }}
                </div>
            </li>
        @endforeach
    </ul>
@endsection

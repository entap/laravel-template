@extends('layouts.ladybird')

@section('content')
    <div class="text-right">
        <a href="{{ route('groups.descendants.create', $group) }}" class="btn btn-primary text-nowrap">
            @lang('Create')
        </a>
    </div>

    <div>
        <div class="group-title">
            {{ $group->name }}
        </div>

        <ul>
            @foreach ($group->descendants->toTree() as $child)
                <li class="pt-1">
                    @include('groups.descendants._group', ['root' => $group, 'group' => $child])
                </li>
            @endforeach
        </ul>
    </div>
@endsection

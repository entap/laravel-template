@extends('layouts.ladybird')

@section('content')
    <div class="text-right">
        <a href="{{ route('groups.descendants.create', $group) }}" class="btn btn-primary text-nowrap">
            @lang('Create')
        </a>
    </div>

    <ul class="list-group list-group-nested">
        <li class="list-group-item">
            <div class="group-title">
                {{ $group->name }}
            </div>

            @if ($group->descendants->count())
                <ul class="list-group">
                    @foreach ($group->descendants->toTree() as $child)
                        <li class="list-group-item">
                            @include('groups.descendants._group', ['root' => $group, 'group' => $child])
                        </li>
                    @endforeach
                </ul>
            @endif
        </li>
    </ul>
@endsection

@extends('layouts.app')

@section('content')
    <div>
        <div class="group-title">
            {{ $group->name }}
        </div>

        <ul>
            @foreach ($group->descendants->toTree() as $child)
                <li>
                    @include('groups._group', ['group' => $child])
                </li>
            @endforeach
        </ul>
    </div>
@endsection

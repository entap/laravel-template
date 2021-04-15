<div>
    <div class="d-flex">
        <div class="flex-grow-1">
            {{ $group->name }}
        </div>

        <div>
            <a href="{{ route('groups.descendants.edit', [$root, $child]) }}">
                @lang('Edit')
            </a>
        </div>
    </div>

    <ul>
        @foreach ($group->children as $child)
            <li>
                @include('groups.descendants._group', ['root' => $root, 'group' => $child])
            </li>
        @endforeach
    </ul>
</div>

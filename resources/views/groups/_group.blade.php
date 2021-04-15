<div>
    <div class="group-title">
        {{ $group->name }}
    </div>

    <ul class="group-children">
        @foreach ($group->children as $child)
            <li>
                @include('groups._group', ['group' => $child])
            </li>
        @endforeach
    </ul>
</div>

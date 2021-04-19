<div>
    <div class="d-flex">
        <div class="flex-grow-1">
            {{ $group->name }}
        </div>

        <div class="ml-1">
            <a href="{{ route('groups.descendants.show', [$root, $group]) }}" class="btn btn-sm btn-link text-nowrap">
                @lang('Show')
            </a>
        </div>

        <div class="ml-1">
            <a href="{{ route('groups.descendants.edit', [$root, $group]) }}"
                class="btn btn-sm btn-primary text-nowrap">
                @lang('Edit')
            </a>
        </div>

        <form action="{{ route('groups.descendants.destroy', [$root, $group]) }}" method="POST" class="ml-1">
            @csrf
            @method('DELETE')

            <button type="submit" class="btn btn-sm btn-danger text-nowrap"
                onclick="return confirm('@lang('Are you sure you want to delete?')')">
                @lang('Delete')
            </button>
        </form>
    </div>

    @if ($group->children->count())
        <ul class="list-group">
            @foreach ($group->children as $child)
                <li class="list-group-item">
                    @include('groups.descendants._group', ['root' => $root, 'group' => $child])
                </li>
            @endforeach
        </ul>
    @endif
</div>

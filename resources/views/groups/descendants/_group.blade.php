<div>
    <div class="d-flex">
        <div class="flex-grow-1">
            {{ $group->name }}
        </div>

        <div class="ml-1">
            <a href="{{ route('groups.descendants.edit', [$root, $group]) }}" class="btn btn-primary text-nowrap">
                @lang('Edit')
            </a>
        </div>

        <form action="{{ route('groups.descendants.destroy', [$root, $group]) }}" method="POST" class="ml-1">
            @csrf
            @method('DELETE')

            <button type="submit" class="btn btn-danger text-nowrap"
                onclick="return confirm('@lang('Are you sure you want to delete?')')">
                @lang('Delete')
            </button>
        </form>
    </div>

    <ul>
        @foreach ($group->children as $child)
            <li class="pt-1">
                @include('groups.descendants._group', ['root' => $root, 'group' => $child])
            </li>
        @endforeach
    </ul>
</div>

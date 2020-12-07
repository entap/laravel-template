<nav class="nav flex-column">
    @foreach (App\Models\MenuItem::all() as $item)
        <a href="{{ $item->uri }}" class="nav-link">
            {{ $item->title }}
        </a>
    @endforeach
</nav>

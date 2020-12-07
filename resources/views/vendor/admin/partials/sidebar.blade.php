<nav class="nav flex-column">
    @foreach (App\Models\MenuItem::all()->sortBy('order', SORT_NATURAL) as $item)
        <a href="{{ $item->uri ?? '#' }}" class="nav-item nav-link {{ $item->uri ? '' : 'disabled' }}">
            {{ $item->title }}
        </a>
    @endforeach
</nav>

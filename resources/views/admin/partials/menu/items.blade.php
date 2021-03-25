@foreach (Admin::menu() as $item)
    @if ($item->uri)
        <a href="{{ $item->uri }}" class="nav-item nav-link">
            {{ $item->title }}
        </a>
    @else
        @if ($item->children->count() > 0)
            @php
                $dropdownId = 'dropdown_' . Str::uuid();
            @endphp
            <li class="nav-item dropdown">
                <a id="{{ $dropdownId }}" class="nav-link dropdown-toggle" href="#" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ $item->title }}
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="{{ $dropdownId }}">
                    @foreach ($item->children as $childItem)
                        <a href="{{ $childItem->uri ?? '#' }}"
                            class="dropdown-item {{ $childItem->uri ? '' : 'disabled' }}">
                            {{ $childItem->title }}
                        </a>
                    @endforeach
                </div>
            </li>
        @else
            <a href="#" class="nav-item nav-link disabled">
                {{ $item->title }}
            </a>
        @endif
    @endif
@endforeach

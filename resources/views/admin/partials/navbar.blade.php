<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm fixed-top">
    <div class="container">
        @include('admin.partials.brand')
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="@lang('Toggle navigation')">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                @include('admin.partials.menu.items')
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest('admin')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.login') }}" dusk="nav-login">@lang('Login')</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a id="settingsDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            @lang('Admin Settings')
                        </a>

                        @include('admin.partials.menu.settings')
                    </li>

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Admin::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('admin.logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                @lang('Logout')
                            </a>

                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>

                    <form class="form-inline">
                        <div class="btn-group">
                            <button type="button" class="btn btn-outline-primary" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                Notifications
                                <span class="badge badge-light">{{ Admin::unreadNotificationsCount() }}</span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right p-4">
                                @forelse (Admin::notifications() as $notification)
                                    <div>{{ $notification->type }}</div>
                                    <div>{{ $notification->data['message'] }}</div>
                                @empty
                                    No notification.
                                @endforelse
                            </div>
                        </div>
                    </form>
                @endguest
            </ul>
        </div>
    </div>
</nav>

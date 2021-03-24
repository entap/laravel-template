<div class="dropdown-menu dropdown-menu-right" aria-labelledby="settingsDropdown">
    <a href="{{ route('admin.settings.users.index') }}" class="dropdown-item">
        @lang('admin::users.title')
    </a>
    <a href="{{ route('admin.settings.roles.index') }}" class="dropdown-item">
        @lang('admin::roles.title')
    </a>
    <a href="{{ route('admin.settings.user-groups.index') }}" class="dropdown-item">
        @lang('admin::user_groups.title')
    </a>
    <div class="dropdown-divider"></div>
    <a href="{{ route('admin.settings.menu.items.index') }}" class="dropdown-item">
        @lang('admin::menu_items.title')
    </a>
    <a href="{{ route('admin.mails.index') }}" class="dropdown-item">
        @lang('admin::mails.title')
    </a>
</div>

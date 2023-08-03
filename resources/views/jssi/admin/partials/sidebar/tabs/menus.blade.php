<li class="nav-item {{ request()->is('jssi/admin/menus/menus*') ? 'menu-open' : '' }}">
    <a href="{{ route('menus.index') }}"
        class="nav-link {{ request()->is('jssi/admin/menus/menus*') ? 'active ' : '' }}">
        <i class="nav-icon fa-solid fa-bars"></i>
        <p>
            {{ __('Menus') }}
        </p>
    </a>
</li>
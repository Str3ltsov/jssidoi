<li class="nav-item">
    <a href="{{ route('menus.index') }}" class="nav-link {{ request()->is('jssi/admin/content') ? 'active ' : '' }}">
        <i class="nav-icon fa-solid"></i>
        <p>
            {{ __('List') }}
        </p>
    </a>
</li>

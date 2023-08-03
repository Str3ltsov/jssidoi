<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-header">Menu</li>
        <li class="nav-item">
            <a href="/jssi/admin" class="nav-link {{ request()->routeIs('jssi.admin.home') ? 'active' : '' }}">
                <i class="nav-icon fa fa-house"></i>
                <p>
                    Home
                </p>
            </a>
        </li>
        <li class="nav-item {{ str_starts_with(request()->path(), 'jssi/admin/menus') ? 'menu-open' : '' }}">
            <a href="#"
                class="nav-link {{ str_starts_with(request()->path(), 'jssi/admin/menus') ? 'active' : '' }}">
                <i class="nav-icon fa-solid fa-list"></i>
                <p>
                    Menus
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                @include('jssi.admin.partials.sidebar.tabs.menus')
            </ul>
        </li>
        <li class="nav-item {{ str_starts_with(request()->path(), 'jssi/admin/papers') ? 'menu-open' : '' }}">
            <a href="#"
                class="nav-link {{ str_starts_with(request()->path(), 'jssi/admin/papers') ? 'active' : '' }}">
                <i class="nav-icon fas fa-file"></i>
                <p>
                    Papers
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                @include('jssi.admin.partials.sidebar.tabs.papers')
            </ul>
        </li>
</nav>

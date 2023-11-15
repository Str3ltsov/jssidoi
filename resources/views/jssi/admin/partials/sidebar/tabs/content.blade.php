@can('users.update')
    <li class="nav-item">
        <a href="{{ route('admin.pages.index') }}"
            class="nav-link {{ request()->is('jssi/admin/content/*') ? 'active ' : '' }}">
            <i class="nav-icon fa-solid fa-file-lines"></i>
            <p>
                {{ __('Pages') }}
            </p>
        </a>
    </li>
@endcan

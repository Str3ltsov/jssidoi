<li class="nav-item">
    <a href="{{ route('menus.index') }}" class="nav-link {{ request()->is('jssi/admin/menus/menus') ? 'active ' : '' }}">
        <i class="nav-icon fa-solid fa-bars-staggered"></i>
        <p>
            {{ __('Menus') }}
        </p>
    </a>
</li>
@foreach (\App\Models\JssiMenu::select('id', 'title', 'alias')->get() as $menuItem)
    <li class="nav-item">
        <a href="{{ route('menus.show', $menuItem->id) }}"
            class="nav-link {{ request()->is('jssi/admin/menus/menus/' . $menuItem->id) ? 'active ' : '' }}">
            <i class="nav-icon fa-solid fa-bars-staggered"></i>
            <p>
                {{ $menuItem->title }}
            </p>
        </a>
    </li>
@endforeach

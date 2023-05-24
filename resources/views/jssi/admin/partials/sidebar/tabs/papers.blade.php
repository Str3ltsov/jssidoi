@php
    $categories = [
        [
            'name' => 'Issues',
            'route' => 'jssi.admin.issues',
            'icon' => 'fa-newspaper',
        ],
        [
            'name' => 'Articles',
            'route' => 'jssi.admin.articles',
            'icon' => 'fa-note-sticky',
        ],
        [
            'name' => 'Authors',
            'route' => 'jssi.admin.authors',
            'icon' => 'fa-user-group',
        ],
        [
            'name' => 'Institutions',
            'route' => 'jssi.admin.institutions.index',
            'icon' => 'fa-building-columns',
        ],
        [
            'name' => 'Keywords',
            'route' => 'jssi.admin.keywords',
            'icon' => 'fa-tags',
        ],
        [
            'name' => 'JEL',
            'subtabs' => [
                [
                    'name' => 'Categories',
                    'route' => 'jssi.admin.jel.categories.index',
                    'icon' => 'fa-bars',
                ],
                [
                    'name' => 'Subcategories',
                    'route' => 'jssi.admin.jel.subcategories.index',
                    'icon' => 'fa-bars-staggered',
                ],
                [
                    'name' => 'Codes',
                    'route' => 'jssi.admin.jel.codes.index',
                    'icon' => 'fa-barcode',
                ],
            ],
            'route' => 'jssi.admin.jel.codes.index',
            'icon' => 'fa-qrcode',
            'routePrefix' => 'jssi/admin/papers/jel/*',
        ],
        [
            'name' => 'Countries',
            'route' => 'jssi.admin.countries',
            'icon' => 'fa-flag',
        ],
    ];
@endphp
@foreach ($categories as $category)
    @if (isset($category['subtabs']))
        <li class="nav-item {{ request()->is($category['routePrefix']) ? 'menu-open' : '' }}">
            <a href="{{ route($category['route']) }}"
                class="nav-link {{ request()->is($category['routePrefix']) ? 'active ' : '' }}">
                <i class="fa {{ $category['icon'] }} nav-icon"></i>
                <p>
                    {{ $category['name'] }}
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                @foreach ($category['subtabs'] as $subtab)
                    <li class="nav-item">
                        <a href="{{ route($subtab['route']) }}"
                            class="nav-link {{ request()->routeIs($subtab['route'] . '*') ? 'active' : '' }}">
                            <i class="fa {{ $subtab['icon'] }} nav-icon"></i>
                            <p>{{ $subtab['name'] }}</p>
                        </a>
                    </li>
                @endforeach
            </ul>
        </li>
    @else
        <li class="nav-item">
            <a href="{{ route($category['route']) }}"
                class="nav-link {{ request()->routeIs($category['route'] . '*') ? 'active' : '' }}">
                <i class="fa {{ $category['icon'] }} nav-icon"></i>
                <p>{{ $category['name'] }}</p>
            </a>
        </li>
    @endif
@endforeach

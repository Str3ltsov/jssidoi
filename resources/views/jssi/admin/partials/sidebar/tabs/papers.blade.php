@php
    $categories = [
        [
            'name' => 'Issues',
            'route' => 'jssi.admin.issues',
            'icon' => 'fa-newspaper',
            'permission' => 'users.update',
        ],
        [
            'name' => 'Articles',
            'route' => 'jssi.admin.articles',
            'icon' => 'fa-note-sticky',
            'permission' => 'articles.create',
        ],
        [
            'name' => 'Authors',
            'route' => 'jssi.admin.authors',
            'icon' => 'fa-user-group',
            'permission' => 'users.update',
        ],
        [
            'name' => 'Institutions',
            'route' => 'jssi.admin.institutions.index',
            'icon' => 'fa-building-columns',
            'permission' => 'users.update',
        ],
        [
            'name' => 'Keywords',
            'route' => 'jssi.admin.keywords.index',
            'icon' => 'fa-tags',
            'permission' => 'users.update',
        ],
        [
            'name' => 'JEL',
            'permission' => 'users.update',
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
            'permission' => 'users.update',
        ],
        [
            'name' => 'Countries',
            'route' => 'jssi.admin.countries',
            'icon' => 'fa-flag',
            'permission' => 'users.update',
        ],
        [
            'name' => 'Reviews',
            'route' => 'jssi.admin.reviews.index',
            'icon' => 'fa-arrows-rotate',
            'permission' => 'articles.review',
        ],
    ];
@endphp
@foreach ($categories as $category)
    @can($category['permission'])
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
            @if (Auth::user()->can($category['permission']))
                <li class="nav-item">
                    <a href="{{ route($category['route']) }}"
                        class="nav-link {{ request()->routeIs($category['route'] . '*') ? 'active' : '' }}">
                        <i class="fa {{ $category['icon'] }} nav-icon"></i>
                        <p>{{ $category['name'] }}</p>
                    </a>
                </li>
            @endif
        @endif
    @endcan
@endforeach

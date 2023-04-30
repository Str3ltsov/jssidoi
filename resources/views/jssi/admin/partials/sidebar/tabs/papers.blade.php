@php
    $categories = [
        [
            'name' => 'Issues',
            'route' => 'jssi.admin.issues',
            'icon' => 'fa-newspaper'
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
            'route' => 'jssi.admin.institutions',
            'icon' => 'fa-building-columns',
        ],
        [
            'name' => 'Keywords',
            'route' => 'jssi.admin.keywords',
            'icon' => 'fa-tags',
        ],
        [
            'name' => 'JEL Codes',
            'route' => 'jssi.admin.jelcodes',
            'icon' => 'fa-barcode',
        ],
        [
            'name' => 'Submits',
            'route' => 'jssi.admin.submits',
            'icon' => 'fa-plus',
        ],
        [
            'name' => 'Countries',
            'route' => 'jssi.admin.countries',
            'icon' => 'fa-flag',
        ],

    ]
@endphp

@foreach($categories as $category)
    <li class="nav-item">
                <a href="{{ route($category['route']) }}" class="nav-link {{ request()->routeIs($category['route'].'*') ? 'active' : '' }}">
                  <i class="fa {{$category['icon']}} nav-icon"></i>
                  <p>{{$category['name']}}</p>
                </a>
    </li>
@endforeach


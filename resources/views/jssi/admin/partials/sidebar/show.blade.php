<nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item">
            <a href="/jssi/admin" class="nav-link {{ request()->routeIs('jssi.admin.home') ? 'active' : '' }}">
              <i class="nav-icon fa fa-house"></i>
              <p>
                Home
              </p>
            </a>
          </li>
          <li class="nav-item {{ str_starts_with( request()->path(), 'jssi/admin/papers') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ str_starts_with( request()->path(), 'jssi/admin/papers') ? 'active' : '' }}">
              <i class="nav-icon fas fa-file"></i>
              <p>
                Papers
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              {{-- <li class="nav-item">
                <a href="./index.html" class="nav-link active">
                  <i class="fa fa-newspaper nav-icon"></i>
                  <p>Journals</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index2.html" class="nav-link">
                  <i class="fa fa-note-sticky nav-icon"></i>
                  <p>Papers</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index3.html" class="nav-link">
                  <i class="fa fa-user-group nav-icon"></i>
                  <p>Authors</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index3.html" class="nav-link">
                  <i class="fa fa-building-columns nav-icon"></i>
                  <p>Institutions</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index3.html" class="nav-link">
                  <i class="fa fa-tags nav-icon"></i>
                  <p>Keywords</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index3.html" class="nav-link">
                  <i class="fa fa-barcode nav-icon"></i>
                  <p>JEL Codes</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index3.html" class="nav-link">
                  <i class="fa fa-plus nav-icon"></i>
                  <p>Submits</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index3.html" class="nav-link">
                  <i class="fa fa-flag nav-icon"></i>
                  <p>Countries</p>
                </a>
              </li> --}}
              @include('jssi.admin.partials.sidebar.tabs.papers')
            </ul>
          </li>
          <li class="nav-header">EXAMPLES</li>

      </nav>

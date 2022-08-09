<div id="Sidebar" class="site-sidebar p-fixed h-100 left-0 top-0 bg-sidebar transition z-index-11 {{ auth()->user() ? 'show expand' : '' }}">
  <div class="sidebar-overlay p-absolute z-index-1"></div>

  <div class="sidebar-wrapper">
    {{-- {{ auth()->user() ? 'hidden' : '' }} --}}
    <div class="sidebar-top h-auto text-center p-10 bb-1">
      <a href="/" class="p-5">
        <img src="{{ asset('assets/img/logo-only-red.png') }}" alt="" 
        class="brand-logo logo-only w-100 h-30px transition" />

        <img src="{{ asset('assets/img/logo-red.png') }}" alt="" 
        class="brand-logo logo-text w-100 h-30px transition d-none" />
      </a>
    </div>

    <div class="sidebar-content full-height-prev-auto">
      <ul class="sidebar-nav">
        <li class="menu-item">
          <a href="{{ route('admin.dashboard') }}" class="menu-link py-20">
            <i class="menu-icon fa fa-home"></i>
            <span>Dashboard</span>
            {{-- <span class="full-width-prev-auto"></span> --}}
          </a>
        </li>
        
        
        {{-- Product-Requirement --}}
        <li class="menu-item dropdown text-white">
          <div class="menu-link dropmenu-toggle {{ strpos($viewName, 'requirement') ? 'active' : '' }}" id="Sidebar-Nav-Requirement">
            <i class="menu-icon fa fa-home"></i>
            <span>Product Requirement</span>
            {{-- <span class="full-width-prev-auto">
              <span class="caret">
                <i class="fa fa-angle-down"></i>
              </span>
            </span> --}}
          </div>

          <div class="drop-menu {{ strpos($viewName, 'requirement') ? 'show' : '' }}" aria-labelledby="Sidebar-Nav-Requirement">
            <div class="drop-item">
              <a href="{{ route('product-requirement.all.show') }}"
                 class="drop-link {{ strpos($viewName, 'requirement') && strpos($viewName, 'index') ? 'active' : '' }}">
                <i class="menu-icon fa fa-home"></i>
                <span>Requirements All</span>
              </a>
            </div>

            {{-- <div class="drop-item">
              <a href="{{ route('product-requirement.new.create') }}"
                 class="drop-link {{ strpos($viewName, 'requirement') && strpos($viewName, 'new') ? 'active' : '' }}">
                <i class="menu-icon fa fa-home"></i>
                <span>New Requirement</span>
              </a>
            </div> --}}
          </div>
        </li>

        {{-- Entity-Dropdown --}}
        <li class="menu-item dropdown text-white">
          <div class="menu-link dropmenu-toggle {{ strpos($viewName, 'entity') ? 'active' : '' }}" id="Sidebar-Nav-Entity">
            <i class="menu-icon fa fa-home"></i>
            <span>Entity Information</span>
            {{-- <span class="full-width-prev-auto">
              <span class="caret">
                <i class="fa fa-angle-down"></i>
              </span>
            </span> --}}
          </div>

          <div class="drop-menu {{ strpos($viewName, 'entity') ? 'show' : '' }}" aria-labelledby="Sidebar-Nav-Entity">
            <div class="drop-item">
              <a href="{{ route('entity.all.index') }}"
                 class="drop-link {{ strpos($viewName, 'entity') && strpos($viewName, 'index') ? 'active' : '' }}">
                <i class="menu-icon fa fa-home"></i>
                <span>Entity All</span>
              </a>
            </div>

            <div class="drop-item">
              <a href="{{ route('entity.new.create') }}"
                 class="drop-link {{ strpos($viewName, 'entity') && strpos($viewName, 'new') ? 'active' : '' }}">
                <i class="menu-icon fa fa-home"></i>
                <span>Add Entity</span>
              </a>
            </div>
          </div>
        </li>

        {{-- Employee-&-User-Dropdown --}}
        @can ('isSuperAdmin', Auth::user())
          {{-- Employee-Dropdown --}}
          <li class="menu-item dropdown text-white">
            <div class="menu-link dropmenu-toggle {{ strpos($viewName, 'employee') ? 'active' : '' }}" id="Sidebar-Nav-Employee">
              <i class="menu-icon fa fa-home"></i>
              <span>Employees</span>
              {{-- <span class="full-width-prev-auto">
                <span class="caret">
                  <i class="fa fa-angle-down"></i>
                </span>
              </span> --}}
            </div>

            <div class="drop-menu {{ strpos($viewName, 'employee') ? 'show' : '' }}" aria-labelledby="Sidebar-Nav-Employee">
              <div class="drop-item">
                <a href="{{ route('employee.all.index') }}"
                   class="drop-link {{ strpos($viewName, 'employee') && strpos($viewName, 'index') ? 'active' : '' }}">
                  <i class="menu-icon fa fa-home"></i>
                  <span>Employee All</span>
                </a>
              </div>

              <div class="drop-item">
                <a href="{{ route('employee.new.create') }}"
                   class="drop-link {{ strpos($viewName, 'employee') && strpos($viewName, 'new') ? 'active' : '' }}">
                  <i class="menu-icon fa fa-home"></i>
                  <span>Add Employee</span>
                </a>
              </div>
            </div>
          </li>
          
          {{-- User-Dropdown --}}
          <li class="menu-item dropdown text-white">
            <div class="menu-link dropmenu-toggle {{ strpos($viewName, 'user') && ! strpos($viewName, 'myAccount') ? 'active' : '' }}" id="Sidebar-Nav-User">
              <i class="menu-icon fa fa-home"></i>
              <span>Users</span>
              {{-- <span class="full-width-prev-auto">
                <span class="caret">
                  <i class="fa fa-angle-down"></i>
                </span>
              </span> --}}
            </div>

            <div class="drop-menu {{ strpos($viewName, 'user') && ! strpos($viewName, 'myAccount') ? 'show' : '' }}" aria-labelledby="Sidebar-Nav-User">
              <div class="drop-item">
                <a href="{{ route('user.all.index') }}"
                   class="drop-link {{ strpos($viewName, 'user') && strpos($viewName, 'index') ? 'active' : '' }}">
                  <i class="menu-icon fa fa-home"></i>
                  <span>User All</span>
                </a>
              </div>

              <div class="drop-item">
                <a href="{{ route('user.new.create') }}"
                   class="drop-link {{ strpos($viewName, 'user') && strpos($viewName, 'new') ? 'active' : '' }}">
                  <i class="menu-icon fa fa-home"></i>
                  <span>Add User</span>
                </a>
              </div>
            </div>
          </li>
          
          {{-- Symbolic-Link-Cache-and-Config --}}
          @can ('entryArtisanCommand', Auth::user())
            {{-- Symlink-and-Storage-Link --}}
            <li class="menu-item dropdown text-white ctrl d-none">
              <div class="menu-link dropmenu-toggle" id="Sidebar-Nav-Symlink">
                <i class="menu-icon fa fa-home"></i>
                <span>
                  Symlink / Storage-Link
                  {{-- <i class="fa fa-angle-down"></i> --}}
                </span>
                {{-- <span class="full-width-prev-auto">
                  <span class="caret">
                    <i class="fa fa-angle-down"></i>
                  </span>
                </span> --}}
              </div>

              <div class="drop-menu" aria-labelledby="Sidebar-Nav-Symlink">
                {{-- Create-Symlink --}}
                <div class="drop-item">
                  <a href="{{ url('/create-symlink') }}"
                     class="drop-link">
                    <i class="menu-icon fa fa-home"></i>
                    <span>Create Symlink</span>
                  </a>
                </div>

                {{-- Create-Storage-Link --}}
                <div class="drop-item">
                  <a href="{{ url('/create-storage-link') }}"
                     class="drop-link">
                    <i class="menu-icon fa fa-home"></i>
                    <span>Create Storage-Link</span>
                  </a>
                </div>
                
              </div>
            </li>

            {{-- Cache-and-Config --}}
            <li class="menu-item dropdown text-white ctrl d-none">
              <div class="menu-link dropmenu-toggle" id="Sidebar-Nav-CacheConfig">
                <i class="menu-icon fa fa-home"></i>
                <span>
                  Cache & Config
                  {{-- <i class="fa fa-angle-down"></i> --}}
                </span>
                {{-- <span class="full-width-prev-auto">
                  <span class="caret">
                    <i class="fa fa-angle-down"></i>
                  </span>
                </span> --}}
              </div>

              <div class="drop-menu" aria-labelledby="Sidebar-Nav-CacheConfig">
                {{-- Route-View-clear-only --}}
                <div class="drop-item">
                  <a href="{{ url('/route-view-clear-only') }}"
                     class="drop-link">
                    <i class="menu-icon fa fa-home"></i>
                    <span>Route-View Clear</span>
                  </a>
                </div>

                {{-- Route-View-clear-and-cache --}}
                <div class="drop-item">
                  <a href="{{ url('/route-view-clear-and-cache') }}"
                     class="drop-link">
                    <i class="menu-icon fa fa-home"></i>
                    <span>Route-View clear and cache</span>
                  </a>
                </div>

                {{-- Config-cache --}}
                <div class="drop-item">
                  <a href="{{ url('/config-cache') }}"
                     class="drop-link">
                    <i class="menu-icon fa fa-home"></i>
                    <span>Config cache</span>
                  </a>
                </div>

                {{-- Session-clear --}}
                <div class="drop-item">
                  <a href="{{ url('/session-clear') }}"
                     class="drop-link">
                    <i class="menu-icon fa fa-home"></i>
                    <span>Session Clear</span>
                  </a>
                </div>
                
              </div>
            </li>
          @endcan
        @endcan

      </ul>
    </div>
  </div>
</div>
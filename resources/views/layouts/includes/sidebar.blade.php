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
        
        {{--Entity-Dropdown--}}
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
              <a href="{{ route('employee.new.create') }}"
                 class="drop-link {{ strpos($viewName, 'entity') && strpos($viewName, 'new') ? 'active' : '' }}">
                <i class="menu-icon fa fa-home"></i>
                <span>Add Entity</span>
              </a>
            </div>
          </div>
        </li>

        {{--User-&-Settings-Dropdown--}}
        @can ('isSuperAdmin', Auth::user())
          {{--Employee-Dropdown--}}
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
          
          {{--User-Dropdown--}}
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
        @endcan

      </ul>
    </div>
  </div>
</div>
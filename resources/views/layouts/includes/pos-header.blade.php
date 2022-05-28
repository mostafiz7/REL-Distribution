<header class="header-area pos-header">
  <div class="header-navbar" id="Pos-Header">
    <nav class="navbar navbar-expand py-5 px-10">

      <div class="navbar-header">
        <ul class="navbar-nav">
          <li class="nav-item"></li>
        </ul>
      </div>

      <div class="navbar-header right ms-auto">
        <ul class="navbar-nav">
          {{--APP-Control-Block--}}
          <li class="nav-item dropdown control-right-sidebar">
            <div class="nav-link dropdown-toggle after-none text-danger pt-5 pb-0 cur-pointer" id="Control-Right-Sidebar"
               data-bs-toggle="tooltip" data-bs-custom-class="tooltip-control-rightSidebar" data-bs-placement="bottom" title="App Navigation">
              <i class="fa fa-th-large fz-30"></i>
            </div>
            <div class="dropdown-menu dropdown-menu-right w-200px h-fit pos-right py-5" aria-labelledby="Control-Right-Sidebar">
              <div class="user-actions">
                <a href="{{ route('admin.dashboard') }}" class="dropdown-link d-block text-white py-8 px-15 mb-2">Dashboard</a>
                <a href="{{ route('pos.sales.index') }}" class="dropdown-link d-block text-white py-8 px-15 mb-2">Order History</a>
                <a href="{{ route('pos.sales.invoice') }}" class="dropdown-link d-block text-white py-8 px-15 mb-2">New Order</a>
              </div>
            </div>
          </li>

          {{--User-Profile-&-Logout-Block--}}
          <li class="nav-item dropdown logout">
            <div class="nav-link dropdown-toggle after-none p-relative w-40px h-40px p-0 mx-7" id="Dropdown-Logout"
                 data-bs-toggle="tooltip" data-bs-custom-class="tooltip-logout" data-bs-placement="bottom" title="Account Control">
              <?php
                $hasImage = auth()->user()->image && file_exists( public_path( auth()->user()->image['url'] ) ) ? auth()->user()->image['url'] : null;
                $imageWithDummy = $hasImage ?? 'assets/img/admins/user-avatar-default.png';
              ?>
              <div class="user-image p-absolute pos-top-right w-100 h-100 brd-50 border-3 border-white cur-pointer">
                <img src="{{ asset($imageWithDummy) }}" alt="User image" class="profile-img w-100 h-auto brd-50" />
              </div>
            </div>
            <div class="dropdown-menu dropdown-menu-right w-200px h-fit pos-right py-5" aria-labelledby="Dropdown-Logout">
              <div class="user-actions">
                <a href="{{ route('my.profile.admin') }}" class="dropdown-link d-block text-white py-8 px-15 mb-2">My Account</a>
                <a href="{{ route('logout') }}" class="dropdown-link d-block text-white py-8 px-15">Logout</a>
              </div>
            </div>
          </li>
        </ul>
      </div>

    </nav>
  </div>
</header>

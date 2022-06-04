<header class="header-area admin-header expand-default">
  <div class="header-navbar" id="Admin-Header">
    <nav class="navbar navbar-expand-lg py-0 pl-10 pr-5">
      
      <button id="pushMenu" class="sidebar-push">
        <i class="fa fa-bars"></i>
      </button>
      
      <div class="navbar-header">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="/" class="nav-link">Home</a>
          </li>

          {{--Product-&-Category--}}
          {{--@if ( Auth::user()->can('isAdmins') )
          @endif--}}
          @can ('isAdmins', Auth::user())
            {{--Product-Dropdown--}}
            <li class="nav-item dropdown">
              <div id="Header-Nav-Product"
                class="nav-link dropdown-toggle {{ strpos($viewName, 'product') ? 'active' : '' }}">
                Products
              </div>
              <div class="dropdown-menu" aria-labelledby="Header-Nav-Product">
                <div class="dropdown-item">
                  <a href="{{ route('product.all') }}"
                     class="dropdown-link {{ strpos($viewName, 'product') && strpos($viewName, 'index') ? 'active' : '' }}">
                    Product Index
                  </a>
                </div>
                <div class="dropdown-item">
                  <a href="{{ route('product.new') }}"
                     class="dropdown-link {{ strpos($viewName, 'product') && strpos($viewName, 'new') ? 'active' : '' }}">
                    Add Product
                  </a>
                </div>
              </div>
            </li>

            {{--Category--}}
            <li class="nav-item">
              <a href="{{ route('category.new') }}"
                 class="nav-link {{ strpos($viewName, 'category') ? 'active' : '' }}">
                Categories
              </a>
            </li>
          @endcan

        </ul>
      </div>
      
      {{--<div class="search-bar">
        <form name="HeaderSearchForm" id="HeaderSearchForm" class="header-search-form
                  form-inline">
          <div class="form-group form-group-sm">
            <input type="search" name="HeaderSearch" id="HeaderSearch"
                   class="form-control form-control-navbar" placeholder="Search..." />
            
            <button type="submit" name="headerSearchSubmit" id="headerSearchSubmit" class="btn btn-navbar">
              <i class="fa fa-search"></i>
            </button>
          </div>
        </form>
      </div>--}}
      
      <div class="navbar-header right ms-auto">
        <ul class="navbar-nav">
          {{--POS-Block--}}
          <li class="nav-item pos-module">
            <a href="{{ route('pos.sales.invoice') }}"
               class="nav-link p-0 mt-10 {{ strpos($viewName, 'pos-module') ? 'active' : '' }}"
               data-bs-toggle="tooltip" data-bs-custom-class="mt-10" data-bs-placement="bottom" title="Point of Sale">
              <span class="btn btn-warning fw-bold lh-1 py-5 px-5 brd-2">
                <i class="fas fa-cart-plus mr-3"></i>
                POS
              </span>
            </a>
          </li>

          {{--Message-Block--}}
          <li class="nav-item dropdown comments">
            <div class="nav-link dropdown-toggle" id="Dropdown-Comments"
                 data-bs-toggle="tooltip" data-bs-custom-class="tooltip-Comments" data-bs-placement="bottom" title="Comments">
              <i class="fa fa-comments fz-30"></i>
              <span class="badge rounded-pill bg-danger navbar-badge">{{ '' }}</span>
            </div>
            {{--<div class="dropdown-menu dropdown-menu-right" aria-labelledby="Dropdown-Comments">
              <div class="dropdown-item">
                <div class="image">
                  <img src="" alt="" class="dropdown-img" />
                </div>
                <div class="dropdown-body">
                  <h6 class="dropdown-item-title">
                    Title One
                    <span class="float-right text-sm text-danger">
                      <i class="fas fa-star"></i>
                    </span>
                  </h6>
                  <p class="dropdown-item-text text-sm">
                    Call me whenever you can...
                  </p>
                  <span class="text-sm text-muted">
                    <i class="fa fa-clock mr-4"></i>
                    4 Hours Ago
                  </span>
                </div>
              </div>
            </div>--}}
          </li>

          {{--Notifications-Block--}}
          <li class="nav-item dropdown notifications">
            <?php
              $auth_user = auth()->user() ?? null;
              // $has_notifications = $user && property_exists($user, 'notifications');
              // $notifications_all = $has_notifications ? $user->notifications : [];
              $notifications_all = $auth_user->notifications;
            ?>

            <div class="nav-link dropdown-toggle" id="Dropdown-Notifications"
                 data-bs-toggle="tooltip" data-bs-custom-class="tooltip-Notifications" data-bs-placement="bottom" title="Notifications">
              <i class="fa fa-bell fz-30"></i>
              <span id="Unseen-Notifications" class="badge rounded-pill bg-danger navbar-badge"></span>
            </div>

            <div class="dropdown-menu dropdown-menu-right text-white-2 brd-5" aria-labelledby="Dropdown-Notifications">
              <div id="notifications-dropdown-container" class="notifications-container overflowX-hidden">
                <div class="dropdown-list-header py-5 px-8">
                  <div class="header-top mb-20">
                    <div class="dropdown-header-content d-flex justify-content-between p-relative">
                      <div class="dropdown-list-title fz-22 fw-bold">Notifications</div>
                      <div class="dropdown-settings-menu-icon w-30px h-30px text-center mr--10 brd-50 cur-pointer">
                        <span class="dropdown-settings-menu-ellipsis"><i class="fal fa-ellipsis-h fz-26 lh-1-2"></i></span>
                      </div>
                      <div class="dropdown-settings-wrap d-none p-absolute pos-top-left p-5 ml--15 mt-45 brd-5 z-index-1100">
                        <a href="#" id="MarkAllUnread-AsRead" onclick="MarkAllUnreadAsRead(this);"
                           class="dropdown-settings-link d-block p-relative text-white-2 fw-bold p-10 brd-3 z-index-1120">
                          <div class="d-flex align-self-center">
                            <i class="fal fa-check fz-20 mr-10"></i>
                            <span class="">Mark all as read</span>
                          </div>
                        </a>
                        <a href="#" class="dropdown-settings-link d-block p-relative text-white-2 fw-bold p-10 brd-3 z-index-1120">
                          <div class="d-flex align-self-center">
                            <i class="fal fa-cog fz-20 mr-10"></i>
                            <span class="">Notification settings</span>
                          </div>
                        </a>
                      </div>
                    </div>
                  </div>
                  {{--<div class="header-bottom mb-5">
                    <div class="d-flex justify-content-between">
                      <div class="left fw-bold">New</div>
                      <a href="#" class="right text-primary">See All</a>
                    </div>
                  </div>--}}
                </div>

                <div class="notifications-container">
                  <div id="Show-Notifications-Dropdown" class="dropdown-list-body">
                    {{--Show All Notifications as Dropdown List Here--}}
                  </div>
                </div>
              </div>
            </div>
          </li>

          {{--APP-Control-Block--}}
          <li class="nav-item control-right-sidebar">
            <a href="#" class="nav-link" id="Control-Right-Sidebar"
               data-bs-toggle="tooltip" data-bs-custom-class="tooltip-control-rightSidebar" data-bs-placement="bottom" title="Control right sidebar">
              <i class="fa fa-th-large fz-30"></i>
            </a>
          </li>

          {{--User-Profile-&-Logout-Block--}}
          <li class="nav-item dropdown logout">
            @if ( Auth::check() )
              <div class="nav-link dropdown-toggle" id="Dropdown-Logout"
                   data-bs-toggle="tooltip" data-bs-custom-class="tooltip-logout" data-bs-placement="bottom" title="Account Control">
                {{--{{ ucwords(Auth::user()->first_name) . ' ' . ucwords(Auth::user()->last_name) }}--}}
                <?php
                $hasImage = auth()->user()->image && file_exists( public_path( auth()->user()->image['url'] ) ) ? auth()->user()->image['url'] : null;
                $imageWithDummy = $hasImage ?? 'assets/img/admins/user-avatar-default.png';
                ?>
                <div class="user-image p-absolute pos-top-right w-100 h-100 border-3 border-white brd-50 cur-pointer">
                  <img src="{{ asset($imageWithDummy) }}" alt="User image" class="profile-img w-100 h-auto brd-50" />
                </div>
              </div>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="Dropdown-Logout">
                <div class="user-actions">
                  <a href="{{ route('my-profile.edit') }}" class="dropdown-link">My Account</a>
                  <a href="{{ route('logout') }}" class="dropdown-link">Logout</a>
                  {{--<a href="#" class="dropdown-link"
                     onclick="event.preventDefault(); document.getElementById('LogoutForm').submit();"
                  >Logout</a>--}}
                </div>

                {{--<form method="POST" action="{{ route('logout') }}" name="LogoutForm" id="LogoutForm" class="d-none">
                  @csrf
                </form>--}}
              </div>
            @endif
            
          </li>
        </ul>
      </div>
      
    </nav>
  </div>
</header>

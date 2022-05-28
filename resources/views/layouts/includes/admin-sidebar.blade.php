@if ( Auth::check() && strpos($viewName, 'admin') )
<div class="sidebar admin-sidebar expand-default show" id="Sidebar">
  <div class="sidebar-overlay" id="Sidebar-Overlay"></div>
  <div class="sidebar-container">
    <div class="sidebar-top">
      <div class="user-panel">
        <?php
          $hasImage = auth()->user()->image && file_exists( public_path( auth()->user()->image['url'] ) ) ? auth()->user()->image['url'] : null;
          $imageWithDummy = $hasImage ?? 'assets/img/admins/user-avatar-default.png';
        ?>
        <div class="user-image">
          <img src="{{ asset($imageWithDummy) }}" alt="User image" class="profile-img" />
        </div>

        <div class="user-info">
          <div class="user-name">
            {{ ucwords(auth()->user()->first_name) . ' ' . ucwords(auth()->user()->last_name) }}
          </div>
          <a href="{{ route('logout') }}" class="logout">Logout</a>
        </div>
      </div>

      <div class="dashboard">
        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ strpos($viewName, 'dashboard') ? 'active' : '' }}">
          <i class="nav-icon fa fa-home"></i>
          <span>Dashboard</span>
        </a>
      </div>
    </div>

    <div class="sidebar-content overlay-scrollbar">
      <ul class="sidebar-nav pb-100">

        @can ('isAdmins', Auth::user())
          {{--Transactions-Dropdown--}}
          <li class="nav-item dropdown">
            <div class="nav-link dropdown-toggle {{ strpos($viewName, 'transaction') ? 'active' : '' }}" id="Sidebar-Nav-Transaction">
              <i class="nav-icon fa fa-home"></i>
              <span>Transactions<i class="fa fa-angle-down"></i></span>
            </div>
            <div class="dropdown-menu {{ strpos($viewName, 'transaction') ? 'show' : '' }}" aria-labelledby="Sidebar-Nav-Transaction">
              <div class="dropdown-item">
                <a href="{{ route('transaction.receive.index') }}"
                   class="dropdown-link {{ strpos($viewName, 'transaction') && strpos($viewName, 'receive') && strpos($viewName, 'index') ? 'active' : '' }}">
                  <i class="nav-icon fa fa-home"></i>
                  <span>Receive Index</span>
                </a>
              </div>
              <div class="dropdown-item">
                <a href="{{ route('transaction.receive.new') }}"
                   class="dropdown-link {{ strpos($viewName, 'transaction') && strpos($viewName, 'receive') && strpos($viewName, 'new') ? 'active' : '' }}">
                  <i class="nav-icon fa fa-home"></i>
                  <span>Receive Entry</span>
                </a>
              </div>
            </div>
          </li>

          {{--Product-Dropdown--}}
          <li class="nav-item dropdown">
            <div class="nav-link dropdown-toggle {{ strpos($viewName, 'product') ? 'active' : '' }}" id="Sidebar-Nav-Product">
              <i class="nav-icon fa fa-home"></i>
              <span>Products<i class="fa fa-angle-down"></i></span>
            </div>
            <div class="dropdown-menu {{ strpos($viewName, 'product') ? 'show' : '' }}" aria-labelledby="Sidebar-Nav-Product">
              <div class="dropdown-item">
                <a href="{{ route('product.all') }}"
                   class="dropdown-link {{ strpos($viewName, 'product') && strpos($viewName, 'index') ? 'active' : '' }}">
                  <i class="nav-icon fa fa-home"></i>
                  <span>Product Index</span>
                </a>
              </div>
              <div class="dropdown-item">
                <a href="{{ route('product.new') }}"
                   class="dropdown-link {{ strpos($viewName, 'product') && strpos($viewName, 'new') ? 'active' : '' }}">
                  <i class="nav-icon fa fa-home"></i>
                  <span>Add Product</span>
                </a>
              </div>
            </div>
          </li>

          {{--Categories--}}
          <li class="nav-item">
            <a href="{{ route('category.new') }}"
               class="nav-link {{ strpos($viewName, 'category') ? 'active' : '' }}">
              <i class="nav-icon fa fa-home"></i>
              <span>Categories</span>
            </a>
          </li>

          {{--Payment-Methods--}}
          <li class="nav-item">
            <a href="{{ route('payment-Method.new') }}"
               class="nav-link {{ strpos($viewName, 'payment_method') ? 'active' : '' }}">
              <i class="nav-icon fa fa-home"></i>
              <span>Payment Methods</span>
            </a>
          </li>
        @endcan

        {{--Order--}}
        <li class="nav-item">
          <a href="{{ route('order.all') }}"
             class="nav-link {{ strpos($viewName, 'order') && !strpos($viewName, 'orderProcess') ? 'active' : '' }}">
            <i class="nav-icon fa fa-home"></i>
            <span>Orders</span>
          </a>
        </li>

        {{--Reservation-Dropdown--}}
        <li class="nav-item dropdown">
          <div class="nav-link dropdown-toggle {{ strpos($viewName, 'reservation') ? 'active' : '' }}" id="Sidebar-Nav-Reservation">
            <i class="nav-icon fa fa-home"></i>
            <span>Reservations<i class="fa fa-angle-down"></i></span>
          </div>
          <div class="dropdown-menu {{ strpos($viewName, 'reservation') ? 'show' : '' }}" aria-labelledby="Sidebar-Nav-Reservation">
            <div class="dropdown-item">
              <a href="{{ route('reservation.all.not-Confirmed') }}"
                 class="dropdown-link {{ strpos($viewName, 'reservation') && strpos($viewName, 'notConfirmed') ? 'active' : '' }}">
                <i class="nav-icon fa fa-home"></i>
                <span>Not-Confirmed</span>
              </a>
            </div>
            <div class="dropdown-item">
              <a href="{{ route('reservation.all.confirmed') }}"
                 class="dropdown-link {{ strpos($viewName, 'reservation') && strpos($viewName, 'confirmed') ? 'active' : '' }}">
                <i class="nav-icon fa fa-home"></i>
                <span>Confirmed</span>
              </a>
            </div>
            <div class="dropdown-item">
              <a href="{{ route('reservation.all.canceled') }}"
                 class="dropdown-link {{ strpos($viewName, 'reservation') && strpos($viewName, 'canceled') ? 'active' : '' }}">
                <i class="nav-icon fa fa-home"></i>
                <span>Canceled</span>
              </a>
            </div>
          </div>
        </li>

        @can ('isAdmins', Auth::user())
          {{--Supplier-Dropdown--}}
          <li class="nav-item dropdown">
            <div class="nav-link dropdown-toggle {{ strpos($viewName, 'supplier') ? 'active' : '' }}" id="Sidebar-Nav-Supplier">
              <i class="nav-icon fa fa-home"></i>
              <span>Suppliers<i class="fa fa-angle-down"></i></span>
            </div>
            <div class="dropdown-menu {{ strpos($viewName, 'supplier') ? 'show' : '' }}" aria-labelledby="Sidebar-Nav-Supplier">
              <div class="dropdown-item">
                <a href="{{ route('supplier.all.index') }}"
                   class="dropdown-link {{ strpos($viewName, 'supplier') && strpos($viewName, 'index') ? 'active' : '' }}">
                  <i class="nav-icon fa fa-home"></i>
                  <span>Supplier Index</span>
                </a>
              </div>
              <div class="dropdown-item">
                <a href="{{ route('supplier.add.new') }}"
                   class="dropdown-link {{ strpos($viewName, 'supplier') && strpos($viewName, 'new') ? 'active' : '' }}">
                  <i class="nav-icon fa fa-home"></i>
                  <span>Add Supplier</span>
                </a>
              </div>
            </div>
          </li>

          {{--Customer-Dropdown--}}
          <li class="nav-item">
            <a href="{{ route('customer.all.index') }}"
               class="nav-link {{ strpos($viewName, 'customer') ? 'active' : '' }}">
              <i class="nav-icon fa fa-home"></i>
              <span>Customers</span>
            </a>
          </li>

          {{--User-Dropdown--}}
          <li class="nav-item dropdown">
            <div class="nav-link dropdown-toggle {{ strpos($viewName, 'user') && ! strpos($viewName, 'myAccount') ? 'active' : '' }}" id="Sidebar-Nav-User">
              <i class="nav-icon fa fa-home"></i>
              <span>Users<i class="fa fa-angle-down"></i></span>
            </div>
            <div class="dropdown-menu {{ strpos($viewName, 'user') && ! strpos($viewName, 'myAccount') ? 'show' : '' }}" aria-labelledby="Sidebar-Nav-User">
              <div class="dropdown-item">
                <a href="{{ route('user.all.index') }}"
                   class="dropdown-link {{ strpos($viewName, 'user') && strpos($viewName, 'index') ? 'active' : '' }}">
                  <i class="nav-icon fa fa-home"></i>
                  <span>User Index</span>
                </a>
              </div>
              <div class="dropdown-item">
                <a href="{{ route('user.add.new') }}"
                   class="dropdown-link {{ strpos($viewName, 'user') && strpos($viewName, 'new') ? 'active' : '' }}">
                  <i class="nav-icon fa fa-home"></i>
                  <span>Add User</span>
                </a>
              </div>
            </div>
          </li>

          {{--Settings-Dropdown--}}
          <li class="nav-item dropdown">
            <div class="nav-link dropdown-toggle {{ strpos($viewName, 'settings') ? 'active' : '' }}" id="Sidebar-Nav-Settings">
              <i class="nav-icon fa fa-home"></i>
              <span>Settings<i class="fa fa-angle-down"></i></span>
            </div>
            <div class="dropdown-menu {{ strpos($viewName, 'settings') ? 'show' : '' }}" aria-labelledby="Sidebar-Nav-Settings">
              <div class="dropdown-item">
                <a href="{{ route('settings.general') }}"
                   class="dropdown-link {{ strpos($viewName, 'settings') && strpos($viewName, 'general-settings') ? 'active' : '' }}">
                  <i class="nav-icon fa fa-home"></i>
                  <span>General</span>
                </a>
              </div>
              <div class="dropdown-item">
                <a href="{{ route('settings.mail-Config') }}"
                   class="dropdown-link {{ strpos($viewName, 'settings') && strpos($viewName, 'mailConfig-settings') ? 'active' : '' }}">
                  <i class="nav-icon fa fa-home"></i>
                  <span>Mail Config</span>
                </a>
              </div>
              <div class="dropdown-item">
                <a href="{{ route('settings.order-Process') }}"
                   class="dropdown-link {{ strpos($viewName, 'settings') && strpos($viewName, 'orderProcess-settings') ? 'active' : '' }}">
                  <i class="nav-icon fa fa-home"></i>
                  <span>Order Process</span>
                </a>
              </div>
              <div class="dropdown-item">
                <a href="{{ route('settings.invoice-Config') }}"
                   class="dropdown-link {{ strpos($viewName, 'settings') && strpos($viewName, 'invoiceConfig-settings') ? 'active' : '' }}">
                  <i class="nav-icon fa fa-home"></i>
                  <span>Invoice Config</span>
                </a>
              </div>
              <div class="dropdown-item">
                <a href="{{ route('settings.home.hero-Slide') }}"
                   class="dropdown-link {{ strpos($viewName, 'settings') && strpos($viewName, 'homepage') ? 'active' : '' }}">
                  <i class="nav-icon fa fa-home"></i>
                  <span>Homepage</span>
                </a>
              </div>
              <div class="dropdown-item">
                <a href="{{ route('settings.table-Booking') }}"
                   class="dropdown-link {{ strpos($viewName, 'settings') && strpos($viewName, 'bookTable') ? 'active' : '' }}">
                  <i class="nav-icon fa fa-home"></i>
                  <span>Book-Table</span>
                </a>
              </div>
              <div class="dropdown-item">
                <a href="{{ route('settings.google-Maps') }}"
                   class="dropdown-link {{ strpos($viewName, 'settings') && strpos($viewName, 'googleMaps') ? 'active' : '' }}">
                  <i class="nav-icon fa fa-home"></i>
                  <span>Google-Maps</span>
                </a>
              </div>
            </div>
          </li>
        @endcan

      </ul>
    </div>
  </div>
</div>
@endif
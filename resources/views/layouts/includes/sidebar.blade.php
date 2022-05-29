<div id="Sidebar" class="site-sidebar p-fixed h-100 left-0 top-0 bg-sidebar transition z-index-11 {{ auth()->user() ? 'collapse' : '' }}">
  <div class="sidebar-overlay p-absolute z-index-1"></div>

  <div class="sidebar-wrapper">
    <div class="sidebar-top h-auto text-center p-10 bb-1">
      <a href="/" class="p-5">
        <img src="{{ asset('assets/img/logo-only-red.png') }}" alt="" 
        class="brand-logo logo-only w-100 h-30px transition" />

        <img src="{{ asset('assets/img/logo-red.png') }}" alt="" 
        class="brand-logo logo-text w-100 h-30px transition d-none" />
      </a>
    </div>

    <div class="sidebar-content full-height-prev-auto">
      <ul class="sidebar-menu">
        <li class="menu-item">
          <a href="#" class="menu-link">Dashboard</a>
        </li>
      </ul>
    </div>
  </div>
</div>
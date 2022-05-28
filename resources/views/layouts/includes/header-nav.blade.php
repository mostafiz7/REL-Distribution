<section class="header-navbar">
  <nav class="navbar navbar-expand-lg">
    <div class="container-xl">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#NavbarHeader" aria-controls="NavbarHeader" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="navbar-header collapse navbar-collapse text-center" id="NavbarHeader">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link {{ Route::currentRouteName() == 'homepage' ? 'active' : '' }}"
               aria-current="page" href="/"
               data-bs-toggle="tooltip" data-bs-custom-class="custom-class" data-bs-placement="bottom" title="Homepage">
              Home
            </a>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle {{ strpos($viewName, 'menuOrdering') ? 'active' : '' }}"
               href="#" id="orderingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Menu
            </a>
            <ul class="dropdown-menu" aria-labelledby="orderingDropdown">
              <li><a class="dropdown-item" href="{{ route('menu.ordering', 'home-delivery') }}">Order for Home Delivery</a></li>
              <li><a class="dropdown-item" href="{{ route('menu.ordering', 'collection') }}">Order for Collection</a></li>
            </ul>
          </li>

        </ul>
      </div>
    </div>
  </nav>
</section>
<header class="header-area auth-header" id="Auth-Header">
  <div class="header-navbar">
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
      <div class="container-lg">
        <div class="navbar-header">
          <ul class="navbar-nav">
            <li class="nav-item home">
              <a href="{{ url('/') }}" class="nav-link text-dark">Home</a>
            </li>
          </ul>
        </div>
        
        <div class="navbar-header right ms-auto">
          <ul class="navbar-nav">
            @guest
              @if ( Route::has('login') && Route::currentRouteName() != 'login' )
                <li class="nav-item login mr-5">
                  <a href="{{ route('login') }}" class="nav-link text-dark">Login</a>
                </li>
              @endif
    
              @if ( Route::has('register') && Route::currentRouteName() != 'register' )
                <li class="nav-item register">
                  <a href="{{ route('register') }}" class="nav-link text-dark">Register</a>
                </li>
              @endif
            @endguest
          </ul>
        </div>
      </div>
    </nav>
  </div>
</header>
